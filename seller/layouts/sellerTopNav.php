<nav class="k-top-nav navbar navbar-expand-lg navbar-light bg-white col-10 pl-4 border-bottom">
	<span class="navbar-brand h1 mb-0 col">
        <?php if ($pageName == 'Home'){?>
            <i class="fas fa-home"></i>
        <?php }elseif ($pageName == 'Product'){ ?>
            <i class="fas fa-bars d-inline-flex"></i>
        <?php }elseif ($pageName == 'Chat'){ ?>
            <i class="fas fa-comments"></i>
        <?php }elseif ($pageName == 'Promo'){ ?>
            <i class="fas fa-ad"></i>
        <?php } ?>
        <span class="d-none d-lg-inline-flex ml-3"><?php echo $pageName; ?></span>
        
    </span>
	<ul class="navbar-nav px-4">
		<li class="nav-item">
			<a href="#" class="btn btn-outline-dark" role="button" aria-pressed="true">Log Out</a>
		</li>
	</ul>
</nav>