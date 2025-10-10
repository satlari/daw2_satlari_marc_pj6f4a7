<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Orders List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
    crossorigin="anonymous"></script>
    
    <style>
        table { 
            border-collapse: collapse; 
            width: 100%;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            color: white; 
            background-color: #508803ff; 
        }
        h1 { text-align: center; }
        .button-container { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Orders List</h1>
        
        <?php
        $db_path = __DIR__ . '/../../onlineOrders/onlineOrders.db';
        
        if (file_exists($db_path)) {
            $lines = file($db_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            if (!empty($lines)) {
                echo "<table>";
                echo "<tr><th>Code</th><th>Name</th><th>Address</th><th>Phone</th><th>Email</th><th>Products</th><th>Quantities</th><th>Total with IVA</th></tr>";
                
                foreach ($lines as $line) {
                    $fields = explode(":", $line);
                    echo "<tr>";
                    foreach ($fields as $field) {
                        echo "<td>" . htmlspecialchars($field) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='text-center mt-4'>No orders found</p>";
            }
        } else {
            echo "<p class='text-center mt-4'>No orders file found</p>";
        }
        ?>

        <div class="button-container">
            <a href="/eCommerce/app/cli/operations_menu.html" class="btn btn-primary">Back to Menu</a>
            <a href="/eCommerce/app/cli/index.html" class="btn btn-secondary">Home</a>
        </div>
    </div>
</body>
</html>