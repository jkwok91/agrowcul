<?php

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
require_once('config.php');
$id = $_GET['id'];
$connection = mysql_connect(HOST, USER, PW);
mysql_select_db(DB, $connection);
$farm = json_encode(mysql_fetch_assoc(mysql_query("SELECT * FROM farms WHERE id=$id")));

$products = mysql_query("SELECT * FROM products WHERE farm_id=$id ORDER BY id DESC");

if (mysql_num_rows($products) < 1) {
    $pj = "[]";
} else {
    $pj = "[";
    while ($row = mysql_fetch_assoc($products)) {
        $pj .= json_encode($row) . ",";
    }
    $pj = substr($pj, 0, -1) . "]";
}

$result = "{\"products\":" . $pj . ",\"info\":" . $farm . "}";
echo $result;
?>