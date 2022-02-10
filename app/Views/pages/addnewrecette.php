<body>
    <h1> Ajouter une recette </h1>
    <form action="/recettes/create" method="post" id="form" style="position: relative; left: 50px;">
        <label for="nomRecette">Titre</label>
        <input type='text' value="" id="nomRecette" name="titre" required>     
        </div>
            <label> Préparation</label> <br/>
            <textarea id="instruction" name="instruction" rows="7", cols="67" required> </textarea>
            <br/>
            <input type="button" onclick="submit()" value="Enregistrer" style='background-color: rgb(77, 151, 81); color: white'>
    </form>
</body>
</html>