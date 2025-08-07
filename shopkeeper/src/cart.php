<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Vendor Dashboard</title>
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

        /* Cart items table */
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

        /* Order summary */
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
    </style>
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
</head>

<body>
    <div class="dashboard">
        <?php include('./sidebar.php'); ?>
        <main class="main-content">

            <div class="header">
                <h1>My Purchase Cart</h1>
                <button class="back-btn" id="backToProducts">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back to Products
                </button>
            </div>

            <!-- Cart Items -->
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
                        <!-- Cart items will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Order Summary -->
            <div class="order-summary" id="orderSummary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">₹0</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span id="shipping">₹0</span>
                </div>
                <div class="summary-row">
                    <span>Tax (12%)</span>
                    <span id="tax">₹0</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span id="total">₹0</span>
                </div>
                <button class="checkout-btn" id="checkoutBtn">Proceed to Checkout</button>
            </div>

            <!-- Empty Cart State -->
            <div class="empty-cart" id="emptyCart" style="display: none;">
                <h3>Your Cart is Empty</h3>
                <p>You haven't added any products to your purchase cart yet.</p>
                <button class="shop-btn" id="shopBtn">Browse Products</button>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const cartItemsEl = document.getElementById('cartItems');
            const subtotalEl = document.getElementById('subtotal');
            const shippingEl = document.getElementById('shipping');
            const taxEl = document.getElementById('tax');
            const totalEl = document.getElementById('total');
            const checkoutBtn = document.getElementById('checkoutBtn');
            const backToProductsBtn = document.getElementById('backToProducts');
            const shopBtn = document.getElementById('shopBtn');
            const cartTable = document.getElementById('cartTable');
            const orderSummary = document.getElementById('orderSummary');
            const emptyCart = document.getElementById('emptyCart');

            // Cart state (in a real app, this would come from localStorage or API)
            let cart = {
                items: [{
                        id: 1,
                        title: "Orange Kream",
                        price: 1299,
                        quantity: 10,
                        image: "https://drinkprime.com/cdn/shop/files/OrangeKream_Web_DropBanner_PDP_Front_2000x2000_8b5dd6e8-169d-4332-84ef-e4028707c470_2000x.png?v=1752250151"
                    },
                    {
                        id: 2,
                        title: "PRIME COLLECTOR SERIES",
                        price: 499,
                        quantity: 12,
                        image: "https://drinkprime.com/cdn/shop/files/PRIME_hydration_1serve_16.9oz_US_CollectorSeries_00000_2000x.png?v=1748550723"
                    },
                    {
                        id: 3,
                        title: "Ocean Cherry",
                        price: 899,
                        quantity: 10,
                        image: "https://drinkprime.com/cdn/shop/files/PR_RapidRehydration_OC_Web_PDP_Front_2000x2000_a0a85545-b084-4303-86d8-5ced85a845b1_2000x.png?v=1747401501"
                    },
                ],
                subtotal: 0,
                shipping: 0,
                tax: 0,
                total: 0
            };

            // Initialize the page
            function init() {
                calculateCartTotals();
                renderCartItems();
                updateEmptyState();
                setupEventListeners();
            }

            // Calculate cart totals
            function calculateCartTotals() {
                cart.subtotal = cart.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                cart.shipping = cart.subtotal > 5000 ? 0 : 150; // Free shipping over ₹5000
                cart.tax = cart.subtotal * 0.12; // 12% tax
                cart.total = cart.subtotal + cart.shipping + cart.tax;
            }

            // Render cart items
            function renderCartItems() {
                cartItemsEl.innerHTML = '';

                cart.items.forEach(item => {
                    const row = document.createElement('tr');
                    row.dataset.id = item.id;

                    row.innerHTML = `
                        <td>
                            <div class="product-info">
                                <img src="${item.image}" alt="${item.title}" class="product-img">
                                <span>${item.title}</span>
                            </div>
                        </td>
                        <td>₹${item.price.toLocaleString('en-IN')}</td>
                        <td>
                            <div class="quantity-control">
                                <button class="quantity-btn minus">-</button>
                                <input type="text" class="quantity-input" value="${item.quantity}" min="1">
                                <button class="quantity-btn plus">+</button>
                            </div>
                        </td>
                        <td>₹${(item.price * item.quantity).toLocaleString('en-IN')}</td>
                        <td>
                            <button class="remove-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </td>
                    `;

                    cartItemsEl.appendChild(row);
                });

                // Update summary
                subtotalEl.textContent = `₹${cart.subtotal.toLocaleString('en-IN')}`;
                shippingEl.textContent = `₹${cart.shipping.toLocaleString('en-IN')}`;
                taxEl.textContent = `₹${cart.tax.toLocaleString('en-IN')}`;
                totalEl.textContent = `₹${cart.total.toLocaleString('en-IN')}`;
            }

            // Update empty cart state
            function updateEmptyState() {
                if (cart.items.length === 0) {
                    cartTable.style.display = 'none';
                    orderSummary.style.display = 'none';
                    emptyCart.style.display = 'block';
                } else {
                    cartTable.style.display = 'block';
                    orderSummary.style.display = 'block';
                    emptyCart.style.display = 'none';
                }
            }

            // Update item quantity
            function updateQuantity(productId, newQuantity) {
                const item = cart.items.find(item => item.id === productId);
                if (item) {
                    item.quantity = newQuantity;
                    calculateCartTotals();
                    renderCartItems();
                }
            }

            // Remove item from cart
            function removeItem(productId) {
                cart.items = cart.items.filter(item => item.id !== productId);
                calculateCartTotals();
                renderCartItems();
                updateEmptyState();
            }

            // Setup event listeners
            function setupEventListeners() {
                // Quantity controls
                cartItemsEl.addEventListener('click', function(e) {
                    const target = e.target;
                    const row = target.closest('tr');

                    if (!row) return;

                    const productId = parseInt(row.dataset.id);
                    const input = row.querySelector('.quantity-input');

                    // Minus button
                    if (target.classList.contains('minus')) {
                        const newQuantity = parseInt(input.value) - 1;
                        if (newQuantity >= 1) {
                            input.value = newQuantity;
                            updateQuantity(productId, newQuantity);
                        }
                    }

                    // Plus button
                    if (target.classList.contains('plus')) {
                        const newQuantity = parseInt(input.value) + 1;
                        input.value = newQuantity;
                        updateQuantity(productId, newQuantity);
                    }

                    // Remove button
                    if (target.classList.contains('remove-btn') || target.closest('.remove-btn')) {
                        removeItem(productId);
                    }
                });

                // Quantity input changes
                cartItemsEl.addEventListener('input', function(e) {
                    if (e.target.classList.contains('quantity-input')) {
                        const row = e.target.closest('tr');
                        const productId = parseInt(row.dataset.id);
                        const newQuantity = parseInt(e.target.value) || 1;

                        if (newQuantity >= 1) {
                            updateQuantity(productId, newQuantity);
                        } else {
                            e.target.value = 1;
                        }
                    }
                });

                // Checkout button
                checkoutBtn.addEventListener('click', function() {
                    alert(`Order placed successfully! Total: ₹${cart.total.toLocaleString('en-IN')}`);
                    cart.items = [];
                    calculateCartTotals();
                    renderCartItems();
                    updateEmptyState();
                });

                // Navigation buttons
                backToProductsBtn.addEventListener('click', function() {
                    // In a real app, this would navigate back to products page
                    window.location.href = "./products.php?products";

                });

                shopBtn.addEventListener('click', function() {
                    // In a real app, this would navigate to products page
                    window.location.href = "./products.php?products";
                });
            }

            // Initialize the app
            init();
        });
    </script>
</body>

</html>