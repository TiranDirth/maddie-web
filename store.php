<?php

require __DIR__ . '/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Common\Aws;
include './madfunctions.php';

	$aws = Aws::factory('awsconfig.php');
	$client = $aws->get('s3');
	buildstart();
	echo 	"<body>";
	$rawform = $_POST;
	
	//This script takes the input from display, and turns it in to a JSON
	
	echo "<p>Recieved data for " . $rawform["maskname"] . " the " . $rawform["playbook"] . ", played by " . $rawform["playername"] . ". </p><p>Now creating a new JSON file.</p>";
	
	//identify what we are working with
	//build an array for each of the things we were sent
	
	// Basic info
	
	$characterName = $rawform["maskname"];
	$playerName = $rawform["playername"];
	$playbook = $rawform["playbook"];
	
	$basicinfo = array("characterName" => $characterName, "playerName" => $playerName, "playbook" => $playbook);
	
	// Labels Locking currently non functional, must fix this!
	
	if (array_key_exists ( 'soldier' , $rawform)){
		$labels = array("labels" => array("freak" => array("value" => $rawform["freak"], "locked" => "false"),
			"danger" => array("value" => $rawform["danger"], "locked" => "false"),
			"savior" => array("value" => $rawform["savior"], "locked" => "false"),
			"superior" => array("value" => $rawform["superior"], "locked" => "false"),
			"mundane" => array("value" => $rawform["mundane"], "locked" => "false"),
			"soldier" => array("value" => $rawform["soldier"], "locked" => "false"),
		));
	} else {
		$labels = array("labels" => array("freak" => array("value" => $rawform["freak"], "locked" => "false"),
			"danger" => array("value" => $rawform["danger"], "locked" => "false"),
			"savior" => array("value" => $rawform["savior"], "locked" => "false"),
			"superior" => array("value" => $rawform["superior"], "locked" => "false"),
			"mundane" => array("value" => $rawform["mundane"], "locked" => "false"),
		));
	}
	
	// Conditions
	
	// Potential and Advancements
	
	// Moves picked
	
	// Begin Playbook Specifics
	
		//Flares
	
		//Drives
	
		//Bulls Heart
	
		//DOOM
	
		//Sanctuary
	
		//Harbinger Memories
	
		//Future Life
	
		//Janus Mask Label, also put default values in here for everything else until we get a better version
	
		//Lessons
	
		//Nomad Influence
	
		//Mentor
	
		//Base & Resources
	
		//Friends in Low Places
	
		//Respect
	
		//Audience
	
	
	//Additional info, currently not used
	
	
	
	// Merge the arrays
	
	$wipjson = array_merge($basicinfo, $labels);
	
	//print_r ($wipjson);
	
	// Encode the array
	
	$testjson = json_encode($wipjson);
	echo $testjson;
	
?>