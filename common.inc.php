<?php

$filename = "stadia.csv";
$stadiaAll = explode("\n", file_get_contents($filename));
foreach ($stadiaAll as $entry) {
    $stadia[] = explode(",", $entry);
}

$directionsDir="directions";

$idxStadiumName=0;
$idxTeamName=1;
$idxCapacity=2;
$idxLat=3;
$idxLon=4;

?>