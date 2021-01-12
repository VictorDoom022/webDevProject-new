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
                <a href="adminManageSeller.php" class="nav-link w-100 <?php if($pageName == 'Admin') echo 'active';?>">
                    <i class="fas fa-home"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Home</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-1">
                <a href="adminChat.php" class="nav-link w-100 <?php if($pageName == 'Chat') echo 'active';?>">
                    <i class="fas fa-comments"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Chat</span>
                </a>
            </li>
            <li class="nav-item w-100 mb-1">
                <a href="adminGiveCom.php" class="nav-link w-100 <?php if($pageName == 'Seller') echo 'active';?>">
                <i class="fas fa-file"></i>
                    <span class="d-none d-lg-inline-flex ml-3">Seller</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

