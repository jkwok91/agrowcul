<?php
    require_once("config.php");
    require_once("MCAPI.class.php");
    $connection = mysql_connect(HOST, USER, PW);
    mysql_select_db(DB, $connection);
    
    $custType = $_GET['custType'];
    $name = mysql_real_escape_string(stripcslashes($_GET['name']));
    $id = $_GET['id'];
    $email = $_GET['email'];
    if ($custType=="others") $custType = $_GET['custType-others'];
   
    $api = new MCAPI(MC_APIKEY);
    //Farm Request ListId
    $listId = "a9a7385395";
 
    $update = mysql_query("UPDATE petitions SET type='$custType', name='$name' WHERE id=".$_GET['id']);
    if (!$update) die(mysql_error());
    
	//comma separated string of food groups
    $foodList = "";
    $keys = array_keys($_GET);
    foreach($keys as $key):
        if (substr($_GET[$key], 0, 2) == "cb"):
	    if ($foodList==""){
	        $foodList .= substr($_GET[$key],3);
	    } else{
	        $foodList .= ','.(substr($_GET[$key],3));
	    }
            $u = mysql_query("INSERT INTO product_demand (owner, name) VALUES (".$_GET['id'].",'".substr($_GET[$key], 3)."')");
            if (!$u) die(mysql_error());
        endif;
    endforeach;

    //gather information other than email-- i.e. neighborhood
    $merge_vars = array("FNAME"=>$name,"GROUPINGS"=>array(array('name'=>'Food Interests','groups'=>$foodList)));
    $retval = $api->listUpdateMember($listId,$email,$merge_vars,'html',false);
 
    if ($api->errorCode){
	echo "Unable to load listUpdateMember()!\n";
	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";
    } else {
        echo "FIXED\n";
    }

    echo ("success");

?>
