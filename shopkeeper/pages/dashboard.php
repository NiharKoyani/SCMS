<?php
// include('./index.php');

error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

session_start();
if (!isset($_SESSION['shopkeeper_id'])) {
  // Redirect to login page or show an error message
  header('Location: ../login.php');
  exit();
}
$shopkeeperId = $_SESSION['shopkeeper_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRIME - Vendor Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="./Styling Area/dashboard.css">
  <link rel="stylesheet" href="../../styles/main.css">
</head>
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
    background: var(--light);
    color: var(--dark);
    min-height: 100vh;
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
   Dashboard Widgets
 ========================= */
  .dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
  }

  .widget {
    background: var(--white);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .widget:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .widget::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 100%;
    background: linear-gradient(to bottom, var(--primary), var(--secondary));
  }

  .widget-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
  }

  .widget-title {
    font-size: 1rem;
    font-weight: 500;
    color: #666;
  }

  .widget-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 107, 107, 0.1);
    color: var(--primary);
  }

  .widget-icon .fas {
    font-size: 1.4rem;
  }

  .widget-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }

  .widget-change {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.9rem;
  }

  .change-up {
    color: var(--success);
  }

  .change-down {
    color: var(--danger);
  }

  /* =========================
   Sales Chart
 ========================= */
  .sales-chart {
    background: var(--white);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
  }

  .chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
  }

  .chart-title {
    font-size: 1.2rem;
    font-weight: 600;
  }

  .chart-period {
    display: flex;
    gap: 0.5rem;
  }

  .period-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 6px;
    background: var(--light);
    color: var(--dark);
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .period-btn.active {
    background: var(--primary);
    color: var(--white);
  }

  .chart-container {
    height: 300px;
    position: relative;
  }

  /* =========================
   Recent Orders Table
 ========================= */
  .recent-orders {
    background: var(--white);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  }

  .orders-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
  }

  .orders-title {
    font-size: 1.2rem;
    font-weight: 600;
  }

  .view-all {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .view-all:hover {
    text-decoration: underline;
  }

  .orders-table {
    width: 100%;
    border-collapse: collapse;
  }

  .orders-table th {
    text-align: left;
    padding: 0.8rem 1rem;
    font-weight: 500;
    color: #666;
    border-bottom: 1px solid var(--light);
  }

  .orders-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--light);
    vertical-align: middle;
  }

  /* order status */

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

  /* =========================
   Product Bottle Animation
 ========================= */
  .product-animation {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 50;
  }

  .product-bottle {
    width: 60px;
    height: 100px;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
    right: 3rem;
  }

  .product-bottle:hover {
    transform: translateY(-10px) rotate(5deg);
  }

  .bottle-body {
    width: 100%;
    height: 80px;
    background: linear-gradient(to bottom, rgba(101, 101, 101, 0.8), rgba(255, 255, 255, 0.5));
    border-radius: 5px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .bottle-liquid {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60%;
    background: linear-gradient(to top, var(--primary), var(--secondary));
    transition: all 2s ease;
  }

  .bottle-neck {
    width: 30%;
    height: 20px;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7));
    margin: 0 auto;
    border-radius: 3px 3px 0 0;
  }

  .bubble-animation {
    position: absolute;
    width: 100%;
    height: 100%;
  }

  .mini-bubble {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    bottom: 0;
    animation: bubble-up 4s infinite ease-in;
  }

  @keyframes bubble-up {
    0% {
      transform: translateY(0);
      opacity: 0;
    }

    20% {
      opacity: 1;
    }

    100% {
      transform: translateY(-80px);
      opacity: 0;
    }
  }

  /* =========================
   Responsive
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

    .nav-right {
      gap: 1rem;
    }

    .orders-table {
      display: block;
      overflow-x: auto;
    }

    .product-animation {
      bottom: 1rem;
      right: 1rem;
    }

    .product-bottle {
      width: 50px;
      height: 80px;
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

    .dashboard-grid {
      grid-template-columns: 1fr;
    }

    .chart-period {
      flex-wrap: wrap;
      justify-content: flex-end;
    }
  }
</style>
<?php
include('../../Utility/db.php');
$ordersId = [];
$sql = "SELECT DISTINCT orderId FROM orders WHERE shopkeeper_id = ? ORDER BY created_at DESC LIMIT 5";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $shopkeeperId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  $ordersId[] = $row['orderId'];
}

$totalDue = 0;
foreach ($ordersId as $eachOrdersId) {
  $dueSql = "SELECT total as total_due FROM orders WHERE shopkeeper_id = ? AND orderId = ? AND status = 'processing' LIMIT 1";
  $dueStmt = $conn->prepare($dueSql);
  $dueStmt->bind_param("is", $shopkeeperId, $eachOrdersId);
  $dueStmt->execute();
  $dueStmt->bind_result($total_due);
  if ($dueStmt->fetch() && $total_due !== null) {
    $totalDue += $total_due;
  }
  $dueStmt->close();
}
$totalProducts = 0;

$productSql = "SELECT COUNT(*) as product_count FROM products";
$productStmt = $conn->prepare($productSql);
$productStmt->execute();
$productStmt->bind_result($product_count);
if ($productStmt->fetch()) {
  $totalProducts = $product_count;
}
$productStmt->close();

$stmt->close();


$totalOrder = sizeof($ordersId);
?>

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
            <h3 class="widget-title">Total Due Amount</h3>
            <div class="widget-icon">
              <i class="fas">₹</i>
            </div>
          </div>
          <div class="widget-value">₹ <?php echo number_format($totalDue) ?></div>
          <div class="widget-change change-up">
            <!-- <i class="fas fa-arrow-up"></i>
            <span>12.5% from last month</span> -->
          </div>
        </div>

        <div class="widget">
          <div class="widget-header">
            <h3 class="widget-title">Total Orders</h3>
            <div class="widget-icon">
              <i class="fas fa-shopping-bag"></i>
            </div>
          </div>
          <div class="widget-value"><?php echo $totalOrder ?></div>
          <div class="widget-change change-up">
            <!-- <i class="fas fa-arrow-up"></i>
            <span>8.3% from last month</span> -->
          </div>
        </div>

        <div class="widget">
          <div class="widget-header">
            <h3 class="widget-title">Products</h3>
            <div class="widget-icon">
              <i class="fas fa-box-open"></i>
            </div>
          </div>
          <div class="widget-value"><?php echo $totalProducts ?></div>
          <div class="widget-change change-down">
            <!-- <i class="fas fa-arrow-down"></i>
            <span>2 items out of stock</span> -->
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
              <th>Date</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
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

              <tr>
                <td>#ORD-<?php echo $orderId; ?></td>
                <td><?php echo $formattedDate; ?></td>
                <td>₹ <?php echo number_format($totalAmount); ?></td>
                <td><span class="order-status <?php echo $statusClass; ?>"><?php echo ucfirst($status); ?></span></td>

              </tr>

            <?php endforeach; ?>


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

          // Create bottle bubbles
          const bubbleAnimation = document.querySelector('.bubble-animation');
          for (let i = 0; i < 5; i++) {
            const bubble = document.createElement('div');
            bubble.className = 'mini-bubble';
            bubble.style.left = Math.random() * 80 + 10 + '%';
            bubble.style.animationDelay = Math.random() * 3 + 's';
            bubble.style.animationDuration = 2 + Math.random() * 3 + 's';
            bubbleAnimation.appendChild(bubble);
          }

          // Toggle sidebar on mobile
          const menuToggle = document.querySelector('.menu-toggle');
          const sidebar = document.querySelector('.sidebar');

          menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
          });

          // Animate bottle liquid
          const bottleLiquid = document.querySelector('.bottle-liquid');
          let fillDirection = 1;

          function animateLiquid() {
            const currentHeight = parseFloat(bottleLiquid.style.height || '60%');
            let newHeight = currentHeight + fillDirection * 0.5;

            if (newHeight >= 80) fillDirection = -1;
            if (newHeight <= 40) fillDirection = 1;

            bottleLiquid.style.height = newHeight + '%';
            requestAnimationFrame(animateLiquid);
          }

          animateLiquid();

          // Add bubbles periodically
          setInterval(() => {
            const bubble = document.createElement('div');
            bubble.className = 'mini-bubble';
            bubble.style.left = Math.random() * 80 + 10 + '%';
            bubble.style.animationDelay = '0s';
            bubble.style.animationDuration = 2 + Math.random() * 3 + 's';
            bubbleAnimation.appendChild(bubble);

            // Remove bubble after animation
            setTimeout(() => {
              bubble.remove();
            }, 5000);
          }, 800);

          // Chart period buttons
          const periodButtons = document.querySelectorAll('.period-btn');
          periodButtons.forEach((button) => {
            button.addEventListener('click', function() {
              periodButtons.forEach((btn) => btn.classList.remove('active'));
              this.classList.add('active');
            });
          });

          // Product bottle interaction
          const productBottle = document.querySelector('.product-bottle');
          productBottle.addEventListener('click', function() {
            // Create a burst of bubbles
            for (let i = 0; i < 10; i++) {
              const bubble = document.createElement('div');
              bubble.className = 'mini-bubble';
              bubble.style.left = Math.random() * 80 + 10 + '%';
              bubble.style.bottom = '20%';
              bubble.style.animationDuration = 1 + Math.random() * 2 + 's';
              bubble.style.width = '6px';
              bubble.style.height = '6px';
              bubbleAnimation.appendChild(bubble);

              // Remove bubble after animation
              setTimeout(() => {
                bubble.remove();
              }, 3000);
            }
          });
        });
      </script>
</body>

</html>