<?php

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
require_once('config.php');
$id = $_GET['id'];
$connection = mysql_connect(HOST, USER, PW);
mysql_select_db(DB, $connection);

$p = mysql_fetch_array(mysql_query("SELECT * FROM products WHERE id=$id"));
echo json_encode($p);
?>
