<nav class="k-top-nav navbar navbar-expand-lg navbar-light bg-white col-10 pl-4 border-bottom">
	<span class="navbar-brand h1 mb-0 col">
        <?php if ($pageName == 'Admin'):?>
            <i class="fas fa-home"></i>
		<?php elseif ($pageName == 'Chat'): ?>
            <i class="fas fa-comments"></i>
        <?php endif; ?>
        <span class="d-none d-lg-inline-flex ml-3"><?php echo $pageTitle; ?></span>
        
    </span>
	<ul class="navbar-nav px-4">
		<form action="../functions/logout_function.php" method="POST">
			<input type="submit"class="btn btn-outline-dark" name="logout" aria-pressed="true" value="Log Out">
		</form>
	</ul>
</nav>