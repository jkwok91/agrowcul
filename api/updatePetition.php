<?php
    include("config.php");
    require_once("MCAPI.class.php");
    $connection = mysql_connect(HOST, USER, PW);
    mysql_select_db(DB, $connection);

    $custType = $_GET['custType'];
    $name = mysql_real_escape_string(stripcslashes($_GET['name']));i
    $id = $_GET['id'];
    $email = $_GET['email'];
    if ($custType=="others") $custType = $_GET['custType-others'];

    $api = new MCAPI(MC_APIKEY);
    //Farm Request ListId
    $listId = "a9a7385395";

    $update = mysql_query("UPDATE petitions SET type='$custType', name='$name' WHERE id='$id'");
    if (!$update) die(mysql_error());
	
	//comma separated string of food groups
    $foodList = '"';
	$keys = array_keys($_GET);
    foreach($keys as $key):
        if (substr($_GET[$key], 0, 2) == "cb"):
			if (empty($foodList)){
				$foodList .= substr($_GET[0],3);
			} else{
			$foodList .= '\,'.(substr($_GET[0],3));
			}
            $u = mysql_query("INSERT INTO product_demand (owner, name) VALUES (".$_GET['id'].",'".substr($_GET[$key], 3)."')");
            if (!$u) die(mysql_error());
        endif;
    endforeach;
	$foodList .= '"';

    //gather information other than email-- i.e. neighborhood
    $merge_vars = array("GROUPINGS"=>array(array('name'=>'Food Interests','groups'=>$foodList)));
    $retval = $api->listUpdateMember($listId,$email,$merge_vars,'html',false)
*/
    echo("success");
?>