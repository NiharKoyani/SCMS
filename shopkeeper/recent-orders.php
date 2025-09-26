<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

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
    </style>
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
            --danger-color: #ef4444;
        }


        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            color: var(--text-color);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: var(--text-color);
            font-size: 1.8rem;
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-tab {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 8px 16px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .filter-tab.active,
        .filter-tab:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Order cards */
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
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            background-color: var(--secondary-color);
        }

        .order-id {
            font-weight: 600;
            color: var(--primary-color);
        }

        .order-date {
            color: var(--light-text);
            font-size: 14px;
        }

        .order-status {
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

        .order-body {
            padding: 20px;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            gap: 15px;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 6px;
            object-fit: cover;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-price {
            color: var(--light-text);
            margin-bottom: 5px;
        }

        .item-quantity {
            color: var(--light-text);
            font-size: 14px;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
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
            padding: 8px 16px;
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

        /* Empty state */
        .empty-orders {
            text-align: center;
            padding: 60px 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .empty-orders i {
            font-size: 48px;
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

        /* Responsive styles */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filter-tabs {
                overflow-x: auto;
                width: 100%;
                padding-bottom: 10px;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .order-footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .reorder-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

</head>

<body>

    <div class="dashboard">
        <?php include('./src/sidebar.php'); ?>
        <main class="main-content">
            <!-- Page header -->
            <div class="page-header">
                <h1>My Orders</h1>
                <div class="filter-tabs">
                    <div class="filter-tab active">All Orders</div>
                    <div class="filter-tab">Pending</div>
                    <div class="filter-tab">Delivered</div>
                    <div class="filter-tab">Cancelled</div>
                </div>
            </div>

            <!-- Orders container -->
            <div class="orders-container">
                <!-- Order 1 -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-7842</div>
                            <div class="order-date">Placed on 12 Aug 2023</div>
                        </div>
                        <div class="order-status status-delivered">Delivered</div>
                    </div>

                    <div class="order-body">
                        <div class="order-items">
                            <div class="order-item">
                                <div class="item-image">
                                    <i class="fas fa-headphones fa-2x"></i>
                                </div>
                                <div class="item-details">
                                    <div class="item-name">Wireless Headphones Pro</div>
                                    <div class="item-price">₹3,499</div>
                                    <div class="item-quantity">Quantity: 1</div>
                                </div>
                            </div>

                            <div class="order-item">
                                <div class="item-image">
                                    <i class="fas fa-mobile-alt fa-2x"></i>
                                </div>
                                <div class="item-details">
                                    <div class="item-name">Phone Case - Premium</div>
                                    <div class="item-price">₹899</div>
                                    <div class="item-quantity">Quantity: 2</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-total">Total: ₹5,297</div>
                        <button class="reorder-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Reorder
                        </button>
                    </div>
                </div>

                <!-- Order 2 -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-7835</div>
                            <div class="order-date">Placed on 9 Aug 2023</div>
                        </div>
                        <div class="order-status status-processing">Processing</div>
                    </div>

                    <div class="order-body">
                        <div class="order-items">
                            <div class="order-item">
                                <div class="item-image">
                                    <i class="fas fa-tshirt fa-2x"></i>
                                </div>
                                <div class="item-details">
                                    <div class="item-name">Cotton T-Shirt (Pack of 3)</div>
                                    <div class="item-price">₹1,499</div>
                                    <div class="item-quantity">Quantity: 1</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-total">Total: ₹1,499</div>
                        <button class="reorder-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Reorder
                        </button>
                    </div>
                </div>

                <!-- Order 3 -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-7821</div>
                            <div class="order-date">Placed on 5 Aug 2023</div>
                        </div>
                        <div class="order-status status-delivered">Delivered</div>
                    </div>

                    <div class="order-body">
                        <div class="order-items">
                            <div class="order-item">
                                <div class="item-image">
                                    <i class="fas fa-book fa-2x"></i>
                                </div>
                                <div class="item-details">
                                    <div class="item-name">Programming Book Bundle</div>
                                    <div class="item-price">₹2,999</div>
                                    <div class="item-quantity">Quantity: 1</div>
                                </div>
                            </div>

                            <div class="order-item">
                                <div class="item-image">
                                    <i class="fas fa-mug-hot fa-2x"></i>
                                </div>
                                <div class="item-details">
                                    <div class="item-name">Insulated Coffee Mug</div>
                                    <div class="item-price">₹799</div>
                                    <div class="item-quantity">Quantity: 1</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-total">Total: ₹3,798</div>
                        <button class="reorder-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Reorder
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter tabs functionality
            const filterTabs = document.querySelectorAll('.filter-tab');

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // In a real app, this would filter the orders
                    console.log(`Filtering by: ${this.textContent}`);
                });
            });

            // Reorder buttons functionality
            const reorderButtons = document.querySelectorAll('.reorder-btn');

            reorderButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.closest('.order-card').querySelector('.order-id').textContent;

                    // Show confirmation message
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
                    this.style.backgroundColor = '#10b981';

                    // In a real app, this would add all items from the order to the cart
                    console.log(`Reordering: ${orderId}`);

                    // Reset button after 2 seconds
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.backgroundColor = '';
                    }, 2000);
                });
            });
        });
    </script>
</body>

</html>