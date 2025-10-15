<?php

// Llegeix ordres des de l'arxiu i retorna un array multidimensional
function readOrders($db_path) {
    $orders = [];
    if (!file_exists($db_path)) return $orders;

    $lines = file($db_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $fields = array_map('trim', explode(":", $line));
        if (count($fields) >= 8) {
            $orders[] = [
                'code' => $fields[0],
                'name' => $fields[1],
                'address' => $fields[2],
                'phone' => $fields[3],
                'email' => $fields[4],
                'products' => explode(",", $fields[5]), // array de productes
                'quantities' => array_map('intval', explode(",", $fields[6])), // array de quantitats
                'total_IVA' => floatval($fields[7])
            ];
        }
    }
    return $orders;
}

// Recupera codi de l'ordre des de GET
function getOrderCode() {
    return $_GET['code'] ?? '';
}

// Busca una ordre per codi
function findOrder($orders, $code) {
    foreach ($orders as $order) {
        if ($order['code'] === $code) {
            return $order;
        }
    }
    return null;
}

// Mostra una ordre individual
function order($order) {
    if ($order) {
        echo "<ul class='list-group'>";
        echo "<li><b>Order Retrieved, code</b>: " . htmlspecialchars($order['code']) . "</li>";
        echo "<li>Name: " . htmlspecialchars($order['name']) . "</li>";
        echo "<li>Adress: " . htmlspecialchars($order['address']) . "</li>";
        echo "<li>Phone number: " . htmlspecialchars($order['phone']) . "</li>";
        echo "<li>E-mail: " . htmlspecialchars($order['email']) . "</li>";
        echo "<li>Products: " . implode(", ", $order['products']) . "</li>";
        echo "<li>Quantities:  " . implode(", ", $order['quantities']) . "</li>";
        echo "<li>Total + IVA: S " . number_format($order['total_IVA'], 2) . " €</li>";
        echo "</ul>";
    } else {
        echo "<p class='text-center'>No order found</p>";
    }
}

// Mostra totes les ordres
function orders($orders) {
    if (empty($orders)) {
        echo "<p class='text-center'>No orders found.</p>";
        return;
    }

    foreach ($orders as $order) {
        $line = implode(":", [
            $order['code'],
            $order['name'],
            $order['address'],
            $order['phone'],
            $order['email'],
            implode(",", $order['products']),
            implode(",", $order['quantities']),
            number_format($order['total_IVA'], 2)
        ]);
        echo htmlspecialchars($line) . "<br>";
    }
}

// Missatge si no hi ha arxiu d'ordres
function displayNoFileMessage() {
    echo "<p class='text-center'>No orders file found.</p>";
}


// Recupera dades del client des de POST
function getClientData() {
    return [
        'code' => $_POST['code'] ?? '',
        'name' => $_POST['name'] ?? '',
        'address' => $_POST['address'] ?? '',
        'phone' => $_POST['phone_number'] ?? '',
        'email' => $_POST['email'] ?? ''
    ];
}

// Calcula total amb IVA
function calculateTotal($products, $qty, $prices, $IVA = 21) {
    $total = 0;
    foreach ($products as $key => $val) {
        if ($val) {
            $total += $prices[$key] * ($qty[$key] ?? 1);
        }
    }
    return $total * (1 + $IVA / 100);
}

// Genera línia d'ordre per guardar a l'arxiu
function generateOrderLine($client, $products, $qty, $prices) {
    $total_IVA = calculateTotal($products, $qty, $prices);
    return implode(":", [
        $client['code'],
        $client['name'],
        $client['address'],
        $client['phone'],
        $client['email'],
        implode(",", array_keys($products)),
        implode(",", array_values($qty)),
        number_format($total_IVA, 2)
    ]) . "\n";
}

// Guarda ordre a l'arxiu
function saveOrder($db_path, $order_line) {
    file_put_contents($db_path, $order_line, FILE_APPEND);
}

// Mostra confirmació de l'ordre creada
function displayConfirmation($client, $total_IVA) {
    echo "<h2>Order created successfully</h2>";
    echo "<p>Order code: <strong>" . htmlspecialchars($client['code']) . "</strong></p>";
    echo "<p>Total (IVA included): <strong>" . number_format($total_IVA, 2) . " €</strong></p>";
}
?>
