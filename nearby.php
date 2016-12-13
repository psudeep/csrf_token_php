<?php
/* This is the nearby function used to find nearby places using Google Maps API
and get latitude and longitude and place name from current latitude and longitude.
Here lat and long in function passed as arguement is current lat and long.
Type can be: hospital, gym, chemist, atm etc.  Full list is available below:

*/

function nearby($lat, $long, $type) {
	$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.",".$long."&radius=500&z=3&type=".$type."&keyword=&key=API_KEY_MAPS";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_HTTPGET, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
	$op_arr = json_decode($server_output, true);
	$res = json_encode($op_arr['results']);
	$c = count($op_arr['results']);
	if($c>0){
		for($i=0;$i<$c;$i++){
			$geometry = $op_arr['results'][$i]['geometry']['location'];
			$name = strip_tags($op_arr['results'][$i]['name']);
			$lat = $geometry['lat'];
			$long = $geometry['lng'];
			$data[] = array("name"=>$name, "lat"=> $lat, "long" => $long);
		}
		return $data;
	}else {
		return false;
	}
}
?>
