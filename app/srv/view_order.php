<?php
require_once 'functions.php';

$code = getOrderCode();
$db_path = __DIR__ . '/../../onlineOrders/onlineOrders.db';
$orders = readOrders($db_path); 
$order = findOrder($orders, $code);
order($order); // mostra ordre
?>
