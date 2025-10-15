<?php
require_once 'functions.php';

$client = getClientData();
$products = $_POST['products'] ?? [];
$qty = $_POST['qty'] ?? [];
$prices = ['p1'=>12.50, 'p2'=>10.00, 'p3'=>9.50, 'p4'=>8.00];

$order_line = generateOrderLine($client, $products, $qty, $prices);
saveOrder(__DIR__ . '/../../onlineOrders/onlineOrders.db', $order_line);

$total_IVA = calculateTotal($products, $qty, $prices);
displayConfirmation($client, $total_IVA);
?>
