<nav class="k-side-nav nav flex-column col-2 border-right bg-white p-0">
    <div class="logo">
        <h2>
            <a href="#" class="d-flex d-md-none"><i class="fab fa-apple"></i></a>
            <a href="#" class="d-none d-md-flex"><i class="fab fa-apple  mr-1"></i>APPLE</a>
        </h2>
    </div>
    <div class="k-nav-container h-75">
        <ul class="k-nav nav">
            <li class="nav-item w-100 mb-1">
                <a href="sellerHome.php" class="nav-link w-100 <?php if($pageName == 'Home') echo 'active';?>">
                <i class="fas fa-home"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Home</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-1">
                <a href="sellerOrder.php" class="nav-link w-100 <?php if($pageName == 'Order') echo 'active';?>">
                    <i class="fas fa-list-alt d-inline-flex"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Orders</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-1">
                <a href="sellerProduct.php" class="nav-link w-100 <?php if($pageName == 'Product') echo 'active';?>">
                    <i class="fas fa-bars d-inline-flex"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Products</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-1">
                <a href="sellerChat.php" class="nav-link w-100 <?php if($pageName == 'Chat') echo 'active';?>">
                    <i class="fas fa-comments"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Chats</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-1">
                <a href="sellerPromo.php" class="nav-link w-100 <?php if($pageName == 'Promo') echo 'active';?>">
                    <i class="fas fa-ad"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Promo</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

