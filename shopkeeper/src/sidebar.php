<style>
    /* Sidebar */
    .sidebar {
        width: var(--sidebar-width);
        background: black;
        color: var(--white);
        padding: 2rem 1.5rem;
        position: fixed;
        height: 100vh;
        z-index: 100;
        transform: translateX(0);
        transition: all 0.3s ease;
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .logo-icon {
        font-size: 1.8rem;
        color: var(--white);
    }

    .logo-text {
        font-family: "Pacifico", cursive;
        font-size: 1.5rem;
        background: linear-gradient(to right, var(--white), var(--light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .sidebar-menu {
        list-style: none;
        margin-top: 2rem;
    }

    .menu-item {
        margin-bottom: 0.5rem;
        position: relative;
        overflow: hidden;
    }

    .menu-item::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        z-index: -1;
    }

    .menu-item:hover::before {
        left: 0;
    }

    .menu-item.active::before {
        left: 0;
        background: rgba(255, 255, 255, 0.2);
    }

    .menu-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.8rem 1rem;
        color: var(--white);
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .menu-link i {
        width: 24px;
        text-align: center;
        font-size: 1.1rem;
    }

    .menu-item.active .menu-link {
        font-weight: 600;
    }
</style>


<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img style="width: 14rem;" src="../../Asserts/Prime-Logo.png" alt="">
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-item <?php echo isset($_GET['dashboard']) ? 'active' : null ?>">
            <a href="?dashboard" class="menu-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item <?php echo isset($_GET['products']) ? 'active' : null ?>">
            <a href="?products" class="menu-link">
                <i class="fas fa-box-open"></i>
                <span>Products</span>
            </a>
        </li>
        <li class="menu-item <?php echo isset($_GET['']) ? 'active' : null ?>">
            <a href="#" class="menu-link">
                <i class="fas fa-shopping-bag"></i>
                <span>Orders</span>
            </a>
        </li>
        <li class="menu-item <?php echo isset($_GET['']) ? 'active' : null ?>">
            <a href="#" class="menu-link">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
            </a>
        </li>
        <li class="menu-item <?php echo isset($_GET['']) ? 'active' : null ?>">
            <a href="#" class="menu-link">
                <i class="fas fa-store"></i>
                <span>My Shop</span>
            </a>
        </li>
        <li class="menu-item <?php echo isset($_GET['']) ? 'active' : null ?>">
            <a href="#" class="menu-link">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
        <li class="menu-item <?php echo isset($_GET['']) ? 'active' : null ?>">
            <a href="?logout" style="color: red;" class="menu-link">
                <i class="fas fa-users"></i>
                <span>Log Out</span>
            </a>
        </li>
    </ul>
</aside>
<script>
    // Toggle sidebar on mobile
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
    });
</script>