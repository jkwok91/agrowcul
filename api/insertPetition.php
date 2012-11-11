<?php
include('config.php');
require_once('MCAPI.class.php');
session_start();
$connection = mysql_connect(HOST, USER, PW);
mysql_select_db(DB, $connection);

$address = mysql_real_escape_string(stripcslashes($_GET["address"]));
$email = mysql_real_escape_string(stripcslashes($_GET["email"]));
$lat = $_GET["lat"];
$lng = $_GET["lng"];
$nbhd = mysql_real_escape_string(stripcslashes($_GET["neighborhood"]));

$_SESSION['email'] = $_GET['email'];

$results = mysql_query("SELECT id FROM nbhdz WHERE name='$nbhd'");
$num = mysql_num_rows($results);
$nid;
if ($num >= 1) {
    $n = mysql_fetch_array($results);
    $nid = $n['id'];
} else {
    mysql_query("INSERT INTO neighborhoods (name, lat, lng) VALUES ('$nbhd','$lat','$lng')");
    $n = mysql_fetch_array(mysql_query("SELECT id FROM neighborhoods WHERE name='$nbhd'"));
    $nid = $n['id'];
}

//will eventually move this into another file
//need to implement neighborhood-adding?
//muse on this after implementing dropdown/autocomplete neighborhoods
$api = new MCAPI(MC_APIKEY);

$listId = "a9a7385395";
$n_already_exists = false;
$groupings = $api->listInterestGroupings($listId);
$grouping_id = $groupings[0]["id"];
$n_groups = $groupings[0]["groups"];
foreach ($group as $n_groups){
    if ($address == $group["name"]){
        $n_already_exists = true;
    }
}
if (!$n_already_exists){
    $new_n = $api->listInterestGroupAdd($listId,$address,$grouping_id);
}

$merge_vars = array('GROUPINGS'=>array(array('name'=>'Neighborhoods','groups'=>$address)));
$results = mysql_query("SELECT id FROM petitions WHERE email='$email'");
$num = mysql_num_rows($results);
if ($num >= 1){
    $u = mysql_fetch_array($results);
    $uid = $u['id'];
    $retval = $api->listUpdateMember($listId,$email,$merge_vars,'html',false);
} else {
    $retval = $api->listSubscribe($listId,$email,$merge_vars,'html',false,false,false,false);
}
if ($api->errorCode){
    $eString = "Unable to load listSubscribe()!  ErrorCode is ".$api->errorCode." errorMsg is ".$api->errorMessage;
} else {
    $eString = "Subbed!";
}
//Insert entry
mysql_query("INSERT INTO petitions (search_address, email, lat, lng, neighborhood) VALUES ('$address','$email','$lat','$lng','$nid')");
$row = mysql_fetch_array(mysql_query("SELECT id FROM petitions ORDER BY id DESC"));
$id = $row['id'];

$res = array('address' => $_GET["address"], 'id' => $id, 'msg' => $eString);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($res);
?>
