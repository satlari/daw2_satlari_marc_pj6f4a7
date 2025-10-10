<?php
// Recupera codi amb metode get. Neteja espais buits
$code = isset($_GET['code']) ? trim($_GET['code']) : '';

// Ruta per recuperar dades
$db_path = __DIR__ . '/../../onlineOrders/onlineOrders.db';
$order = null;

// Comprobar si existeix arxiu
if (file_exists($db_path)) {
    $lines = file($db_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Buscar ordre del codi indicat
    foreach ($lines as $line) {
        $fields = explode(":", $line);

        // Neteja espais
        $fields = array_map('trim', $fields);

        if (isset($fields[1]) && $fields[1] === $code) {
            $order = $fields;
            break;
        }
    }
}

// Mostrar resultat
if ($order) {
    echo "<h2>Order found: " . htmlspecialchars($code) . "</h2>";
    echo "<p><strong>Name:</strong> " . htmlspecialchars($order[2] ?? '') . "</p>";
    echo "<p><strong>Address:</strong> " . htmlspecialchars($order[3] ?? '') . "</p>";
    echo "<p><strong>Phone:</strong> " . htmlspecialchars($order[4] ?? '') . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($order[5] ?? '') . "</p>";
    echo "<p><strong>Products:</strong> " . htmlspecialchars($order[6] ?? '') . "</p>";
    echo "<p><strong>Quantities:</strong> " . htmlspecialchars($order[7] ?? '') . "</p>";
    echo "<p><strong>Total IVA:</strong> " . htmlspecialchars($order[8] ?? '') . " €</p>";
} else {
    echo "<h2>No order found with code: " . htmlspecialchars($code) . "</h2>";
}
?>