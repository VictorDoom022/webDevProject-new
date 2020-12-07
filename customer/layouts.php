<?php

function do_html_head(String $title, String $cssLink = null, String $jsLink = null)
{
    echo <<<_HEAD
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$title</title>
            $cssLink
            $jsLink
        </head>
        <body class="">
    _HEAD;
}

function do_html_end(Array $jsLink = [])
{
    echo <<<_HEAD
        </body>
    </html>
    _HEAD;
}

function do_component_topnav($appName)
{
?>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href=".">
                <?= $appName ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href=".">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- Toggle -->
                        <a class="nav-link" href="#" role="button" id="product-categry" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product</a>
                        <!-- Menu -->
                        <div class="dropdown-menu border-0 shadow"  aria-labelledby="product-categry" style="min-width: 250px;">
                            <ul class="nav flex-column pl-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="font-size: .93rem;font-weight: 400;">
                                        All
                                    </a>
                                </li>
                                <!-- @foreach(\$PRODUCT_CATEGORIES as \$product_category) -->
                                <li class="nav-item">
                                    <a href="{{ route('product_category.product_list', ['product_category'=> \$product_category]) }}" class="nav-link" style="font-size: .93rem;font-weight: 400;">
                                        <!-- {{ \$product_category->category_title }} -->
                                    </a>
                                </li>
                                <!-- @endforeach -->
                            </ul>
                        </div>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>-->
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav flex-row">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="fas fa-search"></i>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['username']) && $_SESSION['position'] == 'customer'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="user_acc">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow"  aria-labelledby="user_acc" style="min-width: 200px;">
                            <h5 class="dropdown-header">Welcome, <?= strtoupper($_SESSION['username']); ?>!</h5>
                            <a href="./function/logout.php" class="dropdown-item">
                                Logout
                            </a>
                        </div>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
<?php
}

function do_component_top_sale_product(Array $products)
{
?>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <h3>Top Selling Products</h3>
        </div>
        <div class="row">
            <?php
            if(count($products) > 0):
                foreach($products as $product)
            ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow">
                    <div class="card-img">
                        <a href="#" class="card-img-hover card-actions align-items-center">
                            <img src="<?= $product['prdt_image'] ?>" alt="" class="card-img-top">
                        </a>
                    </div>
                    <div class="card-body">
                        <small>
                            <a href="#" class="text-muted text-decoration-none"><?= $product['prdt_type'] ?></a>
                        </small>
                        <div class="font-weight-bold">
                            <a href="#" class="text-dark text-decoration-none"><?= $product['prdt_name'] ?></a>
                        </div>
                        <!-- price -->
                        <div class="font-weight-bold text-muted">
                            <small>RM <?= number_format(floatval($product['prdt_sellPrice']), 2) ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-12 pt-3 d-flex justify-content-center">
                <p class="text-muted">Not have product yet</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php
}