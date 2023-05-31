<?php
// Connect DB
$db_host="localhost";
$db_name="matrixte_chocolatecup";
$db_user="matrixte_chocolatecup";
$db_password="26108920Qwe*#";

/*---------------------------------------*/

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name)or die('<div class="error"><h1>Veri Tabanı Bağlantısı Kurulamadı!</h1></div>');
$conn->query("SET NAMES 'utf8'"); 
$conn->query("SET CHARACTER SET utf8");  
$conn->query("SET SESSION collation_connection = 'utf8_unicode_ci'"); 
?>