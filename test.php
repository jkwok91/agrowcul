<?php

//THIS SCRIPT POPULATES THE NBHDZ TABLE WITH JSON OBJECT FROM SOCRATA

require_once('api/config.php');
$link = mysql_connect(HOST,USER,PW);
mysql_select_db(DB,$link);

$n_data = file_get_contents("https://nycopendata.socrata.com/api/views/h7s7-7pqs/rows.json");
$n_array = json_decode($n_data,true);
if ($n_array){
	mysql_query("DROP TABLE IF EXISTS nbhdz",$link) or die('could not drop: '.mysql_error());
	$stuff = mysql_query("CREATE TABLE nbhdz(
		      id INT NOT NULL AUTO_INCREMENT,
		      name VARCHAR(64) NOT NULL,
		      borough VARCHAR(16) NOT NULL,
		      lat FLOAT NOT NULL,
		      lng FLOAT NOT NULL,
		      PRIMARY KEY (id));",$link);
	var_dump($stuff);
	$n_list = $n_array["data"];
	$array_for_json = array();
	foreach($n_list as $nbhd){
		$nbhd_name = $nbhd[10];
		$nbhd_boro = $nbhd[11];
		$nbhd_lat = $nbhd[9][5]['point'][0];
		$nbhd_lng = $nbhd[9][5]['point'][1];
		$array_for_json[] = $nbhd_name;
		mysql_query("INSERT INTO nbhdz (name,borough,lat,lng) VALUES ('$nbhd_name','$nbhd_boro','$nbhd_lat','$nbhd_lng')");
	}
	mysql_close($link);
	$file = fopen('nbhds.json', 'w');
	fwrite($file,'{"terms": '.json_encode($array_for_json).'}');
	fclose($file);
}
?>
