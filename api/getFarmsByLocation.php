<?php
//JSON header
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
require_once('config.php');

$error = "{'farms':[]}";
$lat = $_GET['lat'];
$lng = $_GET['lng'];

$connection = mysql_connect(HOST, USER, PW);
if (!$connection) die($error);
mysql_select_db(DB, $connection);
$result = mysql_query('SELECT * FROM farms WHERE active=1');
if (!$result) die($error);
?>
{"farms":[
        <?php
        while($farm = mysql_fetch_array($result)):
            $dlat = sin(deg2rad($lat - $farm['lat'])/2);
            $dlng = sin(deg2rad($lng - $farm['lng'])/2);
            $lat1 = deg2rad($lat);
            $lat2 = deg2rad($farm['lat']);
            $a = $dlat*$dlat + $dlng*$dlng*cos($lat1)*cos($lat2);
            $c = 2*atan2(sqrt($a), sqrt(1-$a));
            $dist = $c*3959;
            if ($dist <= $farm['radius']):
                echo json_encode($farm);
                echo ',';
            endif;
        endwhile;
        ?>
        {}
],
"lat":"<?=$lat?>",
"lng":"<?=$lng?>"
}