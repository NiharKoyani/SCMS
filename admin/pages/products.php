<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}
$adminId = $_SESSION['admin_id'];

include('../../Utility/db.php');

// Get all products with vendor information
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[$row['id']] = $row;
    }
}

// Handle product actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_product'])) {
        $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

        // Validate product ID
        if ($productId > 0) {
            // First, check if product exists
            $checkSql = "SELECT id FROM products WHERE id = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("i", $productId);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // Product exists, proceed with deletion
                $deleteSql = "DELETE FROM products WHERE id = ?";
                $stmt = $conn->prepare($deleteSql);
                $stmt->bind_param("i", $productId);

                if ($stmt->execute()) {
                    $successMessage = "Product deleted successfully!";
                    header("Location: products.php?success=1");
                    exit();
                } else {
                    $errorMessage = "Failed to delete product: " . $conn->error;
                }
                $stmt->close();
            } else {
                $errorMessage = "Product not found!";
            }
            $checkStmt->close();
        } else {
            $errorMessage = "Invalid product ID!";
        }
    }

    if (isset($_POST['update_stock'])) {
        $productId = intval($_POST['product_id']);
        $newStock = intval($_POST['stock']);

        if ($productId > 0 && $newStock >= 0) {
            $updateSql = "UPDATE products SET stock = ? WHERE id = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("ii", $newStock, $productId);

            if ($stmt->execute()) {
                $successMessage = "Stock updated successfully!";
                header("Location: products.php?success=1");
                exit();
            } else {
                $errorMessage = "Failed to update stock: " . $conn->error;
            }
            $stmt->close();
        } else {
            $errorMessage = "Invalid stock value or product ID!";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management - Admin Dashboard</title>
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
           Sidebar
        ========================= */
        .sidebar {
            width: var(--sidebar-width);
            background: #000;
            color: var(--white);
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transform: translateX(0);
            transition: all 0.3s ease;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
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
            font-family: 'Pacifico', cursive;
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
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .menu-item:hover::before,
        .menu-item.active::before {
            left: 0;
        }

        .menu-item.active::before {
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
           Products Header
        ========================= */
        .products-header {
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

        .products-stats {
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
           Products Container
        ========================= */
        .products-container {
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
           Products Grid
        ========================= */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .product-card {
            background: var(--white);
            border: 1px solid var(--light);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 21rem;
            object-fit: cover;
            border-bottom: 1px solid var(--border-color);
        }

        .product-details {
            padding: 1.5rem;
        }

        .product-category {
            display: inline-block;
            background: rgba(255, 107, 107, 0.1);
            color: var(--primary);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 0.8rem;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .product-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light);
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .product-stock {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .stock-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .stock-in {
            background: var(--success);
        }

        .stock-low {
            background: var(--warning);
        }

        .stock-out {
            background: var(--danger);
        }

        /* =========================
           Vendor Information
        ========================= */
        .vendor-info {
            background: var(--light);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .vendor-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .vendor-shop {
            color: #666;
            font-size: 0.9rem;
        }

        /* =========================
           Product Actions
        ========================= */
        .product-actions {
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

        .edit-btn {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success);
        }

        .edit-btn:hover {
            background: var(--success);
            color: white;
        }

        .stock-btn {
            background: rgba(0, 123, 255, 0.1);
            color: #007bff;
        }

        .stock-btn:hover {
            background: #007bff;
            color: white;
        }

        .delete-btn {
            background: rgba(255, 71, 87, 0.1);
            color: var(--danger);
        }

        .delete-btn:hover {
            background: var(--danger);
            color: white;
        }

        /* =========================
           Stock Update Form
        ========================= */
        .stock-form {
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

        .stock-form.active {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stock-input {
            padding: 0.5rem;
            border: 1px solid var(--light);
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 1rem;
            text-align: center;
        }

        .stock-buttons {
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
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

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

            .products-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .products-stats {
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

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }

            .product-actions {
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

            .products-stats {
                flex-wrap: wrap;
            }

            .stat-card {
                flex: 1;
                min-width: calc(50% - 0.5rem);
            }

            .products-grid {
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
                    <h1 class="page-title">Products Management</h1>
                </div>
                <div class="nav-right">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
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

            <!-- Products Header -->
            <div class="products-header">
                <div class="header-left">
                    <h1>All Products</h1>
                    <p>Manage products from all vendors</p>
                </div>
                <div class="products-stats">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo count($products); ?></div>
                        <div class="stat-label">Total Products</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php echo count(array_filter($products, function ($product) {
                                return $product['stock'] > 10;
                            })); ?>
                        </div>
                        <div class="stat-label">In Stock</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php echo count(array_filter($products, function ($product) {
                                return $product['stock'] == 0;
                            })); ?>
                        </div>
                        <div class="stat-label">Out of Stock</div>
                    </div>
                </div>
            </div>

            <!-- Products Container -->
            <div class="products-container">
                <div class="table-header">
                    <h3 class="table-title">Product List</h3>
                    <div class="table-actions">
                        <select class="filter-select" id="categoryFilter">
                            <option value="">All Categories</option>
                            <option value="RAPID REHYDRATION">Rapid Rehydration</option>
                            <option value="ICE HYDRATION">Ice Hydration</option>
                            <option value="HYDRATION">Hydration</option>
                            <option value="ENERGY">Energy</option>
                            <option value="HYDRATION PLUS STICKS">Hydration Plus Sticks</option>
                        </select>
                        <input type="text" class="search-box" placeholder="Search products..." id="searchProducts">
                    </div>
                </div>

                <?php if (count($products) > 0): ?>
                    <div class="products-grid" id="productsGrid">
                        <?php foreach ($products as $product): ?>
                            <div class="product-card" data-category="<?php echo htmlspecialchars($product['category']); ?>">
                                <img src="<?php echo htmlspecialchars($product['image'] ?: 'https://via.placeholder.com/300x200?text=No+Image'); ?>"
                                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                                    class="product-image">

                                <div class="product-details">
                                    <span class="product-category"><?php echo htmlspecialchars($product['category']); ?></span>
                                    <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>

                                    <!-- Vendor Information -->
                                    <div class="vendor-info">
                                        <div class="vendor-name"><?php echo htmlspecialchars($product['vendor_name']); ?></div>
                                        <div class="vendor-shop"><?php echo htmlspecialchars($product['shop_name']); ?></div>
                                    </div>

                                    <div class="product-meta">
                                        <div class="product-price">₹<?php echo number_format($product['price'], 2); ?></div>
                                        <div class="product-stock">
                                            <div class="stock-indicator <?php echo $product['stock'] > 10 ? 'stock-in' : ($product['stock'] > 0 ? 'stock-low' : 'stock-out'); ?>"></div>
                                            <span><?php echo $product['stock']; ?> in stock</span>
                                        </div>
                                    </div>

                                    <div class="product-actions">
                                        <!-- <button class="action-btn edit-btn" onclick="editProduct(<?php echo $product['id']; ?>)">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button> -->
                                        <button class="action-btn stock-btn" onclick="showStockForm(<?php echo $product['id']; ?>)">
                                            <i class="fas fa-box"></i>
                                            Stock
                                        </button>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        </form>
                                    </div>

                                    <!-- Stock Update Form -->
                                    <div class="stock-form" id="stockForm<?php echo $product['id']; ?>">
                                        <form method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="number" name="stock" class="stock-input" value="<?php echo $product['stock']; ?>" min="0" required>
                                            <div class="stock-buttons">
                                                <button type="submit" name="update_stock" class="save-btn">Save</button>
                                                <button type="button" class="cancel-btn" onclick="hideStockForm(<?php echo $product['id']; ?>)">Cancel</button>
                                            </div>
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
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3>No Products Found</h3>
                        <p>There are no products in the system yet.</p>
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

            // Filter products by category
            const categoryFilter = document.getElementById('categoryFilter');
            const searchBox = document.getElementById('searchProducts');
            const productCards = document.querySelectorAll('.product-card');

            function filterProducts() {
                const categoryValue = categoryFilter.value;
                const searchValue = searchBox.value.toLowerCase();

                productCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    const productName = card.querySelector('.product-title').textContent.toLowerCase();
                    const productDesc = card.querySelector('.product-description').textContent.toLowerCase();

                    const categoryMatch = !categoryValue || category === categoryValue;
                    const searchMatch = !searchValue ||
                        productName.includes(searchValue) ||
                        productDesc.includes(searchValue);

                    card.style.display = categoryMatch && searchMatch ? 'block' : 'none';
                });
            }

            categoryFilter.addEventListener('change', filterProducts);
            searchBox.addEventListener('input', filterProducts);
        });

        function showStockForm(productId) {
            document.getElementById('stockForm' + productId).classList.add('active');
        }

        function hideStockForm(productId) {
            document.getElementById('stockForm' + productId).classList.remove('active');
        }

        function editProduct(productId) {
            alert('Edit product functionality for product ID: ' + productId + '\n\nIn a real implementation, this would open an edit form/modal.');
            // In real implementation: window.location.href = `edit-product.php?id=${productId}`;
        }

        function confirmDelete(productName) {
            return confirm(`Are you sure you want to delete "${productName}"? This action cannot be undone.`);
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