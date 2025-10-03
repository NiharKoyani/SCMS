<!DOCTYPE html>
<html lang="en">
<?php
// include('./index.php');
session_start();
$currentUser = $_SESSION['shopkeeper_id'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Products - Vendor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="top-nav.css">

    <style>
        /* ---------- CSS Variables ---------- */
        :root {
            /* Original palette */
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

            /* Extra palette */
            --primary-color: #000000ff;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
        }

        /* ---------- Reset ---------- */

        body {
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ---------- Dashboard Layout ---------- */
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

        /* ---------- Product Grid ---------- */
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

        /* ---------- Categories Filter ---------- */
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

        /* ---------- Input Number Spinner Removal ---------- */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>


<?php

error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);


$conn = new mysqli("localhost", "root", "", "scms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['rapidRehydration'])) {
    $sql = "SELECT * FROM products WHERE category='RAPID REHYDRATION'";
} elseif (isset($_GET['iceHydration'])) {
    $sql = "SELECT * FROM products WHERE category='ICE HYDRATION'";
} elseif (isset($_GET['hydration'])) {
    $sql = "SELECT * FROM products WHERE category='HYDRATION'";
} elseif (isset($_GET['energy'])) {
    $sql = "SELECT * FROM products WHERE category='ENERGY'";
} elseif (isset($_GET['hydrationPlusSticks'])) {
    $sql = "SELECT * FROM products WHERE category='HYDRATION PLUS STICKS'";
} else {
    $sql = "SELECT * FROM products";
}

$result = $conn->query($sql);
$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[$row['id']] = $row;
    }
}

$sql = "SELECT * FROM cart_items WHERE shopkeeper_id='$currentUser'";
$result = $conn->query($sql);

$total_item_in_cart = 0;
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total_item_in_cart += $row['quantity'];
    }
}
$_SESSION['total-item-in-cart'] = $total_item_in_cart;
$conn->close();
?>

<body>
    <div class="dashboard">
        <?php include('./src/sidebar.php'); ?>
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
                            <span class="notification-badge"><?php echo $total_item_in_cart; ?></span>
                        </a>
                    </button>
                    <button class="profile-btn">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Profile" class="profile-img">
                    </button>
                </div>
            </nav>

            <!-- Categories filter -->
            <div class="categories">
                <a href="?rapidRehydration"><button class="category-btn <?php echo isset($_GET['rapidRehydration']) ? 'active' : null; ?>">RAPID REHYDRATION</button></a>
                <a href="?iceHydration"><button class="category-btn <?php echo isset($_GET['iceHydration']) ? 'active' : null; ?>">ICE HYDRATION</button></a>
                <a href="?hydration"><button class="category-btn <?php echo isset($_GET['hydration']) ? 'active' : null; ?>">HYDRATION</button></a>
                <a href="?energy"><button class="category-btn <?php echo isset($_GET['energy']) ? 'active' : null; ?>">ENERGY</button></a>
                <a href="?hydrationPlusSticks"><button class="category-btn <?php echo isset($_GET['hydrationPlusSticks']) ? 'active' : null; ?>">HYDRATION+ STICKS</button></a>
            </div>

            <!-- Products grid -->
            <div class="products-grid">
                <?php foreach ($products as $product) : ?>
                    <form class="product-card" action="./src/add_to_cart.php" method="post" autocomplete="off">
                        <input hidden type="number" name="id" value="<?php echo $product['id']  ?>">
                        <input hidden type="text" name="categoryCode" value="<?php echo $product['categoryCode']  ?>">
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
                                    <input type="number" class="quantity-input" value="6" name="quantity" min="6" max="99">
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
    <script>
        // Quantity controls
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.product-card').forEach(function(card) {
                const minusBtn = card.querySelector('.quantity-btn:first-child');
                const plusBtn = card.querySelector('.quantity-btn:last-child');
                const input = card.querySelector('.quantity-input');
                const max = parseInt(input.getAttribute('max')) || 99;
                const min = parseInt(input.getAttribute('min')) || 6;

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


        });
    </script>
</body>

</html>