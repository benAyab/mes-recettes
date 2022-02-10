<body>
<header>

	<div class="menu">
		<ul>
			<li class="menu-toggle">
				<button onclick="toggleMenu();">&#9776;</button>
			</li>
			<li class="menu-item hidden"><a href="/recettes/addRecette"><button>Ajouter une recette</button></a>
			</li>
		</ul>
	</div>

	<div class="heroe">
        <h2><strong>Mes recettes.  </strong> Je vous présente mes recettes</h2>

	</div>

</header>
<section>
    <?php if (! empty($recettes) && is_array($recettes)): ?>
        <ul> 
            <?php foreach ($recettes as $recette): ?>
               <a href="/recettes/detail/<?php echo $recette['id']; ?>"> <li class='list-item'> <?= esc($recette['titre']) ?> </li></a>
            <?php endforeach ?>
        </ul>
    <?php else: ?>
        <h3> Sorry </h3>
        <p>Il ya aucune recette disponibe</p>
    <?php endif ?>
</section>