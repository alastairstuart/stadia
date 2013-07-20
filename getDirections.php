<?php

require_once("common.inc.php");

$context = stream_context_create( array(
  'http'=>array(
    'timeout' => 4.0
  )
));

for ($i = 0; $i < count($stadia); $i++) {
	$stadiumI = $stadia[$i];
	for ($j = 0; $j < count($stadia); $j++) {
		if ($j == $i) {
			continue;
		}
		$stadiumJ = $stadia[$j];
		$filenameOut=$directionsDir."/".$stadiumI[$idxTeamName]." - ".$stadiumJ[$idxTeamName].".json";
		$origin=$stadiumI[$idxLat].",".$stadiumI[$idxLon];
		$destination=$stadiumJ[$idxLat].",".$stadiumJ[$idxLon];
		$url="http://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&destination=".$destination."&sensor=false";
		echo "fetching ".$filenameOut." …";
		$fh = @fopen($url, 'r', false, $context);
		if ($fh) {
			file_put_contents($filenameOut, $fh);
			@fclose($fh);
			echo " done\n";
		} else {
			// retry
			$j--;
			echo " retrying…\n";
			@fclose($fh);
			continue;
		}
		// to stop requests blocking
		sleep(2);
	}
}


?>