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
        <body class="bg-light">
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
<style>

a , a:visited
{ 
    color: #ff9326;
 }
</style>
    <nav class="navbar navbar-expand-md shadow-sm"style="background-color:#000;">
        <div class="container">
            <a class="navbar-brand" href="." style="color: rgb(255 255 255 / 0.8);">
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
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="user_acc"><?= $_SESSION['username'] ?></a>
                        <div class="dropdown-menu border-0 shadow"  aria-labelledby="user_acc" style="min-width: 200px;">
                            <ul class="nav flex-column pl-3">
                                <li class="nav-item">
                                    <a href="./function/logout.php" class="nav-link text-light">
                                        Logout
                                    </a>
                                </li>
                                <!-- @foreach(\$PRODUCT_CATEGORIES as \$product_category) -->
                                <li class="nav-item">
                                    <a href="{{ route('product_category.product_list', ['product_category'=> \$product_category]) }}" class="nav-link">
                                        <!-- {{ \$product_category->category_title }} -->
                                    </a>
                                </li>
                                <!-- @endforeach -->
                            </ul>
                        </div>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
<?php
}