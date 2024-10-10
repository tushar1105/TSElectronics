<nav class="gg-header-nav" style="display: none;">
    <ul id="menu">
        <li>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="index.php">Home</a>
            <?php endif; ?>
        </li>
        <li>
            <?php if (!isset($_SESSION['username'])): ?>
                <a href="login.php">Login</a>
            <?php else: ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
            <li>
                <a href="orders.php">All Orders</a>
            </li>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <li>
                    <a href="createStoreManager.php">Create new Store Manager</a>
                </li>
                <li>
                    <a href="allStoreManagers.php">All Store Managers</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
