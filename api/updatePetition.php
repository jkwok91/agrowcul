<?php
    require_once("config.php");
    $connection = mysql_connect(HOST, USER, PW);
    mysql_select_db(DB, $connection);
    
    $custType = $_GET['custType'];
    $name = mysql_real_escape_string(stripcslashes($_GET['name']));
    if ($type=="others") $type = $_GET['others'];
    
    $update = mysql_query("UPDATE petitions SET type='$custType', name='$name' WHERE id=".$_GET['id']);
    if (!$update) die(mysql_error());
    
    $keys = array_keys($_GET);
    foreach($keys as $key):
        if (substr($_GET[$key], 0, 2) == "cb"):
            $u = mysql_query("INSERT INTO product_demand (owner, name) VALUES (".$_GET['id'].",'".substr($_GET[$key], 3)."')");
            if (!$u) die(mysql_error());
        endif;
    endforeach;
    
    echo("success");
?>