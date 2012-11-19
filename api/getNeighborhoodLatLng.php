<?php
require_once('config.php');
$connection = mysql_connect(HOST, USER, PW);
mysql_select_db(DB, $connection);

$nbhd = mysql_real_escape_string(stripcslashes($_GET["neighborhood"]));
$results = mysql_query("SELECT lat,lng FROM nbhdz WHERE name='$nbhd'");

$rows = mysql_fetch_array($results);
$lat = $rows['lat'];
$lng = $rows['lng'];
$coors = array('lat' => $lat,'lng' => $lng);
mysql_close($connection);

header('Cache-Control: no-cache, must revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($coors);
?>
