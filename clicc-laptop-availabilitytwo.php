<?php

/*
 * This file fetches a JSON file containing laptop count for each pod
 * from the library's REST-based web service, and parses it. 
 * The function is used in the clicc-available-laptops module located
 * in /templates/modules/mod-clicc_available_laptops.tpl
 */

 function get_laptops() {

    // Check if production server
    if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == "www.clicc.ucla.edu") {
        $jsonurl = "http://webservices.library.ucla.edu/laptops/available";
    }
    // Otherwise use dev url
    else {
        $jsonurl = "http://webservices.library.ucla.edu/laptopsdev/available";
    }
	$json_output = json_decode(file_get_contents($jsonurl));
	
    foreach ($json_output->laptops as $laptop)
    {
        $avail_dict[] = array("location" => $laptop->publicName, "count" => $laptop->availableCount);
    }
	
	return $avail_dict;
	
 }  
 
 ?>
