<?php
// Declaro variables dades client
$code = $_POST['code'] ?? '';
$name = $_POST['name'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone_number'] ?? '';
$email = $_POST['email'] ?? '';

// Declaro variables dades productes
$products = $_POST['products'] ?? [];
$qty = $_POST['qty'] ?? [];
$prices = ['p1'=>12.50,'p2'=>10.00,'p3'=>9.50,'p4'=>8.00];
$total = 0;
$IVA = 21;

foreach($products as $key=>$val){ //per cada valor de la clau(=producte)
    if($val){//si existeix valor
        $total += $prices[$key] * ($qty[$key] ?? 1);// $total = $total + $subtotal;
    }
}

$total_IVA = $total * (1 + $IVA/100);

// Guardar dades al fitxer binari .db
$db_path = __DIR__ . '/../../onlineOrders/onlineOrders.db';

$order_line = implode(":", [// implode converteix array en cadena text
    date('Y-m-d H:i:s'),
    $code,
    $name,
    $address,
    $phone,
    $email,
    implode(",", array_keys($products)),
    implode(",", array_values($qty)),
    number_format($total_IVA, 2)
]) . "\n";

file_put_contents($db_path, $order_line, FILE_APPEND);

// Confirmació
echo "<h2>Orden creada con éxito</h2>";
echo "<p>Código de la orden: <strong>$code</strong></p>";
echo "<p>Total (IVA incluido): <strong>" . number_format($total_IVA,2) . " €</strong></p>";
echo '<p><a href="/eCommerce/app/cli/order_form.html">Nueva orden</a> | <a href="/eCommerce/app/cli/operations_menu.html">Menú</a></p>';
?>