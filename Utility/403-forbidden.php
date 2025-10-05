<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied | Security Portal</title>
    <style>
        :root {
            --primary-color: #1a365d;
            --secondary-color: #2d3748;
            --accent-color: #e53e3e;
            --text-color: #f7fafc;
            --background-color: #0f1419;
            --card-bg: rgba(26, 32, 44, 0.8);
            --border-color: #4a5568;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(26, 54, 93, 0.3) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(229, 62, 62, 0.2) 0%, transparent 20%);
            padding: 20px;
        }

        .container {
            max-width: 600px;
            width: 100%;
            text-align: center;
            background: var(--card-bg);
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-color));
        }

        .security-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(229, 62, 62, 0.1);
            border-radius: 50%;
            border: 2px solid var(--accent-color);
            position: relative;
        }

        .security-icon::before {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid var(--accent-color);
            border-radius: 50%;
            border-right-color: transparent;
            border-bottom-color: transparent;
            animation: spin 3s linear infinite;
        }

        .security-icon i {
            font-size: 48px;
            color: var(--accent-color);
            z-index: 1;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--text-color);
            font-weight: 700;
        }

        .error-code {
            font-size: 1rem;
            color: var(--accent-color);
            margin-bottom: 25px;
            letter-spacing: 1px;
            font-weight: 600;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #cbd5e0;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background: #2d3748;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .security-notice {
            margin-top: 30px;
            padding: 15px;
            background: rgba(229, 62, 62, 0.1);
            border-radius: 8px;
            border-left: 4px solid var(--accent-color);
            text-align: left;
        }

        .security-notice h3 {
            font-size: 1rem;
            margin-bottom: 8px;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .security-notice p {
            font-size: 0.9rem;
            margin-bottom: 0;
            color: #e2e8f0;
        }

        .footer {
            margin-top: 40px;
            font-size: 0.85rem;
            color: #a0aec0;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .security-icon {
                width: 100px;
                height: 100px;
            }

            .security-icon i {
                font-size: 40px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="security-icon">
            <i class="fas fa-shield-alt"></i>
        </div>

        <h1>Access Denied</h1>

        <div class="error-code">ERROR 403: UNAUTHORIZED ACCESS</div>

        <p>You do not have permission to access this resource. This incident has been logged for security purposes.</p>

        <div class="actions">
            <a href="../" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> &nbsp; Return to Homepage
            </a>
            <a href="#" class="btn btn-secondary">
                <i class="fas fa-envelope"></i> &nbsp; Contact Administrator
            </a>
        </div>

        <div class="security-notice">
            <h3><i class="fas fa-exclamation-triangle"></i> Security Notice</h3>
            <p>Unauthorized access attempts are monitored and may result in account suspension or legal action. If you believe you should have access to this resource, please contact your system administrator.</p>
        </div>

        <div class="footer">
            &copy; 2023 Security Portal. All rights reserved.
        </div>
    </div>
</body>

</html>