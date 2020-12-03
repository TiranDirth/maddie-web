<?PHP
//This file contains the functions we want to call regularly
require __DIR__ . '/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Common\Aws;

// Set up our headers
function buildstart(){
	echo "<head>
			<link rel=\"stylesheet\" href=\"maddie.css\">
			<title>WebMADDIE</title>
		</head>";
}

//connect to AWS and get the characters relating to the discord userID, this takes the discord ID as input
function awsconnect(string $userid){
		// Log in to AWS

	$aws = Aws::factory('awsconfig.php');
	$client = $aws->get('s3');
	
	// List my buckets, not needed
	/*
	$result = $client->listBuckets();
	
	foreach ($result['Buckets'] as $bucket) {
		// Each Bucket value will contain a Name and CreationDate
		echo "I have access to " . "{$bucket['Name']}" . "<br>";
	}
	*/

	// Get a list of files in the Adventures folder
	$iterator = $client->getIterator('ListObjects', array('Bucket' => 'maddiestorage', 'Prefix' => 'adventures'));
	echo "<p><br> The following objects were located: <br></p>";

	// list the files, do not do this unless testing
	/*
	foreach ($iterator as $object) {
		echo $object['Key'] . "\n";
	}
	*/
	
	$folder = true;
	foreach ($iterator as $object) {
		$splitpath = explode('/', $object['Key']);
		if (!$folder){ //skip the folder, we just care about the contents
			if ($splitpath[2] == $userid . ".json"){
				//echo $object['Key'] . "<br>";
				//Get the characters file
				$dlfile = $client->getObject(array(
					'Bucket' => 'maddiestorage',
					'Key'    => $object['Key']
				));
				// dump the whole file
				// echo $dlfile['Body'] . "<br> <br>";
				// display the name
				$decodechar = json_decode($dlfile['Body'], true);
				echo "<p>Found a character you have played named: " . $decodechar['characterName'] . "</p>";
				//Create a form for each character to post what is required forwards to character display
				echo "<form action=\"./display.php\" method=\"post\">
                <legend>" . $decodechar['characterName'] . " the " . $decodechar['playbook'] . "</legend> <div class=\"buttonholder\"><button class=\"btn btn-default col-lg-2 col-md-2 col-sm-4 col-xs-6\" name=\"charkey\" type=\"submit\" value=" . $object['Key'] . ">
                        Use this Character</i></button></div></form>";
			}
		}
		$folder = false;
	}
	echo "</p>";
	// Get Karas file
	/*
	$dlfile = $client->getObject(array(
		'Bucket' => 'maddiestorage',
		'Key'    => '/adventures/696756212884308059/243509483303731201.json'
	));
	
	
	// The 'Body' value of the result is an EntityBody object
	echo get_class($dlfile['Body']) . "\n";
	// > Guzzle\Http\EntityBody

	// The 'Body' value can be cast to a string
	echo $dlfile['Body'] . "\n";
	// > Hello!
	*/
}