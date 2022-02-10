<body>
    <section>
        <h1> <?= esc($recette->titre) ?> </h1>
        <h2> Ingrédients</h2>
            <?php if (! empty($ingredients) && is_array($ingredients)): ?>
                <ul style='list'>
                    <?php foreach ($ingredients as $ingredient): ?>
                        <li> <?= esc($ingredient['quantite']) ?> <?= esc($ingredient['nom']) ?>  </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>

        <h2> Préparation</h2>
        <pre> <?= esc($recette->instructions) ?> </pre>
        <code>
            <a href="/recettes/edit/<?php echo $recette->id; ?>"> <button style='background-color: green; color: white'>Modidier</button></a>
            <a href="/recettes/delete/<?php echo $recette->id; ?>"> <button style='background-color: red; color: white'>Supprimer</button></a> 
        </code>
    </section>
    <footer>
        <div class="copyrights">
            <p>&copy; <?= date('Y') ?> Mon site de recettes</p>
        </div>
    </footer>
</body>
</html>