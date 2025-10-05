<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Orders - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #f9fafb;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
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
        
        .header-actions {
            display: flex;
            gap: 15px;
        }
        
        .filter-btn, .export-btn {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 8px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }
        
        .filter-btn:hover, .export-btn:hover {
            background-color: var(--secondary-color);
        }
        
        /* Stats cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .stat-card h3 {
            font-size: 14px;
            color: var(--light-text);
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: 500;
        }
        
        .stat-card .value {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .stat-card .change {
            font-size: 14px;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .stat-card .change.negative {
            color: var(--danger-color);
        }
        
        /* Orders table */
        .orders-table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table-header h2 {
            font-size: 18px;
            margin: 0;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--secondary-color);
            border-radius: 6px;
            padding: 8px 12px;
            width: 250px;
        }
        
        .search-bar input {
            border: none;
            outline: none;
            background: transparent;
            flex: 1;
            padding: 4px;
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
        }
        
        .order-id {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .customer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .customer-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: 600;
        }
        
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
        
        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--light-text);
            margin-right: 10px;
        }
        
        .action-btn:hover {
            color: var(--primary-color);
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .pagination-info {
            color: var(--light-text);
            font-size: 14px;
        }
        
        .pagination-controls {
            display: flex;
            gap: 8px;
        }
        
        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background-color: white;
            cursor: pointer;
        }
        
        .page-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        /* Responsive styles */
        @media (max-width: 1200px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 900px) {
            
            .main-content {
                margin-left: 80px;
            }
        }
        
        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- sidebar will be implement later -->

        <!-- Main content -->
        <div class="main-content">
            <div class="header">
                <h1>Recent Orders</h1>
                <div class="header-actions">
                    <button class="filter-btn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <button class="export-btn">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
            
            <!-- Stats cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Orders</h3>
                    <div class="value">324</div>
                    <div class="change">
                        <i class="fas fa-arrow-up"></i> 8.3% from last month
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Orders Today</h3>
                    <div class="value">28</div>
                    <div class="change">
                        <i class="fas fa-arrow-up"></i> 12% from yesterday
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Pending Orders</h3>
                    <div class="value">42</div>
                    <div class="change negative">
                        <i class="fas fa-arrow-down"></i> 5% from last week
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Average Order Value</h3>
                    <div class="value">₹1,248</div>
                    <div class="change">
                        <i class="fas fa-arrow-up"></i> 3.2% from last month
                    </div>
                </div>
            </div>
            
            <!-- Orders table -->
            <div class="orders-table-container">
                <div class="table-header">
                    <h2>All Orders</h2>
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search orders...">
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="order-id">#ORD-7842</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">RS</div>
                                    <span>Rahul Sharma</span>
                                </div>
                            </td>
                            <td>12 Aug 2023</td>
                            <td>₹3,842</td>
                            <td><span class="status-badge status-delivered">Delivered</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="order-id">#ORD-7841</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">PM</div>
                                    <span>Priya Mehta</span>
                                </div>
                            </td>
                            <td>12 Aug 2023</td>
                            <td>₹2,156</td>
                            <td><span class="status-badge status-processing">Processing</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="order-id">#ORD-7840</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">AK</div>
                                    <span>Amit Kumar</span>
                                </div>
                            </td>
                            <td>11 Aug 2023</td>
                            <td>₹5,743</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="order-id">#ORD-7839</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">SD</div>
                                    <span>Sunita Devi</span>
                                </div>
                            </td>
                            <td>11 Aug 2023</td>
                            <td>₹1,299</td>
                            <td><span class="status-badge status-delivered">Delivered</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="order-id">#ORD-7838</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">VP</div>
                                    <span>Vikram Patel</span>
                                </div>
                            </td>
                            <td>10 Aug 2023</td>
                            <td>₹4,872</td>
                            <td><span class="status-badge status-cancelled">Cancelled</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="order-id">#ORD-7837</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">NJ</div>
                                    <span>Neha Joshi</span>
                                </div>
                            </td>
                            <td>10 Aug 2023</td>
                            <td>₹3,421</td>
                            <td><span class="status-badge status-delivered">Delivered</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="order-id">#ORD-7836</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">RS</div>
                                    <span>Raj Singh</span>
                                </div>
                            </td>
                            <td>9 Aug 2023</td>
                            <td>₹2,548</td>
                            <td><span class="status-badge status-processing">Processing</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="order-id">#ORD-7835</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">AM</div>
                                    <span>Anjali Mishra</span>
                                </div>
                            </td>
                            <td>9 Aug 2023</td>
                            <td>₹1,876</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <button class="action-btn"><i class="fas fa-eye"></i></button>
                                <button class="action-btn"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <div class="pagination-info">
                    Showing 1 to 8 of 324 orders
                </div>
                <div class="pagination-controls">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add interactivity to the page
            const actionButtons = document.querySelectorAll('.action-btn');
            const filterBtn = document.querySelector('.filter-btn');
            const exportBtn = document.querySelector('.export-btn');
            
            // Action buttons event listeners
            actionButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('fa-eye')) {
                        alert('View order details');
                    } else if (icon.classList.contains('fa-edit')) {
                        alert('Edit order status');
                    }
                });
            });
            
            // Filter button functionality
            filterBtn.addEventListener('click', function() {
                alert('Filter options would appear here');
            });
            
            // Export button functionality
            exportBtn.addEventListener('click', function() {
                alert('Exporting order data...');
            });
            
            // Pagination buttons
            const pageButtons = document.querySelectorAll('.page-btn');
            pageButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (!this.querySelector('i')) {
                        pageButtons.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-bar input');
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    alert(`Searching for: ${this.value}`);
                    this.value = '';
                }
            });
        });
    </script>
</body>
</html>
