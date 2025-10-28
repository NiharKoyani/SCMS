<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../auth/login.php');
    exit();
}
$adminId = $_SESSION['admin_id'];

include('../../Utility/db.php');

// Get all shopkeepers
$shopkeepers = [];
$sql = "SELECT * FROM shopkeeper WHERE role='shopkeeper' ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get shopkeeper statistics
        $shopkeeperId = $row['id'];

        // Count orders
        $ordersSql = "SELECT COUNT(DISTINCT orderId) as order_count FROM orders WHERE shopkeeper_id = ?";
        $ordersStmt = $conn->prepare($ordersSql);
        $ordersStmt->bind_param("i", $shopkeeperId);
        $ordersStmt->execute();
        $ordersResult = $ordersStmt->get_result();
        $orderCount = $ordersResult->fetch_assoc()['order_count'];
        $ordersStmt->close();

        // Calculate total sales
        $salesSql = "SELECT SUM(p.price * o.quantity) as total_sales 
                     FROM orders o 
                     LEFT JOIN products p ON o.product_id = p.id 
                     WHERE o.shopkeeper_id = ?";
        $salesStmt = $conn->prepare($salesSql);
        $salesStmt->bind_param("i", $shopkeeperId);
        $salesStmt->execute();
        $salesResult = $salesStmt->get_result();
        $totalSales = $salesResult->fetch_assoc()['total_sales'] ?? 0;
        $salesStmt->close();


        $row['order_count'] = $orderCount;
        $row['total_sales'] = $totalSales;

        $shopkeepers[] = $row;
    }
}

