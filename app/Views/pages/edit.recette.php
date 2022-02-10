<body>
    <section>
        <h1> Modidier une recette </h1>
        <form action="/recettes/update/<?php echo $recette->id; ?>" method="post">
        <label for="nomRecette">Titre</label>
        <input type='text' value="<?= esc($recette->titre) ?>" id="nomRecette" name="nomRecette">
            <fieldset>
                <legend> Ingrédients</legend>
                
                    <div style="width: 100px; font-size: 12px;">
                        <input type="text" id="nombreIngredient" readonly value="<?php echo ( !empty($ingredients) && is_array($ingredients)) ? count($ingredients) : '0'; ?>" name="nbRecette" />
                    </div>
                    
                    <div class="container">
                        <div class="row">
                            <div style="margin-right: 50px;"> Quantité</div>
                            <div style="margin-left: 50px;"> Nom</div>
                        </div>
                        <div id="ingredients">
                            <?php if (! empty($ingredients) && is_array($ingredients)): ?>
                                <?php $cnt = 1; ?>
                                <?php foreach ($ingredients as $ingredient): ?>
                                    <div class="row">
                                        <input type="text" value="<?= esc($ingredient['quantite']) ?>" name="<?php echo "q".$cnt; ?>">
                                        <input type="text" value="<?= esc($ingredient['nom'])?>"  name="<?php echo "n".$cnt; ?>">
                                        <?php $cnt++; ?>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div> 
                <input type="button" onclick="addinput()" value = "Ajouter un ingredient">
            </fieldset>
            <fieldset>
                <legend> Préparation</legend>
                <textarea id="instruction" name="instruction" rows="7", cols="67"> <?= esc($recette->instructions) ?> </textarea>
                <br/>
                <input type='submit' value="Sauvegarder" style='background-color: rgb(77, 151, 81); color: white'>
            </fieldset>
        </form>
        
    </section>
    <footer>
        <div class="copyrights">
            <p>&copy; <?= date('Y') ?> Mon site de recettes</p>
        </div>
    </footer>
    <script src="/assets/script.js"></script>
</body>
</html>