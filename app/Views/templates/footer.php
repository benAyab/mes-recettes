<!-- FOOTER:  COPYRIGHTS -->

<footer style="position: relative; bottom: 0; width: 100vw;">
	<div class="environment">
        <ul class="pagination">
            <a href="/recettes/view/1">&laquo;</a>
			<?php if($pages > 5): ?>
				<?php if($page_number <= 2): ?>
					<?php for ($a = 1; $a <= 5; $a++): ?>
						<li class="<?php echo $a == $page_number ? 'active' : ''; ?>">
							<a href="/recettes/view/<?php echo $a; ?>">
								<?php echo $a; ?>
							</a>
						</li>
					<?php endfor; ?>
				<?php else: ?>
					<?php if($page_number + 2 < $pages): ?>
						<?php for ($a = $page_number-2; $a <= $page_number+2; $a++): ?>
							<li class="<?php echo $a == $page_number ? 'active' : ''; ?>">
								<a href="/recettes/view/<?php echo $a; ?>">
									<?php echo $a; ?>
								</a>
							</li>
						<?php endfor; ?>
					<?php else: ?>
						<?php for ($a = $page_number-2; $a <= $pages; $a++): ?>
							<li class="<?php echo $a == $page_number?'active':''; ?>">
								<a href="/recettes/view/<?php echo $a; ?>">
									<?php echo $a; ?>
								</a>
							</li>
						<?php endfor; ?>
					<?php endif;?>
				<?php endif;?>
			<?php endif;?>
            <a href="/recettes/view/<?php echo $pages; ?>">&raquo;</a>
        </ul>
	</div>

	<div class="copyrights">
		<p>&copy; <?= date('Y') ?> Mon site de recettes</p>
	</div>

</footer>

<!-- SCRIPTS -->

<script>
	function toggleMenu() {
		var menuItems = document.getElementsByClassName('menu-item');
		for (var i = 0; i < menuItems.length; i++) {
			var menuItem = menuItems[i];
			menuItem.classList.toggle("hidden");
		}
	}
</script>
</body>
</html>