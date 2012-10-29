<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//MailChimp API Key
$key = "d30bef74c2e97ea3366fcd8cf1968baf-us2";

//List ID
$list_id = "55f2ba2c0f";

require_once('MCAPI.class.php');

$api = new MCAPI($key);

if ($api->listSubscribe($list_id, $_GET['email'], '') === true) {
    echo 'OK';
} else {	
    echo 'Error: ' . $api->errorMessage;
}
?>
