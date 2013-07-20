stadia
======

Google Maps API client to calculate which Premier League teams fans have the greatest distance to travel

To use:

1) Cache the directions:

    **$** php getDirections.php
    fetching directions/Arsenal - Aston Villa.json … done
	fetching directions/Arsenal - Cardiff City.json … done
	fetching directions/Arsenal - Chelsea.json … done
	…

2) Calculate the distances:

    **$** php calculateDistances.php 
	Arsenal	3447.56	4143.49	45.59
	Aston Villa	2953.73	3671.09	38.93
	Cardiff City	4311.72	5613.61	59.16
	…
	
Output is:

Team Name, Direct Distance (km), Driving Distance (km), Driving Time (hrs)

(tab separated).