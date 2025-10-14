<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}
$adminId = $_SESSION['admin_id'];

include('../../Utility/db.php');

// Get all orders with product and shopkeeper details using JOIN
$orders = [];
$sql = "SELECT o.*, 
               p.name as product_name,
               p.price as product_price,
               p.image as product_image,
               p.category as product_category,
               p.description as product_description,
               s.shop_name, 
               s.owner_name as vendor_name,
               s.email as vendor_email,
               s.mobile_number as vendor_phone,
               s.shop_location
        FROM orders o 
        LEFT JOIN products p ON o.product_id = p.id 
        LEFT JOIN shopkeeper s ON o.shopkeeper_id = s.id 
        ORDER BY o.created_at DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

// Group orders by orderId for better display
$groupedOrders = [];
foreach ($orders as $order) {
    $orderId = $order['orderId'];
    if (!isset($groupedOrders[$orderId])) {
        $groupedOrders[$orderId] = [
            'orderId' => $orderId,
            'shopkeeper_id' => $order['shopkeeper_id'],
            'shop_name' => $order['shop_name'],
            'vendor_name' => $order['vendor_name'],
            'vendor_email' => $order['vendor_email'],
            'vendor_phone' => $order['vendor_phone'],
            'shop_location' => $order['shop_location'],
            'status' => $order['status'],
            'created_at' => $order['created_at'],
            'total_amount' => 0,
            'products' => []
        ];
    }


    // Calculate product total and add to order
    $productTotal = $order['product_price'] * $order['quantity'];
    $groupedOrders[$orderId]['total_amount'] += $productTotal;

    $groupedOrders[$orderId]['products'][] = [
        'product_id' => $order['product_id'],
        'product_name' => $order['product_name'],
        'product_price' => $order['product_price'],
        'product_image' => $order['product_image'],
        'product_category' => $order['product_category'],
        'product_description' => $order['product_description'],
        'quantity' => $order['quantity'],
        'subtotal' => $productTotal
    ];
}

