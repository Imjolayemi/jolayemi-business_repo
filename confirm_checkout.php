<?php
session_start();

$_SESSION['subtotal'] = $_GET['subtotal'];

$subtotal = $_SESSION['subtotal'];

if (isset($subtotal)) {
    header('Location: checkout.php');
    exit;
}else{
    echo '<script>alert("There is no Subtotal detected.");</script>';
}
?>