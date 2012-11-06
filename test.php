<?php

//THIS SCRIPT POPULATES THE NBHDZ TABLE WITH JSON OBJECT FROM SOCRATA

require_once('api/config.php');
$link = mysql_connect(HOST,USER,PW);
mysql_select_db(DB,$link);

$n_data = file_get_contents("https://nycopendata.socrata.com/api/views/4nye-fm5p/rows.json");
$n_array = json_decode($n_data,true);
if ($n_array){
	mysql_query("DROP TABLE IF EXISTS nbhdz",$link) or die('could not drop: '.mysql_error());
	$stuff = mysql_query("CREATE TABLE nbhdz(
		      id INT NOT NULL AUTO_INCREMENT,
		      name VARCHAR(32) NOT NULL,
		      borough VARCHAR(16) NOT NULL,
		      PRIMARY KEY (id));",$link);
	var_dump($stuff);
	$n_list = $n_array["data"];
	foreach($n_list as $nbhd){
		$nbhd_name = $nbhd[11];
		$nbhd_boro = $nbhd[10];
		mysql_query("INSERT INTO nbhdz (name,borough) VALUES ('$nbhd_name','$nbhd_boro')");
		//echo($nbhd[11].", ".$nbhd[10]."\n");
	}
	mysql_close($link);
}
?>
