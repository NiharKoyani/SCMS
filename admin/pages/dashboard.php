<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../auth/login.php');
    exit();
}
$adminId = $_SESSION['admin_id'];

include('../../Utility/db.php');

// Get statistics
$totalShopkeepers = $conn->query("SELECT COUNT(*) as count FROM shopkeeper")->fetch_assoc()['count'];
$totalProducts = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$totalOrders = $conn->query("SELECT COUNT(DISTINCT orderId) as count FROM orders")->fetch_assoc()['count'];
$pendingOrders = $conn->query("SELECT COUNT(DISTINCT orderId) as count FROM orders WHERE status = 'pending'")->fetch_assoc()['count'];

// Get recent orders
$recentOrders = [];
$ordersSql = "SELECT DISTINCT o.orderId, o.status, o.created_at, s.shop_name 
              FROM orders o 
              LEFT JOIN shopkeeper s ON o.shopkeeper_id = s.id 
              ORDER BY o.created_at DESC 
              LIMIT 5";
$ordersResult = $conn->query($ordersSql);
if ($ordersResult && $ordersResult->num_rows > 0) {
    while ($row = $ordersResult->fetch_assoc()) {
        $recentOrders[] = $row;
    }
}

// Get recent shopkeepers
$recentShopkeepers = [];
$shopkeepersSql = "SELECT shop_name, owner_name, email, mobile_number, created_at 
                   FROM shopkeeper 
                   ORDER BY created_at DESC 
                   LIMIT 5";
