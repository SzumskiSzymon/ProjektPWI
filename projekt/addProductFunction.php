<?php
session_start();
$prod_name = $_POST['PROD_NAME'];
$prod_cat = $_POST['PROD_CATEGORY'];
$prod_date = $_POST['PROD_DATE'];
$prod_brand = $_POST['PROD_BRAND'];
$prod_price = $_POST['PROD_PRICE'];
$prod_quantity = $_POST['PROD_QUANTITY'];
$prod_barcode = $_POST['PROD_BARCODE'];
require_once "connect.php";
$pdo->query("INSERT INTO products VALUES(NULL, '$prod_name','$prod_cat','$prod_date','$prod_brand','$prod_price','$prod_quantity','$prod_barcode'");
$query->execute();

header('Location: admin.php');
exit();
?>