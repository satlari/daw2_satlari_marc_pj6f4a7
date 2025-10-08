<?php
$IVA = 21;
$products = $_POST['products'] ?? [];
$qty = $_POST['qty'] ?? [];

$prices = ['p1'=>12.50,'p2'=>10.00,'p3'=>9.50,'p4'=>8.00];
$total = 0;

foreach($products as $key=>$val){
    if($val){
        $total += $prices[$key] * ($qty[$key] ?? 1);
    }
}

$total_IVA = $total * (1 + $IVA/100);

// Solo enviar el total al cliente
echo "Total (IVA incl.): " . number_format($total_IVA, 2) . " €";
$db_path = __DIR__ . '/onlineOrders.db';
?>