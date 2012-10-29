<?php
require_once 'config.php';
require_once 'MCAPI.class.php';

///////TEST TEST TEST TEST

$api = new MCAPI(MC_APIKEY);

//Farm Request ListId
$listId = "a9a7385395";

//gather information other than email-- i.e. neighborhood
$merge_vars = array("NBHD"=>$address);

//new user? see if their email already exists in the list
//mysql shit here.  returns boolean
//$new_user = false;

//then returns success or failure
$retval = $api->listSubscribe($listId,$email,$merge_vars,'html',false,false,false,false);

//ripped this automated response from MC
if ($api->errorCode){
	echo "Unable to load listSubscribe()!\n";
	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";
} else {
    echo "Subscribed - look for the confirmation email!\n";
}

?>
