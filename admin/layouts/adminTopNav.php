<nav class="k-top-nav navbar navbar-expand-lg navbar-light bg-white col-10 pl-4 border-bottom">
	<span class="navbar-brand h1 mb-0 col">
        <?php if ($pageName == 'Admin'){?>
            <i class="fas fa-home"></i>
        <?php }else if ($pageName == 'Chat'){?>
			<i class="fas fa-comments"></i>
		<?php } ?>
        <span class="d-none d-lg-inline-flex ml-3"><?php echo $pageTitle; ?></span>
        
    </span>
	<ul class="navbar-nav px-4">
		<li class="nav-item">
			<a href="#" class="btn btn-outline-dark" role="button" aria-pressed="true">Log Out</a>
		</li>
	</ul>
</nav>