$shopkeepersResult = $conn->query($shopkeepersSql);
if ($shopkeepersResult && $shopkeepersResult->num_rows > 0) {
    while ($row = $shopkeepersResult->fetch_assoc()) {
        $recentShopkeepers[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../styles/main.css">
    <style>
        /* =========================
           Root Variables & Resets
        ========================= */
        :root {
            --primary: #09122c;
            --primary-light: #ff8e8e;
            --primary-dark: #596792;
            --secondary: #11204be0;
            --accent: #ffa502;
            --dark: #2f3542;
            --light: #f1f2f6;
            --white: #ffffff;
            --success: #2ed573;
            --warning: #ffa502;
            --danger: #ff4757;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--light);
            color: var(--dark);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* =========================
           Floating Bubbles Background
        ========================= */
        .bubbles-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(255, 107, 107, 0.05);
            border-radius: 50%;
            filter: blur(2px);
            animation: float-up 15s infinite ease-in;
        }

        @keyframes float-up {
            0% {
                bottom: -100px;
                transform: translateX(0) rotate(0deg);
                opacity: 0;
            }

            10%,
            90% {
                opacity: 0.3;
            }

            100% {
                bottom: 100vh;
                transform: translateX(calc(var(--move-x) * 100px)) rotate(360deg);
                opacity: 0;
            }
        }

        /* =========================
           Dashboard Layout
        ========================= */
        .dashboard {
            display: flex;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        /* =========================
           Top Navigation
        ========================= */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: var(--white);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--dark);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .notification-btn,
        .profile-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--dark);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: var(--white);
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-light);
        }

        /* =========================
           Welcome Section
        ========================= */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
        }

        .welcome-content {
            position: relative;
            z-index: 2;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .welcome-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .welcome-stat {
            text-align: center;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .welcome-stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .welcome-stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* =========================
           Quick Actions
        ========================= */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-btn {
            background: var(--white);
            border: 2px dashed var(--light);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark);
        }

        .action-btn:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .action-label {
            font-weight: 500;
            text-align: center;
        }

        /* =========================
           Recent Activity Section
        ========================= */
        .activity-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .activity-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        /* =========================
           Lists
        ========================= */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 8px;
            background: var(--light);
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: #e8eaed;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            color: #666;
            font-size: 0.8rem;
        }

        .shopkeeper-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 8px;
            background: var(--light);
            margin-bottom: 0.5rem;
        }

        .shopkeeper-info {
            flex: 1;
        }

        .shopkeeper-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .shopkeeper-detail {
            color: #666;
            font-size: 0.8rem;
        }

        /* =========================
           Status Badges
        ========================= */
        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .status-pending {
            background: rgba(255, 165, 2, 0.1);
            color: var(--warning);
        }

        .status-processing {
            background: rgba(0, 123, 255, 0.1);
            color: #007bff;
        }

        .status-delivered {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success);
        }

        /* =========================
           Responsive Styles
        ========================= */
        @media (max-width: 1024px) {

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem;
            }

            .welcome-section {
                padding: 1.5rem;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .welcome-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .activity-section {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 1rem;
            }

            .top-nav {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .nav-right {
                width: 100%;
                justify-content: space-between;
            }

            .welcome-stats {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="bubbles-bg">
        <!-- Bubbles will be added dynamically -->
    </div>

    <div class="dashboard">
        <?php include('../util/sidebar.php') ?>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <div class="nav-left">
                    <button class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Admin Dashboard</h1>
                </div>
                <div class="nav-right">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </button>
                    <button class="profile-btn">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile" class="profile-img">
                    </button>
                </div>
            </nav>

            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="welcome-content">
                    <h1 class="welcome-title">Welcome Back, Admin!</h1>
                    <p class="welcome-subtitle">Here's what's happening with your business today.</p>

                    <div class="welcome-stats">
                        <div class="welcome-stat">
                            <div class="welcome-stat-number"><?php echo $totalOrders; ?></div>
                            <div class="welcome-stat-label">Total Orders</div>
                        </div>
                        <div class="welcome-stat">
                            <div class="welcome-stat-number"><?php echo $totalShopkeepers; ?></div>
                            <div class="welcome-stat-label">Active Vendors</div>
                        </div>
                        <div class="welcome-stat">
                            <div class="welcome-stat-number"><?php echo $totalProducts; ?></div>
                            <div class="welcome-stat-label">Products</div>
                        </div>
                        <div class="welcome-stat">
                            <div class="welcome-stat-number"><?php echo $pendingOrders; ?></div>
                            <div class="welcome-stat-label">Pending Orders</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="orders.php" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="action-label">Manage Orders</div>
                </a>

                <a href="products.php" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="action-label">View Products</div>
                </a>

                <a href="shopkeepers.php" class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="action-label">Vendor Management</div>
                </a>
            </div>

            <!-- Recent Activity Section -->
            <div class="activity-section">
                <!-- Recent Orders -->
                <div class="activity-card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Orders</h3>
                        <a href="orders.php" class="view-all">View All</a>
                    </div>
                    <div class="activity-list">
                        <?php foreach ($recentOrders as $order): ?>
                            <div class="activity-item">
                                <div class="activity-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Order #<?php echo htmlspecialchars($order['orderId']); ?></div>
                                    <div class="activity-time">
                                        <?php echo htmlspecialchars($order['shop_name']); ?> •
                                        <?php echo date('M j, g:i A', strtotime($order['created_at'])); ?>
                                    </div>
                                </div>
                                <span class="status-badge status-<?php echo htmlspecialchars($order['status']); ?>">
                                    <?php echo ucfirst(htmlspecialchars($order['status'])); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Recent Vendors -->
                <div class="activity-card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Vendors</h3>
                        <a href="vendors.php" class="view-all">View All</a>
                    </div>
                    <div class="activity-list">
                        <?php foreach ($recentShopkeepers as $shopkeeper): ?>
                            <div class="shopkeeper-item">
                                <div class="activity-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="shopkeeper-info">
                                    <div class="shopkeeper-name"><?php echo htmlspecialchars($shopkeeper['shop_name']); ?></div>
                                    <div class="shopkeeper-detail">
                                        <?php echo htmlspecialchars($shopkeeper['owner_name']); ?> •
                                        <?php echo htmlspecialchars($shopkeeper['mobile_number']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create background bubbles
            const bubblesBg = document.querySelector('.bubbles-bg');
            for (let i = 0; i < 15; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.width = Math.random() * 60 + 20 + 'px';
                bubble.style.height = bubble.style.width;
                bubble.style.left = Math.random() * 100 + '%';
                bubble.style.animationDuration = 5 + Math.random() * 15 + 's';
                bubble.style.animationDelay = Math.random() * 5 + 's';
                bubble.style.setProperty('--move-x', Math.random() > 0.5 ? 1 : -1);
                bubblesBg.appendChild(bubble);
            }

            // Toggle sidebar on mobile
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.querySelector('.sidebar');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });

            // Fix: Make increment/decrement work for all products (if you have multiple)
            // This is a generic example for buttons with class .increment and .decrement
            document.querySelectorAll('.increment').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const input = btn.closest('.product-item').querySelector('.quantity-input');
                    if (input) input.value = parseInt(input.value) + 1;
                });
            });
            document.querySelectorAll('.decrement').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const input = btn.closest('.product-item').querySelector('.quantity-input');
                    if (input && parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
                });
            });
        });
    </script>
</body>

</html>