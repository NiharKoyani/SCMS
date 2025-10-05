<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$currentUser = $_SESSION['shopkeeper_id'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Vendor Dashboard</title>
    <link rel="stylesheet" href="../../styles/main.css">

    <style>
        /* ---------- CSS Variables ---------- */
        :root {
            /* Page palette */
            --primary-color: #4f46e5;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
            --danger-color: #ef4444;

            /* Shared vendor palette */
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

        /* ---------- Reset & Body ---------- */


        body {
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: #09122c;
        }

        /* ---------- Layout ---------- */
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

        .container {
            display: flex;
            min-height: 100vh;
        }

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

        .back-btn {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 8px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ---------- Cart Table ---------- */
        .cart-table {
            width: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 16px 20px;
            background-color: var(--secondary-color);
            color: var(--light-text);
            font-weight: 500;
            font-size: 14px;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-img {
            width: 60px;
            height: 60px;
            border-radius: 4px;
            object-fit: cover;
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

        .remove-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--light-text);
        }

        .remove-btn:hover {
            color: var(--danger-color);
        }

        /* ---------- Order Summary ---------- */
        .order-summary {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .summary-total {
            font-weight: 600;
            font-size: 18px;
            border-top: 1px solid var(--border-color);
            padding-top: 12px;
            margin-top: 12px;
        }

        .checkout-btn {
            width: 100%;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px;
            margin-top: 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .shop-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            font-weight: 500;
        }

        /* ---------- Number Input Spinner Removal ---------- */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <style>
        /* Add this to your existing CSS */

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            width: fit-content;
            /* Add this */
        }

        .quantity-btn {
            background: none;
            border: none;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 16px;
            color: var(--light-text);
            display: flex;
            /* Add this */
            align-items: center;
            /* Add this */
            justify-content: center;
            /* Add this */
            padding: 0;
            /* Add this */
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            border-left: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            padding: 0 5px;
            margin: 0;
            /* Add this */
        }

        /* Fix the form styling */
        form {
            margin: 0;
            padding: 0;
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
$sql = "SELECT * FROM cart_items WHERE shopkeeper_id=$currentUser";
$result = $conn->query($sql);
$products = [];
foreach ($result as $row) {
    $ProdId = $row['product_id'];
    $sqlProd = "SELECT * FROM products WHERE id=$ProdId";
    $results = $conn->query($sqlProd);
    if ($results && $results->num_rows > 0) {
        while ($rows = $results->fetch_assoc()) {
            $products[$rows['id']] = $rows;
            $products[$rows['id']]['quantity'] = $row['quantity'];
            $products[$rows['id']]['productId'] = $row['product_id'];
        }
    }
}

$subTotal = 0;
foreach ($products as $product) {
    $subTotal += ($product['price'] ?? 0) * ($product['quantity'] ?? 0);
}
$shipping = 0;
$tax = round(($subTotal + 40) * 0.05, 2);
$totalFloting = round(($subTotal + $shipping + $tax), 2);
$total = round($totalFloting);
$roundsUp = round($total - $totalFloting, 2);
?>

<body>
    <div class="dashboard">
        <?php include('../util/sidebar.php'); ?>
        <main class="main-content">

            <div class="header">
                <h1>My Purchase Cart</h1>
                <a href="./products.php" class="back-btn" id="backToProducts">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back to Products
                </a>
            </div>

            <!-- Cart Items -->
            <!-- Replace the entire table section with this -->
            <div class="cart-table" id="cartTable">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cartItems">
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="<?php echo htmlspecialchars($product['image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" class="product-img">
                                        <span><?php echo htmlspecialchars($product['name'] ?? ''); ?></span>
                                    </div>
                                </td>
                                <td>₹<?php echo htmlspecialchars($product['price'] ?? ''); ?></td>
                                <td>
                                    <form action="../server/update-cart.php" method="POST" style="display: inline;">
                                        <input type="number" hidden value="<?php echo htmlspecialchars($product['id'] ?? ''); ?>" name="productId">
                                        <input type="number" hidden value="<?php echo $_SESSION['shopkeeper_id'] ?>" name="shopkeeper_id">
                                        <div class="quantity-control">
                                            <button type="submit" class="quantity-btn" name="action" value="decrease">-</button>
                                            <input type="number" class="quantity-input" value="<?php echo htmlspecialchars($product['quantity'] ?? ''); ?>" name="quantity" min="6" max="51" readonly>
                                            <button type="submit" class="quantity-btn" name="action" value="increase">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="item-subtotal">₹<?php echo htmlspecialchars($product['price'] * $product['quantity']); ?></td>
                                <td>
                                    <a href="../server/delete-product-from-cart.php?remove=<?php echo $product['productId'] ?>" class="remove-btn">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Order Summary -->
            <div class="order-summary" id="orderSummary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">₹ <?php echo $subTotal ?></span>
                </div>
                <!-- <div class="summary-row">
                        <span>Shipping</span>
                        <span id="shipping">₹ <?php echo $shipping ?></span>
                    </div> -->
                <div class="summary-row">
                    <span>Tax (5%)</span>
                    <span id="tax">₹ <?php echo $tax ?></span>
                </div>
                <div class="summary-row">
                    <span>Rounds Up</span>
                    <span id="roundsUp">₹ <?php echo $roundsUp ?></span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span id="total">₹ <?php echo $total ?></span>
                </div>
                <form action="./src/order-submit.php" method="post">
                    <input hidden type="text" value="<?php echo $product['categoryCode'] ?>" name="categoryCode">
                    <input hidden type="number" value="<?php echo $total ?>" name="total">
                    <button type="submit" class="checkout-btn" id="checkoutBtn">Proceed to Checkout</button>
                </form>
            </div>
    </div>

    <!-- Empty Cart State -->
    <div class="empty-cart" id="emptyCart" style="display: <?php echo count($products) > 0 ? 'none' : null ?>;">
        <h3>Your Cart is Empty</h3>
        <p>You haven't added any products to your purchase cart yet.</p>
        <a href='./products.php'><button class="shop-btn" id="shopBtn">Browse Products</button></a>
    </div>
    </main>
    </div>
    <script>
        // Quantity controls
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-control').forEach(function(control) {
                const minusBtn = control.querySelector('.quantity-btn:first-child');
                const plusBtn = control.querySelector('.quantity-btn:last-child');
                const input = control.querySelector('.quantity-input');

                const max = parseInt(input.getAttribute('max')) || 51;
                const min = parseInt(input.getAttribute('min')) || 6;

            });
        });
    </script>
</body>

</html>