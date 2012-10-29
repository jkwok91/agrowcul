<?php
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
require_once('config.php');
$connection = mysql_connect(HOST, USER, PW);
mysql_select_db(DB, $connection);

$id = $_GET['id'];

$petitions = mysql_query("SELECT * FROM petitions WHERE neighborhood=$id");
$farms = mysql_query("SELECT * FROM farms WHERE neighborhood=$id AND active=1");
$projects = mysql_query("SELECT * FROM projects WHERE neighborhood=$id");

//petitions
$output = '{"petitions":[';
if (mysql_num_rows($petitions) > 0) {
    while ($p = mysql_fetch_assoc($petitions)) {
        $demands = mysql_query("SELECT * FROM product_demand WHERE owner = " . $p['id']);
        if (mysql_num_rows($demands) > 0) {
            $ds = array();
            while ($d = mysql_fetch_assoc($demands)) {
                $ds[] = $d;
            }
            $p['demands'] = $ds;
        }
        $output .= json_encode($p) . ',';
    }
    $output = substr($output, 0, -1);
}
$output .= '],';

//farms
$output .= '"farms":[';
if (mysql_num_rows($farms) > 0) {
    while ($f = mysql_fetch_assoc($farms)) {
        $output .= json_encode($f) . ',';
    }
    $output = substr($output, 0, -1);
}
$output .= '],';

//projects
$output .= '"projects":[';
if (mysql_num_rows($projects) > 0) {
    while ($p = mysql_fetch_assoc($projects)) {
        $output .= json_encode($p) . ',';
    }
    $output = substr($output, 0, -1);
}
$output .= ']}';

echo $output;
?>