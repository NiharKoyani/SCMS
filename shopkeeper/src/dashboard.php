<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRIME - Vendor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Styling Area/dashboard.css">
</head>

<body>
    <div class="bubbles-bg">
        <!-- Bubbles will be added dynamically -->
    </div>

    <!-- <div class="dashboard"> -->
        <!-- Sidebar -->
        <!-- <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img style="width: 14rem;" src="../../Asserts/Prime-Logo.png" alt="">
                </div>
            </div>

            <ul class="sidebar-menu">
                <li class="menu-item active">
                    <a href="#" class="menu-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-box-open"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-store"></i>
                        <span>My Shop</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-users"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </aside> -->

        <!-- Main Content -->
        <!-- <main class="main-content"> -->
            <!-- Top Navigation -->
            <nav class="top-nav">
                <div class="nav-left">
                    <button class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Vendor Dashboard</h1>
                </div>
                <div class="nav-right">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <button class="profile-btn">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Profile" class="profile-img">
                    </button>
                </div>
            </nav>

            <!-- Dashboard Widgets -->
            <div class="dashboard-grid">
                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Total Revenue</h3>
                        <div class="widget-icon">
                            <i class="fas">₹</i>
                        </div>
                    </div>
                    <div class="widget-value">₹ 1,28,450</div>
                    <div class="widget-change change-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>12.5% from last month</span>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Total Orders</h3>
                        <div class="widget-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>
                    <div class="widget-value">324</div>
                    <div class="widget-change change-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>8.3% from last month</span>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Products</h3>
                        <div class="widget-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                    <div class="widget-value">42</div>
                    <div class="widget-change change-down">
                        <i class="fas fa-arrow-down"></i>
                        <span>2 items out of stock</span>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Customers</h3>
                        <div class="widget-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="widget-value">1,248</div>
                    <div class="widget-change change-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>56 new this week</span>
                    </div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="sales-chart">
                <div class="chart-header">
                    <h2 class="chart-title">Sales Overview</h2>
                    <div class="chart-period">
                        <button class="period-btn">Day</button>
                        <button class="period-btn active">Week</button>
                        <button class="period-btn">Month</button>
                        <button class="period-btn">Year</button>
                    </div>
                </div>
                <div class="chart-container">
                    <!-- Chart will be rendered here -->
                    <div style="width: 100%; height: 100%; background-color: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <p style="color: #666;">Sales chart visualization</p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="recent-orders">
                <div class="orders-header">
                    <h2 class="orders-title">Recent Orders</h2>
                    <a href="#" class="view-all">View All</a>
                </div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#BL-1042</td>
                            <td>Sarah Johnson</td>
                            <td>Today, 10:45 AM</td>
                            <td>₹ 84.50</td>
                            <td><span class="order-status status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#BL-1041</td>
                            <td>Michael Chen</td>
                            <td>Today, 09:30 AM</td>
                            <td>₹ 126.75</td>
                            <td><span class="order-status status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#BL-1040</td>
                            <td>Emily Rodriguez</td>
                            <td>Yesterday, 4:15 PM</td>
                            <td>₹ 58.90</td>
                            <td><span class="order-status status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#BL-1039</td>
                            <td>David Kim</td>
                            <td>Yesterday, 2:30 PM</td>
                            <td>₹ 215.40</td>
                            <td><span class="order-status status-cancelled">Cancelled</span></td>
                        </tr>
                        <tr>
                            <td>#BL-1038</td>
                            <td>Jessica Williams</td>
                            <td>Yesterday, 11:20 AM</td>
                            <td>₹ 72.30</td>
                            <td><span class="order-status status-completed">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- </main> -->
    <!-- </div> -->

    <!-- Floating Product Animation -->
    <div class="product-animation">
        <div class="product-bottle">
            <div class="bottle-neck"></div>
            <div class="bottle-body">
                <div class="bottle-liquid"></div>
                <div class="bubble-animation">
                    <!-- Bubbles will be added dynamically -->
                </div>
            </div>
        </div>
    </div>

    <script src="../src/Js File's/dashboard.js"></script>
</body>
</html>