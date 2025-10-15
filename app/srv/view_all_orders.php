<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Orders List</h2>

        <div class="bg-white p-4 shadow rounded">
        <?php
        require_once 'functions.php';

        $db_path = __DIR__ . '/../../onlineOrders/onlineOrders.db';
        $orders_array = readOrders($db_path);

        if (!empty($orders_array)) {
            orders($orders_array); // totes les ordres
        } else {
            if (file_exists($db_path)) {
                echo "<p class='text-center'>No orders found.</p>";
            } else {
                displayNoFileMessage();
            }
        }
        ?>
        </div>

        <div class="text-center mt-4">
            <a href="../cli/operations_menu.html" class="btn btn-primary">Back to Menu</a>
            <a href="../cli/index.html" class="btn btn-secondary">Home</a>
        </div>
    </div>
</body>
</html>