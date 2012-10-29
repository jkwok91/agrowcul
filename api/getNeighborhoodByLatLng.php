<?php
//filtering with latlng

//Greenpoint
if ($_GET['lat'] == 40.7245448 && $_GET['lng'] == -73.94186030000003) die('Greenpoint');

//use the urbanmapping API
$key = "9a589e58cde46301a3b9825a6fcb0edd";
$file = fopen("http://api0.urbanmapping.com/neighborhoods/rest/getNeighborhoodsByLatLng?lat=$_GET[lat]&lng=$_GET[lng]&format=json&apikey=$key&results=one", "r");
$output = '';
if ($file) {
    while(!feof($file)){
        $buffer = fgets($file, 4096);
        $output .= $buffer;
    }
}
fclose($file);
$output = json_decode($output);
$name = $output[0]->name;

//Individual adjustments on search results
switch ($name) {
    case "North Slope":
        $name = "Park Slope";
        break;
	case "Central Slope":
		$name = "Park Slope";
		break;
    case "North Side":
        $name = "Greenpoint";
		break;
}
//========================================

echo $name;
?>