<?php
namespace App\Controllers;

class RecettesController extends BaseController{

     // Methode chargée par defaut
    public function index(){
       $this->view(1);
    }

    public function create(){
        $data['title'] = "ajout-recette";
        echo view("templates/header");
        echo view('pages/addnewrecette.php');
    }

    //Gestion de creation et d'ajout d'une nouvelle recette
    public function createRecette(){
        $db = \Config\Database::connect();
        $instruction = $this->request->getPost('instruction');
        $titre  = $this->request->getPost('titre');

        $sql = "INSERT INTO recette(titre, instructions) VALUES(?, ?)";
        $result = $db->query($sql, [$titre, $instruction]);

        $data['title'] = "Notifcation";
            echo view('templates/header', $data);
            if($result){
                $data['issuccess'] = true;
                $data['message'] = "Recette créée et ajoutée ";
                echo view('pages/notification.php', $data);
            }else{
                $data['issuccess'] = false;
                $data['message'] = "Une erreur est survenue pendant le traitement de la requête";
                echo view('pages/notification.php', $data);
            }
    }

    public function view($page = 1){
        // Si tout est OK, on se connecte à la database
        $db = \Config\Database::connect();

        //Requete preparée 
        $sql = 'SELECT id, titre FROM recette LIMIT 25 OFFSET ?';

        //Recuperation de 25 recettes au plus 
        // A partir de la page actuelle
        $query = $db->query($sql, [($page-1)*25]);

        $countQuery  = $db->query('SELECT COUNT(id) as totalrecette FROM recette');

        // On recupère les data sous forme d'un array
        $recettes = $query->getResult('array');

        //important pour connaitre le nombre de page à afficher
        $total = $countQuery->getRow();
        $total_recettes = $total->totalrecette;

        // On Customise le titre
        $data['title'] = 'Page'.$page;
        // Les data sont envoyées pour l'affichage
        $data['recettes'] = $recettes;
        // Nbre de pages à fetcher
        $data['pages'] = ceil($total_recettes/25);
        $data['page_number'] = $page;
        
        // Juste pour debuger
        //$data['fordebug'] = json_encode($total_recettes);

        echo view('templates/header', $data);
        echo view('pages/home', $data);
        echo view('templates/footer', $data);
    }

    // Gestion d'affichage des détails d'une recette
    // Le second (true || false) argument permet de déterminer la vue 
    // TRUE: (valeur par defaut) on affiche juste les détails
    // FALSE: On affiche la vue pour éditer les détails
    public function detail($recetteid = 1, $show = true){

        // Si tout est OK, on se connecte à la database
        $db = \Config\Database::connect();

        // Process de récupértion des détails d'une recette
        $sql = 'SELECT * FROM recette WHERE id = ?';
        $queryreccette = $db->query($sql, [$recetteid]);
        $info_recette = $queryreccette->getRow();

        // Process de récupértion des ingrédients
        $sql2 = 'SELECT * FROM ingredient WHERE id_recette = ?';
        $queryingredient = $db->query($sql2, [$recetteid]);
        $ingredients = $queryingredient->getResult('array');


        $data['title'] = $info_recette->slug;
        $data['recette'] = $info_recette;
        $data['ingredients'] = $ingredients;

        //On affiche juste les détails
        echo view('templates/header', $data);
        if($show == true){
            //On affiche le détail
            echo view('pages/detail.recette.php', $data);
        }else{
            //On affiche le formulaire d'édition 
            echo view('pages/edit.recette.php', $data);
        
        }
        
    }

    public function edit($recetteid = 0){

        if($recetteid !=0){
            $this->detail($recetteid, false);
        }
    }

    public function update($recetteid = 0){
        if($recetteid != 0 ){
            $db = \Config\Database::connect();

            $instruction = $this->request->getPost('instruction');
            $titre = $this->request->getPost('nomRecette');
            $nombreIngredient = (int)$this->request->getPost('nbRecette');

            $quantite = array();
            $nom = array();

            for ($i=1; $i <= $nombreIngredient; $i++) { 
                $q = "q".strval($i);
                $n = "n".strval($i);

                $quantite[$i-1] = $this->request->getPost($q);
                $nom[$i-1] = $this->request->getPost($n);
            }

            //print_r($nombreIngredient);
           
            $sql = "UPDATE recette SET titre = ?, instructions = ? WHERE id = ?";
            $result = $db->query($sql, [$titre, $instruction, $recetteid]);


            
            $sql1 = "DELETE FROM ingredient WHERE id_recette = ?";
            $deleteIngquery = $db->query($sql1, [$recetteid]);

            for ($i=0; $i < $nombreIngredient; $i++) { 
                $sql2 = "INSERT INTO ingredient(id_recette, quantite, nom) VALUES(?, ?, ?)";
                $result = $db->query($sql2, [ $recetteid, $quantite[$i], $nom[$i] ]);
                if(! $result){
                    die(print_r("Error while updating"));
                }
            }
            $this->view(1);
            
        }else{
            //TODO
            //To redirect 
            return redirect('http://mesrecettes/'); 
        }
    }

    // Gestion de suppression d'une recette et ses ingredients
    //On supprime d'abord tous les ingredients puis la recette
    public function delete($recetteid = 0){
        if($recetteid != 0){
            $db = \Config\Database::connect();
            $sql1 = "DELETE FROM ingredient WHERE id_recette = ?";
            $sql2 = "DELETE FROM recette WHERE id = ?";

            $deleteIngquery = $db->query($sql1, [$recetteid]);

            $deleteRecettequery = $db->query($sql2, [$recetteid]);

            $data['title'] = "Notifcation";
            echo view('templates/header', $data);
            if($deleteIngquery && $deleteRecettequery){
                $data['issuccess'] = true;
                $data['message'] = "Opération réussie";
                echo view('pages/notification.php', $data);
            }else{
                $data['issuccess'] = false;
                $data['message'] = "Une erreur est survenue pendant le traitement de la requête";
                echo view('pages/notification.php', $data);
            }
        }
        
    }
}