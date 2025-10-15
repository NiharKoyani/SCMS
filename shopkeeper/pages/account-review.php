<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Under Review - Vendor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ---------- CSS Variables ---------- */
        :root {
            --primary: #09122c;
            --primary-light: #1a2a5e;
            --secondary: #11204be0;
            --accent: #ffa502;
            --dark: #2f3542;
            --light: #f3f4f6;
            --white: #ffffff;
            --success: #2ed573;
            --warning: #ffa502;
            --danger: #ff4757;
            --gray: #6b7280;
            --light-gray: #e5e7eb;
        }

        /* ---------- Reset & Base Styles ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: var(--primary);
        }

        /* ---------- Layout ---------- */

        .menu-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--white);
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left-color: var(--accent);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--primary);
        }

        .user-details h4 {
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .user-details p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }

        /* ---------- Pending Status Card ---------- */
        .pending-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            text-align: center;
            padding: 2rem;
        }

        .pending-card {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 3rem;
            max-width: 600px;
            width: 100%;
        }

        .status-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: rgba(255, 165, 2, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--warning);
            font-size: 2.5rem;
        }

        .pending-card h2 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .pending-card p {
            color: var(--gray);
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .status-details {
            background-color: rgba(255, 165, 2, 0.05);
            border: 1px solid rgba(255, 165, 2, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: left;
        }

        .status-details h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-details ul {
            list-style-type: none;
        }

        .status-details li {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .status-details li i {
            color: var(--warning);
            margin-top: 0.25rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(9, 18, 44, 0.05);
        }

        /* ---------- Progress Bar ---------- */
        .progress-container {
            margin: 2rem 0;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .progress-bar {
            height: 8px;
            background-color: var(--light-gray);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--warning);
            width: 65%;
            border-radius: 4px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 0.8;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.8;
            }
        }

        /* ---------- Contact Info ---------- */
        .contact-info {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--light-gray);
        }

        .contact-info p {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .contact-info a {
            color: var(--primary);
            font-weight: 500;
        }

        /* ---------- Responsive Design ---------- */
        @media (max-width: 768px) {

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .pending-card {
                padding: 2rem 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">

        <!-- Main Content -->
        <div class="main-content">

            <div class="pending-container">
                <div class="pending-card">
                    <div class="status-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                    <h2>Account Under Review</h2>
                    <p>Your vendor account is currently being reviewed by our team. This process usually takes 1-2 business days.</p>

                    <div class="progress-container">
                        <div class="progress-label">
                            <span>Verification Progress</span>
                            <span>65%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill"></div>
                        </div>
                    </div>

                    <div class="status-details">
                        <h3><i class="fas fa-info-circle"></i> What happens next?</h3>
                        <ul>
                            <li>
                                <i class="fas fa-check"></i>
                                <span>Our team is reviewing your submitted documents and business information</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span>We're verifying your business registration and tax details</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span>Final approval and account activation pending</span>
                            </li>
                        </ul>
                    </div>

                    <div class="action-buttons">
                        <a href="../../"><button class="btn btn-primary">
                                <i class="fas fa-upload"></i>
                                Go To Home
                            </button></a>
                        <button class="btn btn-outline">
                            <i class="fas fa-question-circle"></i>
                            Contact Support
                        </button>
                    </div>

                    <div class="contact-info">
                        <p>Need immediate assistance? Contact our support team at <a href="mailto:support@vendormarket.com">support@vendormarket.com</a> or call <a href="tel:+18005551234">+1 (800) 555-1234</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simulate progress animation
        document.addEventListener('DOMContentLoaded', function() {
            const progressFill = document.querySelector('.progress-fill');
            let progress = 65;

            // Simulate progress update (in a real app, this would come from the backend)
            const progressInterval = setInterval(() => {
                if (progress < 85) {
                    progress += 5;
                    progressFill.style.width = `${progress}%`;
                    document.querySelector('.progress-label span:last-child').textContent = `${progress}%`;
                } else {
                    clearInterval(progressInterval);
                }
            }, 3000);

            document.querySelector('.btn-outline').addEventListener('click', function() {
                alert('Support contact form would open here in a real application.');
            });
        });
    </script>
</body>

</html>