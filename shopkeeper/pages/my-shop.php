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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f3f4f6;
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styling */
        .sidebar {
            width: 260px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar h2 {
            color: var(--primary-color);
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            font-size: 1.5rem;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin-bottom: 8px;
        }

        .sidebar a {
            text-decoration: none;
            color: var(--text-color);
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-radius: 6px;
            transition: all 0.2s;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        .sidebar a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            padding: 30px;
            margin-left: 260px;
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
            font-size: 1.8rem;
        }

        /* Profile Card */
        .profile-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: white;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--primary-color);
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-role {
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
        }

        .edit-profile-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Profile Details */
        .profile-details {
            padding: 30px;
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
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 14px;
            color: var(--light-text);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-value {
            font-weight: 500;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .edit-icon {
            color: var(--light-text);
            cursor: pointer;
            margin-left: auto;
        }

        .edit-icon:hover {
            color: var(--primary-color);
        }

        /* Form Styles */
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

        /* Modal */
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

        /* Responsive styles */
        @media (max-width: 900px) {
            .sidebar {
                width: 80px;
                padding: 15px 10px;
            }

            .sidebar h2,
            .sidebar a span {
                display: none;
            }

            .sidebar a i {
                margin-right: 0;
                font-size: 1.2rem;
            }

            .main-content {
                margin-left: 80px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-actions {
                flex-direction: column;
            }
        }

        /* Toast notification */
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
?>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Vendor Dashboard</h2>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                <li><a href="#"><i class="fas fa-box"></i> <span>Products</span></a></li>
                <li><a href="#"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> <span>Analytics</span></a></li>
                <li><a href="#" class="active"><i class="fas fa-store"></i> <span>My Shop</span></a></li>
                <li><a href="#"><i class="fas fa-users"></i> <span>Customers</span></a></li>
                <li><a href="#"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <div class="header">
                <h1>My Shop Profile</h1>
            </div>

            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="fas fa-store"></i>
                    </div>
                    <h2 class="profile-name" id="shopNameDisplay"><?php echo $shopkeeper['shop_name'] ?></h2>
                    <button class="edit-profile-btn" id="editProfileBtn">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>
                </div>

                <div class="profile-details">
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
                                <i class="fas fa-lock"></i> Password
                                <i class="fas fa-edit edit-icon" data-field="password"></i>
                            </div>
                            <div class="detail-value" id="passwordValue">••••••••</div>
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
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Edit Shop Information</h3>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="../server/update-my-shop.php" method="post">
                    <div style="display: flex; gap: 20px; justify-content: center">
                        <div class="form-group">
                            <label class="form-label" for="editShopName">Shop Name</label>
                            <input type="text" class="form-input" id="editShopName" placeholder="Enter shop name">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="editOwnerName">Owner Name</label>
                            <input type="text" class="form-input" id="editOwnerName" placeholder="Enter owner name">
                        </div>
                    </div>
                    <div style="display: flex; gap: 20px; justify-content: center">
                        <div class="form-group">
                            <label class="form-label" for="editMobileNumber">Mobile Number</label>
                            <input type="tel" class="form-input" id="editMobileNumber" placeholder="Enter mobile number">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="editEmail">Email Address</label>
                            <input type="email" class="form-input" id="editEmail" placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="editPassword">Password</label>
                        <input type="password" class="form-input" id="editPassword" placeholder="Enter new password">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="editShopLocation">Shop Location</label>
                        <textarea class="form-input" id="editShopLocation" placeholder="Enter shop location" rows="3"></textarea>
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
                mobileNumber: '+91 <?php echo $shopkeeper['mobile_number'] ?>',
                email: '<?php echo $shopkeeper['email'] ?>',
                password: '••••••••',
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

            // Handle form submission
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Update shop data
                shopData.shopName = document.getElementById('editShopName').value || shopData.shopName;
                shopData.ownerName = document.getElementById('editOwnerName').value || shopData.ownerName;
                shopData.mobileNumber = document.getElementById('editMobileNumber').value || shopData.mobileNumber;
                shopData.email = document.getElementById('editEmail').value || shopData.email;

                // Only update password if it was changed
                const newPassword = document.getElementById('editPassword').value;
                if (newPassword) {
                    shopData.password = '••••••••'; // In a real app, this would be the encrypted password
                }

                shopData.shopLocation = document.getElementById('editShopLocation').value || shopData.shopLocation;

                // Update UI
                updateShopDisplay();

                // Close modal
                editModal.style.display = 'none';

                // Show success message
                showToast('Shop information updated successfully!');

                const formData = new FormData();
                formData.append('shop_name', shopData.shopName);
                formData.append('owner_name', shopData.ownerName);
                formData.append('mobile_number', shopData.mobileNumber.replace(/^\+91\s*/, ''));
                formData.append('email', shopData.email);
                formData.append('shop_location', shopData.shopLocation);
                // Only send password if changed
                const passwordInput = document.getElementById('editPassword').value;
                if (passwordInput) {
                    formData.append('password', passwordInput);
                }

                fetch('../server/update-my-shop.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Shop information updated successfully!');
                    } else {
                        showToast('Failed to update shop information.');
                    }
                })
                .catch(() => {
                    showToast('Error updating shop information.');
                });
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
                        password: 'Password',
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

            // Function to update shop display
            function updateShopDisplay() {
                document.getElementById('shopNameDisplay').textContent = shopData.shopName;
                document.getElementById('shopNameValue').textContent = shopData.shopName;
                document.getElementById('ownerNameValue').textContent = shopData.ownerName;
                document.getElementById('mobileNumberValue').textContent = shopData.mobileNumber;
                document.getElementById('emailValue').textContent = shopData.email;
                document.getElementById('passwordValue').textContent = shopData.password;
                document.getElementById('shopLocationValue').textContent = shopData.shopLocation;
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