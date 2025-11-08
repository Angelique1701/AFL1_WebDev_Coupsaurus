<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Sistem Toko</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
                </li>
                
                <?php if (isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'stores.php' ? 'active' : '' ?>" href="stores.php">Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'products.php' ? 'active' : '' ?>" href="products.php">Produk</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'products.php' ? 'active' : '' ?>" href="products.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'reviews.php' ? 'active' : '' ?>" href="reviews.php">Review Saya</a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'controller.php' ? 'active' : '' ?>" href="controller.php?controller=agency&action=list">Agency (Old)</a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <?= htmlspecialchars($_SESSION['username']) ?> (<?= htmlspecialchars($_SESSION['role']) ?>)
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
