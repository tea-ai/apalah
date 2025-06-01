<?php
session_start();
include 'koneksi.php';

$menu = $_GET['menu'];
$harga = $_GET['harga'];


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['menu'] === $menu) {
        $item['banyak'] += 1; 
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = [
        'menu' => $menu,
        'harga' => $harga,
        'banyak' => 1,
    ];
}

header('Location: index.php');
exit();
?>
