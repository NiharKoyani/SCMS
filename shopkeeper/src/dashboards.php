<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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

<body>
    <?php
    session_start();

    if (isset($_GET['/dashboards.php']) && !isset($_SESSION['shopkeeper_id'])) {
        header('location: ./login.php');
    }

    if (isset($_SESSION['shopkeeper_id'])) { ?>
        <div class="dashboard">
            <?php include('./sidebar.php'); ?>
            <main class="main-content">
                <?php
                if (isset($_GET['dashboard'])) {
                    include('./dashboard.php');
                } else if (isset($_GET['products'])) {
                    include('./products.php');
                } else if (isset($_GET['cart'])) {
                    include('./cart.php');
                } else {
                    include('./dashboard.php');
                }
                ?>
            </main>
        </div>
    <?php } else
        header('location: ./login.php');

    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
    }
    ?>
</body>

</html>