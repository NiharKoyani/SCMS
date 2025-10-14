<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$currentUser = $_SESSION['shopkeeper_id'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop - Vendor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../styles/top-nav.css">
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
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

        /* ---------- Shop Profile Card ---------- */
        .shop-profile-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .shop-profile-header {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .shop-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: white;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--primary-color);
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .shop-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .shop-role {
            opacity: 0.9;
            font-size: 16px;
        }

        .edit-profile-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            transition: all 0.3s;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
        }

        .edit-profile-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* ---------- Shop Details Grid ---------- */
        .shop-details {
            padding: 2rem;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            background-color: var(--secondary-color);
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .detail-label {
            font-size: 14px;
            color: var(--light-text);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-value {
            font-weight: 500;
            font-size: 16px;
        }

        .edit-icon {
            color: var(--light-text);
            cursor: pointer;
            margin-left: auto;
            transition: color 0.3s;
        }

        .edit-icon:hover {
            color: var(--primary-color);
        }

        /* ---------- Modal ---------- */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--light-text);
        }

        .modal-body {
            padding: 20px;
        }

        /* ---------- Form Styles ---------- */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
            font-family: 'Montserrat', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: #e5e7eb;
        }

        /* ---------- Toast Notification ---------- */
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

        /* ---------- Responsive Styles ---------- */
        @media (max-width: 900px) {
            .main-content {
                margin-left: 80px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
            }

            .shop-profile-header {
                padding: 1.5rem;
            }

            .shop-avatar {
                width: 80px;
                height: 80px;
                font-size: 30px;
            }
        }
    </style>
</head>

<?php
require_once('../../Utility/db.php');
$stmt = $conn->prepare("SELECT * FROM shopkeeper WHERE id = ?");
$stmt->bind_param("i", $currentUser);
$stmt->execute();
$result = $stmt->get_result();
$shopkeeper = $result->fetch_assoc();
$stmt->close();

// Get cart count for the top navigation
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
        <!-- Sidebar -->
        <?php include('../util/sidebar.php'); ?>

        <!-- Main content -->
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

            <!-- Shop Profile Card -->
            <div class="shop-profile-card">
                <div class="shop-profile-header">
                    <div class="shop-avatar">
                        <i class="fas fa-store"></i>
                    </div>
                    <h2 class="shop-name" id="shopNameDisplay"><?php echo $shopkeeper['shop_name'] ?></h2>
                    <p class="shop-role">Shop Owner</p>
                    <button class="edit-profile-btn" id="editProfileBtn">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>
                </div>

                <div class="shop-details">
                    <!-- Shop Information Section -->
                    <div class="section-title">
                        <i class="fas fa-info-circle"></i> Shop Information
                    </div>

                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-signature"></i> Shop Name
                                <i class="fas fa-edit edit-icon" data-field="shopName"></i>
                            </div>
                            <div class="detail-value" id="shopNameValue"><?php echo $shopkeeper['shop_name'] ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-user"></i> Owner Name
                                <i class="fas fa-edit edit-icon" data-field="ownerName"></i>
                            </div>
                            <div class="detail-value" id="ownerNameValue"><?php echo $shopkeeper['owner_name'] ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-phone"></i> Mobile Number
                                <i class="fas fa-edit edit-icon" data-field="mobileNumber"></i>
                            </div>
                            <div class="detail-value" id="mobileNumberValue">+91 <?php echo $shopkeeper['mobile_number'] ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-envelope"></i> Email Address
                                <i class="fas fa-edit edit-icon" data-field="email"></i>
                            </div>
                            <div class="detail-value" id="emailValue"><?php echo $shopkeeper['email'] ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-map-marker-alt"></i> Shop Location
                                <i class="fas fa-edit edit-icon" data-field="shopLocation"></i>
                            </div>
                            <div class="detail-value" id="shopLocationValue"><?php echo $shopkeeper['shop_location'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Edit Shop Information</h3>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="../server/update-my-shop.php" method='post'>
                    <div style="display: flex; gap: 20px; justify-content: center">
                        <div class="form-group">
                            <label class="form-label" for="editShopName">Shop Name</label>
                            <input type="text" class="form-input" id="editShopName" name="shop_name" placeholder="Enter shop name">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="editOwnerName">Owner Name</label>
                            <input type="text" class="form-input" id="editOwnerName" name="owner_name" placeholder="Enter owner name">
                        </div>
                    </div>
                    <div style="display: flex; gap: 20px; justify-content: center">
                        <div class="form-group">
                            <label class="form-label" for="editMobileNumber">Mobile Number</label>
                            <input type="tel" class="form-input" id="editMobileNumber" name="mobile_number" placeholder="Enter mobile number">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="editEmail">Email Address</label>
                            <input type="email" class="form-input" id="editEmail" name="email" placeholder="Enter email address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="editShopLocation">Shop Location</label>
                        <textarea class="form-input" id="editShopLocation" name="shop_location" placeholder="Enter shop location" rows="3"></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelEdit">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Profile updated successfully!</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const editProfileBtn = document.getElementById('editProfileBtn');
            const editModal = document.getElementById('editModal');
            const closeModal = document.getElementById('closeModal');
            const cancelEdit = document.getElementById('cancelEdit');
            const editForm = document.getElementById('editForm');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const editIcons = document.querySelectorAll('.edit-icon');

            // Current shop data
            let shopData = {
                shopName: '<?php echo $shopkeeper['shop_name'] ?>',
                ownerName: '<?php echo $shopkeeper['owner_name'] ?>',
                mobileNumber: '<?php echo $shopkeeper['mobile_number'] ?>',
                email: '<?php echo $shopkeeper['email'] ?>',
                shopLocation: '<?php echo $shopkeeper['shop_location'] ?>'
            };

            // Open modal when Edit Profile button is clicked
            editProfileBtn.addEventListener('click', function() {
                openEditModal('all');
            });

            // Open modal when specific edit icon is clicked
            editIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const field = this.getAttribute('data-field');
                    openEditModal(field);
                });
            });

            // Close modal when X button is clicked
            closeModal.addEventListener('click', function() {
                editModal.style.display = 'none';
            });

            // Close modal when Cancel button is clicked
            cancelEdit.addEventListener('click', function() {
                editModal.style.display = 'none';
            });

            // Close modal when clicking outside the modal
            window.addEventListener('click', function(event) {
                if (event.target === editModal) {
                    editModal.style.display = 'none';
                }
            });

            // Function to open edit modal
            function openEditModal(field) {
                // Reset form
                editForm.reset();

                // Set modal title
                const modalTitle = document.getElementById('modalTitle');
                if (field === 'all') {
                    modalTitle.textContent = 'Edit Shop Information';
                } else {
                    const fieldNames = {
                        shopName: 'Shop Name',
                        ownerName: 'Owner Name',
                        mobileNumber: 'Mobile Number',
                        email: 'Email Address',
                        shopLocation: 'Shop Location'
                    };
                    modalTitle.textContent = `Edit ${fieldNames[field]}`;
                }

                // Pre-fill form with current data
                document.getElementById('editShopName').value = shopData.shopName;
                document.getElementById('editOwnerName').value = shopData.ownerName;
                document.getElementById('editMobileNumber').value = shopData.mobileNumber;
                document.getElementById('editEmail').value = shopData.email;
                document.getElementById('editShopLocation').value = shopData.shopLocation;

                // Show modal
                editModal.style.display = 'flex';
            }

            // Function to show toast notification
            function showToast(message) {
                toastMessage.textContent = message;
                toast.classList.add('show');

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
        });
    </script>
</body>

</html>