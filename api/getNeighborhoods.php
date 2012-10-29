<?php

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

require_once("config.php");
$connection = mysql_connect(HOST, USER, PW);
mysql_select_db(DB, $connection);

$result = mysql_query("SELECT * FROM neighborhoods");
$json = '{"neighborhoods":[';

while ($nbhd = mysql_fetch_assoc($result)):

    if ($nbhd['name'] != ""):

        $id = $nbhd['id'];
        $petitions = mysql_num_rows(mysql_query("SELECT * FROM petitions WHERE neighborhood=$id"));
        $farms = mysql_num_rows(mysql_query("SELECT * FROM farms WHERE neighborhood=$id AND active=1"));
        $projects = mysql_num_rows(mysql_query("SELECT * FROM projects WHERE neighborhood=$id"));
        $njson = substr(json_encode($nbhd), 0, -1);
        $njson .= ",\"num_petitions\":$petitions";
        $njson .= ",\"num_farms\":$farms";
        $njson .= ",\"num_projects\":$projects},";

        $json .= $njson;

    endif;

endwhile;

$json = substr($json, 0, -1) . ']}';

echo $json;
?>
