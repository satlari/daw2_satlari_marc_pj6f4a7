<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
        crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Orders List</h2>

        <div class="bg-white p-4 shadow rounded">
        <?php
        $db_path = __DIR__ . '/../../onlineOrders/onlineOrders.db';

        if (file_exists($db_path)) {
            $lines = file($db_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (!empty($lines)) {
                echo "<pre>"; // mantiene formato de texto
                foreach ($lines as $line) {
                    echo htmlspecialchars($line) . "\n";
                }
                echo "</pre>";
            } else {
                echo "<p class='text-center'>No orders found.</p>";
            }
        } else {
            echo "<p class='text-center'>No orders file found.</p>";
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