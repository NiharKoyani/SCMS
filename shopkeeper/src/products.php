<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Products - Vendor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            --primary-color: #000000ff;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Main content area */
        /* .main-content {
            flex: 1;
            padding: 30px;
        } */

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

        /* Product grid for purchasing */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 21rem;
            object-fit: cover;
            border-bottom: 1px solid var(--border-color);
        }

        .product-details {
            padding: 16px;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .product-supplier {
            color: var(--light-text);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .product-price {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 12px;
            color: var(--primary-color);
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: var(--light-text);
            margin-bottom: 16px;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        .quantity-btn {

            background: none;
            border: none;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 16px;
            color: var(--light-text);
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            border-left: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            padding: 0 5px;
        }

        .add-to-cart {
            flex: 1;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0 12px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* Categories filter */
        .categories {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .category-btn {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 8px 16px;
            cursor: pointer;
            white-space: nowrap;
        }

        .category-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Cart summary sticky bar */
        .cart-summary {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 100%;
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .cart-count {
            background-color: var(--primary-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .checkout-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 25px;
            cursor: pointer;
            font-weight: 500;
        }
    </style>
    <style>
        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background-color: var(--white);
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
            background-color: var(--danger);
            color: var(--white);
            width: 15px;
            height: 15px;
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
    </style>
    <style>
        /* Hide spinner arrows for Chrome, Safari, Edge, Opera */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Hide spinner arrows for Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<?php
session_start();

$conn = new mysqli("localhost", "root", "", "scms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[$row['id']] = $row;
    }
}

// Handle AJAX add-to-cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax']) && $_POST['ajax'] === '1') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $qty = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
    $success = false;
    if (isset($products[$id]) && $qty > 0) {
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'name' => $products[$id]['name'],
                'price' => $products[$id]['price'],
                'quantity' => 0
            ];
        }
        $_SESSION['cart'][$id]['quantity'] += $qty;
        $success = true;
    }
    // Calculate total cart quantity
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['quantity'];
        }
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'cartCount' => $total]);
    $conn->close();
    exit;
}

function getCartQuantityCount()
{
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['quantity'];
    }
    return $total;
}

$conn->close();
?>

<body>
    <div class="dashboard">
        <?php include('./sidebar.php'); ?>
        <main class="main-content">
            <!-- Main content -->
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
                        <a style="text-decoration: none; color:black; " href="./cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="notification-badge"><?php echo getCartQuantityCount(); ?></span>
                        </a>
                    </button>
                    <button class="profile-btn">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Profile" class="profile-img">
                    </button>
                </div>
            </nav>

            <!-- Categories filter -->
            <div class="categories">
                <button class="category-btn active">RAPID REHYDRATION</button>
                <button class="category-btn">ICE HYDRATION</button>
                <button class="category-btn">HYDRATION</button>
                <button class="category-btn">ENERGY</button>
                <button class="category-btn">HYDRATION+ STICKS</button>
            </div>

            <!-- Products grid -->
            <!-- <div class="products-grid"></div> -->
            <div class="products-grid">
                <?php foreach ($products as $product) : ?>
                    <form class="product-card add-to-cart-form" method="post" autocomplete="off">
                        <input hidden type="number" name="id" value="<?php echo $product['id'] ?>">
                        <img src="<?php echo htmlspecialchars($product['image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($product['title'] ?? ''); ?>" class="product-image">
                        <div class="product-details">
                            <div class="product-title"><?php echo htmlspecialchars($product['name'] ?? ''); ?></div>
                            <div class="product-supplier"><?php echo htmlspecialchars($product['description'] ?? ''); ?></div>
                            <div class="product-price">₹<?php echo number_format($product['price'] ?? 0); ?></div>
                            <div class="product-meta">
                                <span>MOQ: <?php echo htmlspecialchars($product['moq'] ?? ''); ?> units</span>
                                <span>In stock: <?php echo htmlspecialchars($product['stock'] ?? ''); ?></span>
                            </div>
                            <div class="product-actions">
                                <div class="quantity-control">
                                    <button type="button" class="quantity-btn">-</button>
                                    <input type="number" class="quantity-input" value="5" name="quantity" min="5" max="99">
                                    <button type="button" class="quantity-btn">+</button>
                                </div>
                                <button type="submit" class="add-to-cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 2L3 6V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V6L18 2H6Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3 6H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16 10C16 11.0609 15.5786 12.0783 14.8284 12.8284C14.0783 13.5786 13.0609 14 12 14C10.9391 14 9.92172 13.5786 9.17157 12.8284C8.42143 12.0783 8 11.0609 8 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
<script>
    // Quantity controls
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.product-card').forEach(function(card) {
            const minusBtn = card.querySelector('.quantity-btn:first-child');
            const plusBtn = card.querySelector('.quantity-btn:last-child');
            const input = card.querySelector('.quantity-input');
            const max = parseInt(input.getAttribute('max')) || 99;
            const min = parseInt(input.getAttribute('min')) || 1;

            minusBtn.addEventListener('click', function() {
                let value = parseInt(input.value) || min;
                if (value > min) input.value = value - 1;
            });

            plusBtn.addEventListener('click', function() {
                let value = parseInt(input.value) || min;
                if (value < max) input.value = value + 1;
            });

            input.addEventListener('input', function() {
                let value = parseInt(input.value) || min;
                if (value < min) input.value = min;
                if (value > max) input.value = max;
            });
        });

        // AJAX add-to-cart
        document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);
                formData.append('ajax', '1');
                fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Update cart badge
                        const badge = document.querySelector('.notification-badge');
                        if (badge) badge.textContent = data.cartCount;
                    } else {
                        alert('Failed to add to cart.');
                    }
                })
                .catch(() => alert('Error adding to cart.'));
            });
        });
    });
</script>

</html>