// Handle shopkeeper actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_shopkeeper'])) {
        $shopkeeperId = $_POST['shopkeeper_id'];

        $checkOrdersSql = "SELECT COUNT(*) as order_count FROM orders WHERE shopkeeper_id = ?";
        $checkOrdersStmt = $conn->prepare($checkOrdersSql);
        $checkOrdersStmt->bind_param("i", $shopkeeperId);
        $checkOrdersStmt->execute();
        $orderResult = $checkOrdersStmt->get_result();
        $orderCount = $orderResult->fetch_assoc()['order_count'];
        $checkOrdersStmt->close();

        if ($orderCount > 0) {
            $errorMessage = "Cannot delete shopkeeper. They have $orderCount orders associated.";
        } else {
            $deleteSql = "DELETE FROM shopkeeper WHERE id = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("i", $shopkeeperId);

            if ($stmt->execute()) {
                $successMessage = "Shopkeeper deleted successfully!";
                header("Location: ./shopkeepers.php?success=1");
                exit();
            } else {
                $errorMessage = "Failed to delete shopkeeper: " . $conn->error;
            }
            $stmt->close();
        }
    }

    if (isset($_POST['update_status'])) {
        $shopkeeperId = $_POST['shopkeeper_id'];
        $newStatus = $_POST['status'];

        $updateSql = "UPDATE shopkeeper SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("si", $newStatus, $shopkeeperId);

        if ($stmt->execute()) {
            $successMessage = "Shopkeeper status updated successfully!";
            header("Location: shopkeepers.php?success=1");
            exit();
        } else {
            $errorMessage = "Failed to update shopkeeper status: " . $conn->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendors Management - Admin Dashboard</title>
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
           Vendors Header
        ========================= */
        .vendors-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-left h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .header-left p {
            color: #666;
            font-size: 1rem;
        }

        .vendors-stats {
            display: flex;
            gap: 1rem;
        }

        .stat-card {
            background: var(--white);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            min-width: 120px;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #666;
        }

        /* =========================
           Vendors Container
        ========================= */
        .vendors-container {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .table-actions {
            display: flex;
            gap: 1rem;
        }

        .filter-select {
            padding: 0.5rem 1rem;
            border: 1px solid var(--light);
            border-radius: 6px;
            background: var(--white);
            color: var(--dark);
        }

        .search-box {
            padding: 0.5rem 1rem;
            border: 1px solid var(--light);
            border-radius: 6px;
            width: 250px;
        }

        /* =========================
           Vendors Grid
        ========================= */
        .vendors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .vendor-card {
            background: var(--white);
            border: 1px solid var(--light);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .vendor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .vendor-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
        }

        .vendor-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
            border: 3px solid white;
        }

        .vendor-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .vendor-shop {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .vendor-details {
            padding: 1.5rem;
        }

        .contact-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .contact-item {
            display: flex;
            flex-direction: column;
        }

        .contact-label {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.25rem;
        }

        .contact-value {
            font-weight: 500;
        }

        .vendor-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light);
            border-radius: 8px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.7rem;
            color: #666;
        }

        /* =========================
           Status Badges
        ========================= */
        .status-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            min-width: 100px;
        }

        .status-active {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success);
            border: 1px solid rgba(46, 213, 115, 0.3);
        }

        .status-inactive {
            background: rgba(255, 71, 87, 0.1);
            color: var(--danger);
            border: 1px solid rgba(255, 71, 87, 0.3);
        }

        .status-pending {
            background: rgba(255, 165, 2, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 165, 2, 0.3);
        }

        /* =========================
           Vendor Actions
        ========================= */
        .vendor-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            flex: 1;
            padding: 0.6rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.8rem;
        }

        .view-btn {
            background: rgba(0, 123, 255, 0.1);
            color: #007bff;
        }

        .view-btn:hover {
            background: #007bff;
            color: white;
        }

        .status-btn {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success);
        }

        .status-btn:hover {
            background: var(--success);
            color: white;
        }

        .delete-btn {
            display: flex;
            background: rgba(255, 71, 87, 0.1);
            color: var(--danger);
        }

        .delete-btn:hover {
            background: var(--danger);
            color: white;
        }

        /* =========================
           Status Update Form
        ========================= */
        .status-form {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 12px;
            z-index: 10;
        }

        .status-form.active {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .status-select {
            padding: 0.5rem;
            border: 1px solid var(--light);
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .status-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .save-btn {
            flex: 1;
            padding: 0.5rem;
            background: var(--success);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .cancel-btn {
            flex: 1;
            padding: 0.5rem;
            background: var(--light);
            color: var(--dark);
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        /* =========================
           Alerts & Empty State
        ========================= */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success);
            border: 1px solid rgba(46, 213, 115, 0.3);
        }

        .alert-error {
            background: rgba(255, 71, 87, 0.1);
            color: var(--danger);
            border: 1px solid rgba(255, 71, 87, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--light);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .empty-state p {
            color: #666;
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

            .vendors-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .vendors-stats {
                width: 100%;
                justify-content: space-between;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .table-actions {
                width: 100%;
                flex-direction: column;
            }

            .search-box {
                width: 100%;
            }

            .vendors-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }

            .contact-info {
                grid-template-columns: 1fr;
            }

            .vendor-actions {
                flex-direction: column;
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

            .vendors-stats {
                flex-wrap: wrap;
            }

            .stat-card {
                flex: 1;
                min-width: calc(50% - 0.5rem);
            }

            .vendors-grid {
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
        <!-- Sidebar -->
        <?php include('../util/sidebar.php') ?>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <div class="nav-left">
                    <button class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Vendors Management</h1>
                </div>
                <div class="nav-right">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">2</span>
                    </button>
                    <button class="profile-btn">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile" class="profile-img">
                    </button>
                </div>
            </nav>

            <!-- Success/Error Messages -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    Operation completed successfully!
                </div>
            <?php endif; ?>

            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <!-- Vendors Header -->
            <div class="vendors-header">
                <div class="header-left">
                    <h1>All Shopkeepers</h1>
                    <p>Manage shopkeepers and their businesses</p>
                </div>
                <div class="vendors-stats">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo count($shopkeepers); ?></div>
                        <div class="stat-label">Total Vendors</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php echo count(array_filter($shopkeepers, function ($shopkeeper) {
                                return ($shopkeeper['status'] ?? 'active') === 'active';
                            })); ?>
                        </div>
                        <div class="stat-label">Active</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php echo array_sum(array_column($shopkeepers, 'order_count')); ?>
                        </div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                </div>
            </div>

            <!-- Vendors Container -->
            <div class="vendors-container">
                <div class="table-header">
                    <h3 class="table-title">Shopkeeper List</h3>
                    <div class="table-actions">
                        <select class="filter-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                        <input type="text" class="search-box" placeholder="Search shopkeepers..." id="searchVendors">
                    </div>
                </div>

                <?php if (count($shopkeepers) > 0): ?>
                    <div class="vendors-grid" id="vendorsGrid">
                        <?php foreach ($shopkeepers as $shopkeeper): ?>
                            <div class="vendor-card" data-status="<?php echo $shopkeeper['status'] ?? 'active'; ?>">
                                <div class="vendor-header">
                                    <div class="vendor-avatar">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <h3 class="vendor-name"><?php echo htmlspecialchars($shopkeeper['owner_name']); ?></h3>
                                    <p class="vendor-shop"><?php echo htmlspecialchars($shopkeeper['shop_name']); ?></p>
                                </div>

                                <div class="vendor-details">
                                    <!-- Contact Information -->
                                    <div class="contact-info">
                                        <div class="contact-item">
                                            <span class="contact-label">Email</span>
                                            <span class="contact-value"><?php echo htmlspecialchars($shopkeeper['email']); ?></span>
                                        </div>
                                        <div class="contact-item">
                                            <span class="contact-label">Phone</span>
                                            <span class="contact-value">+91 <?php echo htmlspecialchars($shopkeeper['mobile_number']); ?></span>
                                        </div>
                                        <div class="contact-item">
                                            <span class="contact-label">Location</span>
                                            <span class="contact-value"><?php echo htmlspecialchars($shopkeeper['shop_location']); ?></span>
                                        </div>
                                        <div class="contact-item">
                                            <span class="contact-label">Registered</span>
                                            <span class="contact-value"><?php echo date('M j, Y', strtotime($shopkeeper['created_at'])); ?></span>
                                        </div>
                                    </div>

                                    <!-- Vendor Statistics -->
                                    <div class="vendor-stats">
                                        <div class="stat-item">
                                            <div class="stat-value"><?php echo $shopkeeper['order_count']; ?></div>
                                            <div class="stat-label">Orders</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-value">₹<?php $tax = $shopkeeper['total_sales'] * 5 / 100;
                                                                        echo number_format($shopkeeper['total_sales'] + $tax); ?></div>
                                            <div class="stat-label">Sales</div>
                                        </div>
                                    </div>

                                    <!-- Status and Actions -->
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                        <span class="status-badge status-<?php echo $shopkeeper['status'] ?? 'active'; ?>">
                                            <?php echo ucfirst($shopkeeper['status'] ?? 'active'); ?>
                                        </span>

                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="shopkeeper_id" value="<?php echo $shopkeeper['id']; ?>">
                                            <select name="status" class="status-select" onchange="this.form.submit()" style="padding: 0.3rem 0.6rem; border: 1px solid var(--light); border-radius: 6px; font-size: 0.8rem;">
                                                <option value="active" <?php echo ($shopkeeper['status'] ?? 'active') === 'active' ? 'selected' : ''; ?>>Active</option>
                                                <option value="inactive" <?php echo ($shopkeeper['status'] ?? 'active') === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                <option value="pending" <?php echo ($shopkeeper['status'] ?? 'active') === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            </select>
                                            <input type="hidden" name="update_status" value="1">
                                        </form>
                                    </div>

                                    <div class="vendor-actions">
                                        <button class="action-btn view-btn" onclick="viewVendor(<?php echo $shopkeeper['id']; ?>)">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </button>
                                        <button class="action-btn status-btn" onclick="showStatusForm(<?php echo $shopkeeper['id']; ?>)">
                                            <i class="fas fa-cog"></i>
                                            Status
                                        </button>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="shopkeeper_id" value="<?php echo $shopkeeper['id']; ?>">
                                            <button type="submit" name="delete_shopkeeper" class="action-btn delete-btn" onclick="return confirmDelete('<?php echo htmlspecialchars($shopkeeper['shop_name']); ?>')">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <h3>No Shopkeepers Found</h3>
                        <p>There are no shopkeepers registered in the system yet.</p>
                    </div>
                <?php endif; ?>
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

            // Filter vendors by status
            const statusFilter = document.getElementById('statusFilter');
            const searchBox = document.getElementById('searchVendors');
            const vendorCards = document.querySelectorAll('.vendor-card');

            function filterVendors() {
                const statusValue = statusFilter.value;
                const searchValue = searchBox.value.toLowerCase();

                vendorCards.forEach(card => {
                    const status = card.getAttribute('data-status');
                    const vendorName = card.querySelector('.vendor-name').textContent.toLowerCase();
                    const vendorShop = card.querySelector('.vendor-shop').textContent.toLowerCase();

                    const statusMatch = !statusValue || status === statusValue;
                    const searchMatch = !searchValue ||
                        vendorName.includes(searchValue) ||
                        vendorShop.includes(searchValue);

                    card.style.display = statusMatch && searchMatch ? 'block' : 'none';
                });
            }

            statusFilter.addEventListener('change', filterVendors);
            searchBox.addEventListener('input', filterVendors);
        });

        function showStatusForm(vendorId) {
            // This would open a more detailed status form in a real implementation
            alert('Advanced status management for vendor ID: ' + vendorId);
        }

        function viewVendor(vendorId) {
            alert('View vendor details for vendor ID: ' + vendorId);
        }

        function confirmDelete(shopName) {
            return confirm(`Are you sure you want to delete "${shopName}"? This will also remove all their products and orders.`);
        }

        // Auto-hide success message after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    successAlert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);
                }, 3000); // 3 seconds
            }

            // Also hide error messages after 5 seconds
            const errorAlert = document.querySelector('.alert-error');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.opacity = '0';
                    errorAlert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        errorAlert.remove();
                    }, 500);
                }, 5000); // 5 seconds for errors
            }
        });
    </script>
</body>

</html>