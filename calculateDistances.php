<?php

require_once("common.inc.php");

function crowDistance($lat1, $lon1, $lat2, $lon2) {
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	return $dist * 60 * 1.1515 * 1.609344;
}

function drivingInfo($jsonFile) {
	$directions = json_decode(file_get_contents($jsonFile));
	$distance = 0;
	$duration = 0;
	$route = $directions->routes[0];
	$leg = $route->legs[0];
	$distance = $leg->distance->value / 1000;
	$duration = $leg->duration->value / 3600;
	return array( "distance" => $distance, "duration" => $duration);
}

for ($i = 0; $i < count($stadia); $i++) {
	$stadiumI = $stadia[$i];
	$crowDistance = 0;
	$drivingDistance = 0;
	$drivingDuration = 0;	
	for ($j = 0; $j < count($stadia); $j++) {
		if ($j == $i) {
			continue;
		}
		
		$stadiumJ = $stadia[$j];
		
		$crowDistance += crowDistance($stadiumI[$idxLat], $stadiumI[$idxLon], $stadiumJ[$idxLat], $stadiumJ[$idxLon]);	
		$drivingInfo = drivingInfo($directionsDir."/".$stadiumI[$idxTeamName]." - ".$stadiumJ[$idxTeamName].".json");	
		$drivingDistance += $drivingInfo["distance"];
		$drivingDuration += $drivingInfo["duration"];
	}
	echo $stadiumI[$idxTeamName]."\t".round($crowDistance, 2)."\t".round($drivingDistance, 2)."\t".round($drivingDuration, 2)."\n";
}


?>