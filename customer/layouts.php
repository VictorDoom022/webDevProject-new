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
        <body>
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
    echo <<<_TOPNAV
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                $appName
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- Toggle -->
                        <a class="nav-link" href="#" id="navbar">Product</a>
                        <!-- Menu -->
                        <div class="dropdown-menu" style="min-width: 250px;">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" style="font-size: .93rem;font-weight: 400;">
                                                All
                                            </a>
                                        </li>
                                        @foreach(\$PRODUCT_CATEGORIES as \$product_category)
                                        <li class="nav-item">
                                            <a href="{{ route('product_category.product_list', ['product_category'=> \$product_category]) }}" class="nav-link" style="font-size: .93rem;font-weight: 400;">
                                                {{ \$product_category->category_title }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav flex-row">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="fas fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    _TOPNAV;
}