// Update order status if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];

    // Update all order items with the same orderId
    $updateSql = "UPDATE orders SET status = ? WHERE orderId = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ss", $newStatus, $orderId);

    if ($stmt->execute()) {
        $successMessage = "Order status updated successfully!";
        // Refresh to get updated data
        header("Location: orders.php?success=1");
        exit();
    } else {
        $errorMessage = "Failed to update order status: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management - Admin Dashboard</title>
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

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--light);
            color: var(--dark);
            min-height: 100vh;
            line-height: 1.6;
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
           Orders Header
        ========================= */
        .orders-header {
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

        .orders-stats {
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
           Orders Container
        ========================= */
        .orders-container {
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
           Order Cards
        ========================= */
        .order-cards {
            padding: 1.5rem;
        }

        .order-card {
            border: 1px solid var(--light);
            border-radius: 8px;
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .order-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            background: var(--light);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-info {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .order-id {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .order-vendor {
            color: #666;
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
        }

        .order-status-section {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* =========================
           Status Styles
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

        .status-pending {
            background: rgba(255, 165, 2, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 165, 2, 0.3);
        }

        .status-processing {
            background: rgba(0, 123, 255, 0.1);
            color: #007bff;
            border: 1px solid rgba(0, 123, 255, 0.3);
        }

        .status-delivered {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success);
            border: 1px solid rgba(46, 213, 115, 0.3);
        }

        .status-cancelled {
            background: rgba(255, 71, 87, 0.1);
            color: var(--danger);
            border: 1px solid rgba(255, 71, 87, 0.3);
        }

        .status-form {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .status-select {
            padding: 0.4rem 0.8rem;
            border: 1px solid var(--light);
            border-radius: 6px;
            background: var(--white);
            color: var(--dark);
            font-size: 0.8rem;
            min-width: 120px;
        }

        .update-btn {
            padding: 0.4rem 0.8rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .update-btn:hover {
            background: var(--secondary);
        }

        /* =========================
           Vendor Information
        ========================= */
        .vendor-info {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-bottom: 1px solid var(--light);
        }

        .vendor-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .vendor-detail-item {
            display: flex;
            flex-direction: column;
        }

        .vendor-label {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.25rem;
        }

        .vendor-value {
            font-weight: 500;
        }

        /* =========================
           Products List
        ========================= */
        .order-products {
            padding: 1.5rem;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--light);
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--light);
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .product-category {
            color: #666;
            font-size: 0.8rem;
            margin-bottom: 0.25rem;
        }

        .product-description {
            color: #666;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }

        .product-quantity {
            color: #666;
            font-size: 0.9rem;
        }

        .product-price {
            font-weight: 600;
            color: var(--primary);
            text-align: right;
        }

        .price-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.25rem;
        }

        .product-subtotal {
            font-weight: 600;
            color: var(--primary);
            font-size: 1rem;
        }

        .order-total {
            padding: 1rem 1.5rem;
            background: var(--light);
            text-align: right;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
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

            .orders-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .orders-stats {
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

            .order-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .order-info {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .vendor-details {
                grid-template-columns: 1fr;
            }

            .product-item {
                flex-direction: column;
                text-align: center;
            }

            .price-section {
                align-items: center;
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

            .orders-stats {
                flex-wrap: wrap;
            }

            .stat-card {
                flex: 1;
                min-width: calc(50% - 0.5rem);
            }
        }
    </style>
</head>

<body>
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
                    <h1 class="page-title">Orders Management</h1>
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

            <!-- Success/Error Messages -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    Order status updated successfully!
                </div>
            <?php endif; ?>

            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <!-- Orders Header -->
            <div class="orders-header">
                <div class="header-left">
                    <h1>Shopkeeper Orders</h1>
                    <p>Manage and track all shopkeeper orders</p>
                </div>
                <div class="orders-stats">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo count($groupedOrders); ?></div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php echo count(array_filter($groupedOrders, function ($order) {
                                return $order['status'] === 'pending';
                            })); ?>
                        </div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">
                            <?php echo count(array_filter($groupedOrders, function ($order) {
                                return $order['status'] === 'delivered';
                            })); ?>
                        </div>
                        <div class="stat-label">Delivered</div>
                    </div>
                </div>
            </div>

            <!-- Orders Container -->
            <div class="orders-container">
                <div class="table-header">
                    <h3 class="table-title">Order List</h3>
                    <div class="table-actions">
                        <select class="filter-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <input type="text" class="search-box" placeholder="Search orders..." id="searchOrders">
                    </div>
                </div>

                <?php if (count($groupedOrders) > 0): ?>
                    <div class="order-cards" id="orderCards">
                        <?php foreach ($groupedOrders as $orderId => $order): ?>
                            <div class="order-card" data-status="<?php echo $order['status']; ?>" data-orderid="<?php echo $orderId; ?>">
                                <!-- Order Header -->
                                <div class="order-header">
                                    <div class="order-info">
                                        <div class="order-id">Order #<?php echo htmlspecialchars($orderId); ?></div>
                                        <div class="order-vendor">Vendor: <?php echo htmlspecialchars($order['shop_name']); ?></div>
                                        <div class="order-date"><?php echo date('M j, Y g:i A', strtotime($order['created_at'])); ?></div>
                                    </div>
                                    <div class="order-status-section">
                                        <span class="status-badge status-<?php echo htmlspecialchars($order['status']); ?>">
                                            <?php echo ucfirst(htmlspecialchars($order['status'])); ?>
                                        </span>
                                        <form method="POST" class="status-form">
                                            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
                                            <select name="status" class="status-select" onchange="this.form.submit()">
                                                <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="processing" <?php echo $order['status'] === 'processing' ? 'selected' : ''; ?>>Processing</option>
                                                <option value="delivered" <?php echo $order['status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                                <option value="cancelled" <?php echo $order['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                            </select>
                                            <input type="hidden" name="update_status" value="1">
                                        </form>
                                    </div>
                                </div>

                                <!-- Vendor Information -->
                                <div class="vendor-info">
                                    <div class="vendor-details">
                                        <div class="vendor-detail-item">
                                            <span class="vendor-label">Shop Name</span>
                                            <span class="vendor-value"><?php echo htmlspecialchars($order['shop_name']); ?></span>
                                        </div>
                                        <div class="vendor-detail-item">
                                            <span class="vendor-label">Owner</span>
                                            <span class="vendor-value"><?php echo htmlspecialchars($order['vendor_name']); ?></span>
                                        </div>
                                        <div class="vendor-detail-item">
                                            <span class="vendor-label">Contact</span>
                                            <span class="vendor-value"><?php echo htmlspecialchars($order['vendor_phone']); ?></span>
                                        </div>
                                        <div class="vendor-detail-item">
                                            <span class="vendor-label">Location</span>
                                            <span class="vendor-value"><?php echo htmlspecialchars($order['shop_location']); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products List -->
                                <div class="order-products">
                                    <?php foreach ($order['products'] as $product): ?>
                                        <div class="product-item">
                                            <img src="<?php echo htmlspecialchars($product['product_image'] ?: 'https://via.placeholder.com/60x60?text=No+Image'); ?>"
                                                alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                                                class="product-image">
                                            <div class="product-details">
                                                <div class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></div>
                                                <div class="product-category"><?php echo htmlspecialchars($product['product_category']); ?></div>
                                                <div class="product-description"><?php echo htmlspecialchars($product['product_description']); ?></div>
                                                <div class="product-quantity">Quantity: <?php echo $product['quantity']; ?></div>
                                            </div>
                                            <div class="price-section">
                                                <div class="product-price">₹<?php echo number_format($product['product_price'], 2); ?></div>
                                                <div class="product-subtotal">₹<?php echo number_format($product['subtotal'], 2); ?></div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <div class="price-section">
                                            Tax Amount: ₹<?php
                                                            $subTotal = $order['total_amount'];
                                                            $tax = round((($subTotal + 40) * 0.05), 2);
                                                            echo number_format($tax); ?>
                                        </div>
                                </div>

                                <!-- Order Total -->
                                <div class="order-total">
                                    Total Amount: ₹<?php echo number_format($order['total_amount'] + $tax); ?>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h3>No Orders Found</h3>
                        <p>There are no orders placed by shopkeepers yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar on mobile
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.querySelector('.sidebar');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });

            // Filter orders by status
            const statusFilter = document.getElementById('statusFilter');
            const searchBox = document.getElementById('searchOrders');
            const orderCards = document.querySelectorAll('.order-card');

            function filterOrders() {
                const statusValue = statusFilter.value.toLowerCase();
                const searchValue = searchBox.value.toLowerCase();

                orderCards.forEach(card => {
                    const status = card.getAttribute('data-status');
                    const orderId = card.getAttribute('data-orderid').toLowerCase();

                    const statusMatch = !statusValue || status === statusValue;
                    const searchMatch = !searchValue || orderId.includes(searchValue);

                    card.style.display = statusMatch && searchMatch ? 'block' : 'none';
                });
            }

            statusFilter.addEventListener('change', filterOrders);
            searchBox.addEventListener('input', filterOrders);

            // Auto-submit status forms when selection changes
            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('change', function() {
                    this.closest('form').submit();
                });
            });
        });
    </script>
</body>

</html>