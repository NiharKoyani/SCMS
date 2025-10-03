<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$shopkeeperId = $_SESSION['shopkeeper_id'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="top-nav.css">
    <style>
        /* CSS Variables */
        :root {
            --primary: #09122c;
            --primary-light: #ff8e8e;
            --primary-dark: #596792;
            --secondary: #11204be0;
            --accent: #ffa502;
            --dark: #2f3542;
            --light: #f3f4f6;
            --white: #ffffff;
            --success: #2ed573;
            --warning: #ffa502;
            --danger: #ff4757;
            --sidebar-width: 280px;

            /* Additional variables from second stylesheet */
            --primary-color: #4f46e5;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
        }

        /* Reset and Base Styles */
        body {
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Dashboard Layout */
        .dashboard {
            display: flex;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: var(--text-color);
            margin: 0;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 6px;
            padding: 8px 12px;
            width: 300px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            padding: 4px;
        }

        /* Orders Container */
        .orders-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            background-color: var(--secondary-color);
        }

        .order-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .order-detail {
            display: flex;
            flex-direction: column;
        }

        .order-detail label {
            font-size: 12px;
            color: var(--light-text);
            margin-bottom: 4px;
        }

        .order-detail span {
            font-weight: 500;
        }

        .order-id {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-delivered {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Order Items */
        .order-items {
            padding: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            object-fit: cover;
            margin-right: 15px;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .item-price {
            color: var(--light-text);
            font-size: 14px;
        }

        .item-quantity {
            color: var(--light-text);
            font-size: 14px;
        }

        /* Order Footer */
        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-top: 1px solid var(--border-color);
            background-color: var(--secondary-color);
        }

        .order-total {
            font-weight: 600;
            font-size: 18px;
        }

        .reorder-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .reorder-btn:hover {
            background-color: #4338ca;
        }

        .reorder-btn:disabled {
            background-color: var(--light-text);
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-orders {
            text-align: center;
            padding: 60px 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .empty-orders i {
            font-size: 64px;
            color: var(--light-text);
            margin-bottom: 20px;
        }

        .empty-orders h3 {
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .empty-orders p {
            color: var(--light-text);
            margin-bottom: 20px;
        }

        .shop-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--accent-color);
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Responsive Styles */
        @media (max-width: 900px) {
            .main-content {
                margin-left: 80px;
            }

            .order-header,
            .order-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .order-info {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<?php
require_once('../Utility/db.php');

$ordersId = [];
$sql = "SELECT DISTINCT orderId FROM orders WHERE shopkeeper_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $shopkeeperId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $ordersId[] = $row['orderId'];
}

$stmt->close();
?>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <?php include('./src/sidebar.php'); ?>

        <!-- Main content -->
        <main class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <div class="nav-left">
                    <button class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Recent Orders</h1>
                </div>
                <div class="nav-right">
                    <button class="notification-btn">
                        <a style="text-decoration: none; color:black; " href="./cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="notification-badge"><?php echo $_SESSION['total-item-in-cart'] ?></span>
                        </a>
                    </button>
                    <button class="profile-btn">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Profile" class="profile-img">
                    </button>
                </div>
            </nav>

            <!-- Orders Container -->
            <div class="orders-container" id="ordersContainer">
                <?php if (empty($ordersId)): ?>
                    <!-- Empty State -->
                    <div class="empty-orders" id="emptyOrders">
                        <i class="fas fa-shopping-bag"></i>
                        <h3>No Orders Yet</h3>
                        <p>You haven't placed any orders yet. Start shopping to see your orders here.</p>
                        <button class="shop-btn" id="shopBtn">Start Shopping</button>
                    </div>
                <?php else: ?>
                    <?php foreach ($ordersId as $orderId): 
                        // Fetch products for this order
                        $products = [];
                        $productSql = "SELECT * FROM orders WHERE orderId = ? AND shopkeeper_id = ?";
                        $productStmt = $conn->prepare($productSql);
                        $productStmt->bind_param("si", $orderId, $shopkeeperId);
                        $productStmt->execute();
                        $productResult = $productStmt->get_result();
                        while ($productRow = $productResult->fetch_assoc()) {
                            $products[] = $productRow;
                        }
                        $productStmt->close();

                        $dateTime = $products[0]['created_at'];
                        $status = $products[0]['status'];
                        $totalAmount = $products[0]['total'];

                        // Format date and time
                        list($date, $time) = explode(' ', $dateTime);
                        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
                        $formattedDate = $dateObj ? $dateObj->format('d-m-Y') : $date;

                        // Determine status class
                        $statusClass = '';
                        switch ($status) {
                            case 'delivered':
                                $statusClass = 'status-delivered';
                                break;
                            case 'processing':
                                $statusClass = 'status-processing';
                                break;
                            case 'pending':
                                $statusClass = 'status-pending';
                                break;
                            case 'cancelled':
                                $statusClass = 'status-cancelled';
                                break;
                            default:
                                $statusClass = 'status-pending';
                        }
                    ?>
                        <div class="order-card" data-order-id="<?php echo $orderId; ?>">
                            <div class="order-header">
                                <div class="order-info">
                                    <div class="order-detail">
                                        <label>ORDER NUMBER</label>
                                        <span class="order-id">#ORD-<?php echo $orderId; ?></span>
                                    </div>
                                    <div class="order-detail">
                                        <label>DATE OF PLACED</label>
                                        <span><?php echo $formattedDate; ?></span>
                                    </div>
                                    <div class="order-detail">
                                        <label>TIME OF PLACED</label>
                                        <span><?php echo $time; ?></span>
                                    </div>
                                    <div class="order-detail">
                                        <label>STATUS</label>
                                        <span class="status-badge <?php echo $statusClass; ?>">
                                            <?php echo ucfirst($status); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="order-items">
                                <?php foreach ($products as $product): 
                                    $productId = $product['product_id'];
                                    $productDetails = [];
                                    $productQuery = "SELECT * FROM products WHERE id = ?";
                                    $productStmt = $conn->prepare($productQuery);
                                    $productStmt->bind_param("i", $productId);
                                    $productStmt->execute();
                                    $productResult = $productStmt->get_result();
                                    if ($productResult && $productResult->num_rows > 0) {
                                        $productDetails = $productResult->fetch_assoc();
                                    }
                                    $productStmt->close();
                                ?>
                                    <div class="order-item">
                                        <img src="<?php echo $productDetails['image'] ?? 'https://via.placeholder.com/60'; ?>" 
                                             alt="<?php echo $productDetails['name'] ?? 'Product Image'; ?>" 
                                             class="item-image">
                                        <div class="item-details">
                                            <div class="item-name"><?php echo $productDetails['name'] ?? 'Product Name'; ?></div>
                                            <div class="item-price">₹ <?php echo $productDetails['price'] ?? '0'; ?></div>
                                        </div>
                                        <div class="item-quantity">Qty: <?php echo $product['quantity']; ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="order-footer">
                                <div class="order-total">Total: ₹ <?php echo $totalAmount; ?></div>
                                <button class="reorder-btn" <?php echo $status === 'cancelled' ? 'disabled' : ''; ?>>
                                    <i class="fas fa-redo-alt"></i>
                                    Re-order
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Items added to cart successfully!</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const ordersContainer = document.getElementById('ordersContainer');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const shopBtn = document.getElementById('shopBtn');

            // Show toast notification
            function showToast(message) {
                toastMessage.textContent = message;
                toast.classList.add('show');

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }

            // Setup event listeners
            function setupEventListeners() {
                // Re-order buttons
                ordersContainer.addEventListener('click', function(e) {
                    if (e.target.classList.contains('reorder-btn') || e.target.closest('.reorder-btn')) {
                        const reorderBtn = e.target.classList.contains('reorder-btn') ? e.target : e.target.closest('.reorder-btn');

                        if (reorderBtn.disabled) return;

                        const orderCard = reorderBtn.closest('.order-card');
                        const orderId = orderCard.dataset.orderId;

                        // In a real app, this would add items to cart
                        showToast('Items from order ' + orderId + ' have been added to your cart!');

                        // Visual feedback
                        reorderBtn.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
                        reorderBtn.style.backgroundColor = '#10b981';

                        setTimeout(() => {
                            reorderBtn.innerHTML = '<i class="fas fa-redo-alt"></i> Re-order';
                            reorderBtn.style.backgroundColor = '';
                        }, 2000);
                    }
                });

                // Shop button
                if (shopBtn) {
                    shopBtn.addEventListener('click', function() {
                        // In a real app, this would navigate to shop
                        alert('Navigating to shop...');
                    });
                }
            }

            // Initialize the app
            setupEventListeners();
        });
    </script>
</body>
</html>