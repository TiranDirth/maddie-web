<?php

require __DIR__ . '/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Common\Aws;
include './madfunctions.php';

	$aws = Aws::factory('awsconfig.php');
	$client = $aws->get('s3');
	buildstart();
	echo 	"<body>";
	$dlfile = $client->getObject(array(
		'Bucket' => 'maddiestorage',
		'Key'    => htmlspecialchars($_POST["charkey"])
	));
	
// echo "<p>TODO: Make this look nice <br>";
// echo $dlfile['Body'] . "<br> <br>";

$decodechar = json_decode($dlfile['Body'], true);
$enjson = file_get_contents("./language_files/en.json");
$enmoves = json_decode($enjson, true);

$cname = $decodechar['characterName'];
$cplaybook = $decodechar['playbook'];

// Build the form, that is to say, the character sheet
echo "<p>Building a form for " . $cname . " the " . $cplaybook . "</p>";

// Get our playbook section for mot etc.
	$selectedPlaybook = null;
	foreach ($enmoves['playbooks'] as $playbook) {
		if ($playbook['name'] === $cplaybook) {
			$selectedPlaybook = $playbook;
         break;
		}
	}
	if (!$selectedPlaybook) {
		// Handle not finding what you were after
	}
	
	// get our labels
	
	//echo "<p>";
	//print_r ($decodechar['labels']); 
	//echo "</p>";
	$count=0;
	foreach ($decodechar['labels'] as $label) {
		if ($count == 1) {
			$danger = $label['value'];
			$dangerlocked = $label['locked'];
		} elseif ($count == 0) {
			$freak = $label['value'];
			$freaklocked = $label['locked'];
		} elseif ($count == 2) {
			$savior = $label['value'];
			$saviorlocked = $label['locked'];
		} elseif ($count == 3) {
			$superior = $label['value'];
			$superiorlocked = $label['locked'];
		} elseif ($count == 4) {
			$mundane = $label['value'];
			$mundanelocked = $label['locked'];
		} elseif ($count == 5) {
			$soldier = $label['value'];
			$soldierlocked = $label['locked'];
		}
		$count++;
	}
	
	
	//build the character form
echo "<form>
	<div class=\"pleft\">Moment of Truth</div>
	<textarea name=\"mot\" rows=\"10\" cols=\"50\">" . $selectedPlaybook['mot'] . "</textarea><br>
	<div class=\"pleft\"><p>Triumph</p></div>
	<textarea name=\"celebrate\" rows=\"10\" cols=\"50\">" . $selectedPlaybook['celebrate'] . "</textarea><br>
	<div class=\"pleft\"><p>Vulnerability</p></div>
	<textarea name=\"weakness\" rows=\"10\" cols=\"50\">" . $selectedPlaybook['weakness'] . "</textarea><br>
	<table style=\"width:800\">
	<tr>
	<th><p>Danger</p></th>
    <th><p>Freak</p></th>
    <th><p>Savior</p></th>
	<th><p>Superior</p></th>
    <th><p>Mundane</p></th>";
	if ($cplaybook == 'soldier'){
		echo "<th>Extra</th>";
	}
	echo "
	</tr>
	<tr>
	<td>
	<input type=\"radio\" id=\"-2\" name=\"danger\" value=\"-2\""; if($danger==-2){echo "checked";} echo ">
	<label for=\"-2\">-2</label><br>
	<input type=\"radio\" id=\"-1\" name=\"danger\" value=\"-1\""; if($danger==-1){echo "checked";} echo ">
	<label for=\"-1\">-1</label><br>
	<input type=\"radio\" id=\"+0\" name=\"danger\" value=\"+0\""; if($danger==-0){echo "checked";} echo ">
	<label for=\"+0\">0</label><br>
	<input type=\"radio\" id=\"+1\" name=\"danger\" value=\"+1\""; if($danger==1){echo "checked";} echo ">
	<label for=\"+1\">+1</label><br>
	<input type=\"radio\" id=\"+2\" name=\"danger\" value=\"+2\""; if($danger==2){echo "checked";} echo ">
	<label for=\"+2\">+2</label><br>
	<input type=\"radio\" id=\"+3\" name=\"danger\" value=\"+3\""; if($danger==3){echo "checked";} echo ">
	<label for=\"+3\">+3</label>
	</td>
	<td>
	<input type=\"radio\" id=\"-2\" name=\"freak\" value=\"-2\""; if($freak==-2){echo "checked";} echo ">
	<label for=\"-2\">-2</label><br>
	<input type=\"radio\" id=\"-1\" name=\"freak\" value=\"-1\""; if($freak==-1){echo "checked";} echo ">
	<label for=\"-1\">-1</label><br>
	<input type=\"radio\" id=\"+0\" name=\"freak\" value=\"+0\""; if($freak==-0){echo "checked";} echo ">
	<label for=\"+0\">0</label><br>
	<input type=\"radio\" id=\"+1\" name=\"freak\" value=\"+1\""; if($freak==1){echo "checked";} echo ">
	<label for=\"+1\">+1</label><br>
	<input type=\"radio\" id=\"+2\" name=\"freak\" value=\"+2\""; if($freak==2){echo "checked";} echo ">
	<label for=\"+2\">+2</label><br>
	<input type=\"radio\" id=\"+3\" name=\"freak\" value=\"+3\""; if($freak==3){echo "checked";} echo ">
	<label for=\"+3\">+3</label>
	</td>
	<td>
	<input type=\"radio\" id=\"-2\" name=\"savior\" value=\"-2\""; if($savior==-2){echo "checked";} echo ">
	<label for=\"-2\">-2</label><br>
	<input type=\"radio\" id=\"-1\" name=\"savior\" value=\"-1\""; if($savior==-1){echo "checked";} echo ">
	<label for=\"-1\">-1</label><br>
	<input type=\"radio\" id=\"+0\" name=\"savior\" value=\"+0\""; if($savior==-0){echo "checked";} echo ">
	<label for=\"+0\">0</label><br>
	<input type=\"radio\" id=\"+1\" name=\"savior\" value=\"+1\""; if($savior==1){echo "checked";} echo ">
	<label for=\"+1\">+1</label><br>
	<input type=\"radio\" id=\"+2\" name=\"savior\" value=\"+2\""; if($savior==2){echo "checked";} echo ">
	<label for=\"+2\">+2</label><br>
	<input type=\"radio\" id=\"+3\" name=\"savior\" value=\"+3\""; if($savior==3){echo "checked";} echo ">
	<label for=\"+3\">+3</label>
	</td>
	<td>
	<input type=\"radio\" id=\"-2\" name=\"superior\" value=\"-2\""; if($superior==-2){echo "checked";} echo ">
	<label for=\"-2\">-2</label><br>
	<input type=\"radio\" id=\"-1\" name=\"superior\" value=\"-1\""; if($superior==-1){echo "checked";} echo ">
	<label for=\"-1\">-1</label><br>
	<input type=\"radio\" id=\"+0\" name=\"superior\" value=\"+0\""; if($superior==-0){echo "checked";} echo ">
	<label for=\"+0\">0</label><br>
	<input type=\"radio\" id=\"+1\" name=\"superior\" value=\"+1\""; if($superior==1){echo "checked";} echo ">
	<label for=\"+1\">+1</label><br>
	<input type=\"radio\" id=\"+2\" name=\"superior\" value=\"+2\""; if($superior==2){echo "checked";} echo ">
	<label for=\"+2\">+2</label><br>
	<input type=\"radio\" id=\"+3\" name=\"superior\" value=\"+3\""; if($superior==3){echo "checked";} echo ">
	<label for=\"+3\">+3</label>
	</td>
	<td>
	<input type=\"radio\" id=\"-2\" name=\"mundane\" value=\"-2\""; if($mundane==-2){echo "checked";} echo ">
	<label for=\"-2\">-2</label><br>
	<input type=\"radio\" id=\"-1\" name=\"mundane\" value=\"-1\""; if($mundane==-1){echo "checked";} echo ">
	<label for=\"-1\">-1</label><br>
	<input type=\"radio\" id=\"+0\" name=\"mundane\" value=\"+0\""; if($mundane==-0){echo "checked";} echo ">
	<label for=\"+0\">0</label><br>
	<input type=\"radio\" id=\"+1\" name=\"mundane\" value=\"+1\""; if($mundane==1){echo "checked";} echo ">
	<label for=\"+1\">+1</label><br>
	<input type=\"radio\" id=\"+2\" name=\"mundane\" value=\"+2\""; if($mundane==2){echo "checked";} echo ">
	<label for=\"+2\">+2</label><br>
	<input type=\"radio\" id=\"+3\" name=\"mundane\" value=\"+3\""; if($mundane==3){echo "checked";} echo ">
	<label for=\"+3\">+3</label>
	</td>";
	if ($cplaybook == 'soldier'){
		echo "
	<td>
	<input type=\"radio\" id=\"-2\" name=\"soldier\" value=\"-2\""; if($soldier==-2){echo "checked";} echo ">
	<label for=\"-2\">-2</label><br>
	<input type=\"radio\" id=\"-1\" name=\"soldier\" value=\"-1\""; if($soldier==-1){echo "checked";} echo ">
	<label for=\"-1\">-1</label><br>
	<input type=\"radio\" id=\"+0\" name=\"soldier\" value=\"+0\""; if($soldier==-0){echo "checked";} echo ">
	<label for=\"+0\">0</label><br>
	<input type=\"radio\" id=\"+1\" name=\"soldier\" value=\"+1\""; if($soldier==1){echo "checked";} echo ">
	<label for=\"+1\">+1</label><br>
	<input type=\"radio\" id=\"+2\" name=\"soldier\" value=\"+2\""; if($soldier==2){echo "checked";} echo ">
	<label for=\"+2\">+2</label><br>
	<input type=\"radio\" id=\"+3\" name=\"soldier\" value=\"+3\""; if($soldier==3){echo "checked";} echo ">
	<label for=\"+3\">+3</label>
	</td>";
	}
	echo "
	</tr>
	</table>
	";
// Current conditions

$hasdamaged = false; //assume for now our character is most likely not a newborn with the damage condition, we'll check later
$conditions = $decodechar['conditions'];
$afraid = $conditions['afraid'];
$angry =  $conditions['angry'];
$guilty = $conditions['guilty'];
$hopeless = $conditions['hopeless'];
$insecure = $conditions['insecure'];
if (array_key_exists ( 'damaged' , $conditions)){
	$damaged = $conditions['damaged']; //if they have that condition, now we know
	$hasdamaged = true;
}

echo "
	<p>Your Current Conditions:</p>
	<input type=\"checkbox\" id=\"afraid\" name=\"afraid\" value=\"Afraid\""; if ($afraid){echo "checked";} echo ">
	<label for=\"afraid\">Afraid</label><br>
	<input type=\"checkbox\" id=\"angry\" name=\"angry\" value=\"Angry\""; if ($angry){echo "checked";} echo ">
	<label for=\"angry\">Angry</label><br>
	<input type=\"checkbox\" id=\"guilty\" name=\"guilty\" value=\"Guilty\""; if ($guilty){echo "checked";} echo ">
	<label for=\"guilty\">Guilty</label><br>
	<input type=\"checkbox\" id=\"hopeless\" name=\"hopeless\" value=\"Hopeless\""; if ($hopeless){echo "checked";} echo ">
	<label for=\"hopeless\">Hopeless</label><br>
	<input type=\"checkbox\" id=\"insecure\" name=\"insecure\" value=\"Insecure\""; if ($insecure){echo "checked";} echo ">
	<label for=\"insecure\">Insecure</label><br>";
	if ($hasdamaged){
		echo "
	<input type=\"checkbox\" id=\"damaged\" name=\"damaged\" value=\"Damaged\""; if ($damaged){echo "checked";} echo ">
	<label for=\"damaged\">Damaged</label><br>";
	}
	
//Advancements
echo "<br>You have <input type=\"number\" id=\"potential\" name=\"potential\" min=\"0\" max=\"4\" value="; 
echo $decodechar['potential']; 
echo "> potential and <input type=\"number\" id=\"padvancements\" name=\"padvancements\" min=\"0\" max=\"12\" value="; 
echo $decodechar['pendingAdvancements']; 
echo "> pending advancements to take.<br>";

$advcounter = 0;
foreach ($decodechar['advancement'] as $advtype) {
	foreach ($advtype as $oneadvance){
		if ($advcounter >= 14){
			break;
		}
		//print_r ($oneadvance); 
		echo $oneadvance['description'] . "<input type=\"checkbox\" id=\"" . $advcounter . "\" name=\"" . $advcounter . "\" value=\"" . $advcounter . "\" "; if ($oneadvance['taken']){echo "checked";} echo "><br>";
		$advcounter++;
	}
}


//Moves
echo "<br>Your current moves are: <br>";
foreach ($decodechar['moves'] as $amove) {
	if ($amove['picked']){
		$moveid = $amove['id'];
		
		//get the move data we need out the big json
		$selectedmove = null;
		foreach ($enmoves['moves'] as $findmove) {
			if ($findmove['id'] === $moveid) {
				$selectedmove = $findmove;
			break;
			}
		}
		if (!$selectedmove) {
			// Handle not finding what you were after
		}
			
		
		echo "<h2>" . $selectedmove['capital'] . "</h2><p>" . $selectedmove['blob'] . "</p>";
	}
}

//Start handling playbook specific stuff

echo "<h1>Playbook Specific sections</h1>";

//Nova Flares
$hasflares = false;
//do we have flares?
if (array_key_exists ( 'flares' , $decodechar['advancement'])){
	$hasflares = true;
	echo "<h2>You have flares!</h2>";
}

if ($hasflares){
	$flares =  ($decodechar['advancement'])['flares'];
	
	$storm  = $flares['storm'];
	$shield  = $flares['shield'];  
	$constructs    = $flares['constructs'];
	$moat    = $flares['moat'];
	$worship    = $flares['worship'];
	$move    = $flares['move'];
	$boost    = $flares['boost'];
	$overcharge    = $flares['overcharge'];
	$elemental    = $flares['elemental'];
	$snatch   = $flares['snatch'];

echo "
	<p>Your Flares:</p>
	<input type=\"checkbox\" id=\"storm\" name=\"storm\" value=\"storm\""; if ($storm){echo "checked";} echo ">
	<label for=\"storm\">storm</label><br>
	<input type=\"checkbox\" id=\"shield\" name=\"shield\" value=\"shield\""; if ($shield){echo "checked";} echo ">
	<label for=\"shield\">shield</label><br>
	<input type=\"checkbox\" id=\"constructs\" name=\"constructs\" value=\"constructs\""; if ($constructs){echo "checked";} echo ">
	<label for=\"constructs\">constructs</label><br>
	<input type=\"checkbox\" id=\"moat\" name=\"moat\" value=\"moat\""; if ($moat){echo "checked";} echo ">
	<label for=\"moat\">moat</label><br>
	<input type=\"checkbox\" id=\"worship\" name=\"worship\" value=\"worship\""; if ($worship){echo "checked";} echo ">
	<label for=\"worship\">worship</label><br>
	<input type=\"checkbox\" id=\"move\" name=\"move\" value=\"move\""; if ($move){echo "checked";} echo ">
	<label for=\"move\">move</label><br>
	<input type=\"checkbox\" id=\"boost\" name=\"boost\" value=\"boost\""; if ($boost){echo "checked";} echo ">
	<label for=\"boost\">boost</label><br>
	<input type=\"checkbox\" id=\"overcharge\" name=\"overcharge\" value=\"overcharge\""; if ($overcharge){echo "checked";} echo ">
	<label for=\"overcharge\">overcharge</label><br>
	<input type=\"checkbox\" id=\"elemental\" name=\"elemental\" value=\"elemental\""; if ($elemental){echo "checked";} echo ">
	<label for=\"elemental\">elemental</label><br>
	<input type=\"checkbox\" id=\"snatch\" name=\"snatch\" value=\"snatch\""; if ($snatch){echo "checked";} echo ">
	<label for=\"snatch\">snatch</label><br>";
}

//Nova Flares 2 for the newer format of json
$hasflares2 = false;
//do we have flares?
if (array_key_exists ( 'flares' , $decodechar)){
	$hasflares2 = true;
	echo "<h2>You have flares!</h2>";
}

if ($hasflares2){
	$flares =  decodechar['flares'];
	
	$storm  = $flares['storm'];
	$shield  = $flares['shield'];  
	$constructs    = $flares['constructs'];
	$moat    = $flares['moat'];
	$worship    = $flares['worship'];
	$move    = $flares['move'];
	$boost    = $flares['boost'];
	$overcharge    = $flares['overcharge'];
	$elemental    = $flares['elemental'];
	$snatch   = $flares['snatch'];

echo "
	<p>Your Flares:</p>
	<input type=\"checkbox\" id=\"storm\" name=\"storm\" value=\"storm\""; if ($storm){echo "checked";} echo ">
	<label for=\"storm\">storm</label><br>
	<input type=\"checkbox\" id=\"shield\" name=\"shield\" value=\"shield\""; if ($shield){echo "checked";} echo ">
	<label for=\"shield\">shield</label><br>
	<input type=\"checkbox\" id=\"constructs\" name=\"constructs\" value=\"constructs\""; if ($constructs){echo "checked";} echo ">
	<label for=\"constructs\">constructs</label><br>
	<input type=\"checkbox\" id=\"moat\" name=\"moat\" value=\"moat\""; if ($moat){echo "checked";} echo ">
	<label for=\"moat\">moat</label><br>
	<input type=\"checkbox\" id=\"worship\" name=\"worship\" value=\"worship\""; if ($worship){echo "checked";} echo ">
	<label for=\"worship\">worship</label><br>
	<input type=\"checkbox\" id=\"move\" name=\"move\" value=\"move\""; if ($move){echo "checked";} echo ">
	<label for=\"move\">move</label><br>
	<input type=\"checkbox\" id=\"boost\" name=\"boost\" value=\"boost\""; if ($boost){echo "checked";} echo ">
	<label for=\"boost\">boost</label><br>
	<input type=\"checkbox\" id=\"overcharge\" name=\"overcharge\" value=\"overcharge\""; if ($overcharge){echo "checked";} echo ">
	<label for=\"overcharge\">overcharge</label><br>
	<input type=\"checkbox\" id=\"elemental\" name=\"elemental\" value=\"elemental\""; if ($elemental){echo "checked";} echo ">
	<label for=\"elemental\">elemental</label><br>
	<input type=\"checkbox\" id=\"snatch\" name=\"snatch\" value=\"snatch\""; if ($snatch){echo "checked";} echo ">
	<label for=\"snatch\">snatch</label><br>";
}




//Beacon Drives
$hasdrives = false;
if (array_key_exists ('drives' , $decodechar)){
	$hasdrives = true;
	echo "<h2>You have Drives!</h2>";
}

if ($hasdrives){
	$drives = $decodechar['drives'];
	
	$lead  = $drives['lead'];
	$kissDanger  = $drives['kissDanger'];  
	$hitYouShouldnt    = $drives['hitYouShouldnt'];
	$helpTeammate    = $drives['helpTeammate'];
	$outperform    = $drives['outperform'];
	$ridiculous    = $drives['ridiculous'];
	$saveTeammateLife    = $drives['saveTeammateLife'];
	$drunkOrDrug    = $drives['drunkOrDrug'];
	$drive    = $drives['drive'];
	$newSuit   = $drives['newSuit'];
	$newName    = $drives['newName'];
	$gainRespect    = $drives['gainRespect'];
	$punchTeammate    = $drives['punchTeammate'];
	$breakRelation    = $drives['breakRelation'];
	$stopFight    = $drives['stopFight'];
	$trueFeelings   = $drives['trueFeelings'];
	$placeOrTime    = $drives['placeOrTime'];
	$reject   = $drives['reject'];

echo "
	<p>Your Drives:</p>
	<input type=\"checkbox\" id=\"lead\" name=\"lead\" value=\"lead\""; if ($lead){echo "checked";} echo ">
	<label for=\"lead\">lead</label><br>
	<input type=\"checkbox\" id=\"kissDanger\" name=\"kissDanger\" value=\"kissDanger\""; if ($kissDanger){echo "checked";} echo ">
	<label for=\"kissDanger\">kissDanger</label><br>
	<input type=\"checkbox\" id=\"hitYouShouldnt\" name=\"hitYouShouldnt\" value=\"hitYouShouldnt\""; if ($hitYouShouldnt){echo "checked";} echo ">
	<label for=\"hitYouShouldnt\">hitYouShouldnt</label><br>
	<input type=\"checkbox\" id=\"helpTeammate\" name=\"helpTeammate\" value=\"helpTeammate\""; if ($helpTeammate){echo "checked";} echo ">
	<label for=\"helpTeammate\">helpTeammate</label><br>
	<input type=\"checkbox\" id=\"outperform\" name=\"outperform\" value=\"outperform\""; if ($outperform){echo "checked";} echo ">
	<label for=\"outperform\">outperform</label><br>
	<input type=\"checkbox\" id=\"ridiculous\" name=\"ridiculous\" value=\"ridiculous\""; if ($ridiculous){echo "checked";} echo ">
	<label for=\"ridiculous\">ridiculous</label><br>
	<input type=\"checkbox\" id=\"saveTeammateLife\" name=\"saveTeammateLife\" value=\"saveTeammateLife\""; if ($saveTeammateLife){echo "checked";} echo ">
	<label for=\"saveTeammateLife\">saveTeammateLife</label><br>
	<input type=\"checkbox\" id=\"drunkOrDrug\" name=\"drunkOrDrug\" value=\"drunkOrDrug\""; if ($drunkOrDrug){echo "checked";} echo ">
	<label for=\"drunkOrDrug\">drunkOrDrug</label><br>
	<input type=\"checkbox\" id=\"drive\" name=\"drive\" value=\"drive\""; if ($drive){echo "checked";} echo ">
	<label for=\"drive\">drive</label><br>
	<input type=\"checkbox\" id=\"newSuit\" name=\"newSuit\" value=\"newSuit\""; if ($newSuit){echo "checked";} echo ">
	<label for=\"newSuit\">newSuit</label><br>
	<input type=\"checkbox\" id=\"newName\" name=\"newName\" value=\"newName\""; if ($newName){echo "checked";} echo ">
	<label for=\"newName\">newName</label><br>
	<input type=\"checkbox\" id=\"gainRespect\" name=\"gainRespect\" value=\"gainRespect\""; if ($gainRespect){echo "checked";} echo ">
	<label for=\"gainRespect\">gainRespect</label><br>
	<input type=\"checkbox\" id=\"punchTeammate\" name=\"punchTeammate\" value=\"punchTeammate\""; if ($punchTeammate){echo "checked";} echo ">
	<label for=\"punchTeammate\">punchTeammate</label><br>
	<input type=\"checkbox\" id=\"breakRelation\" name=\"breakRelation\" value=\"breakRelation\""; if ($breakRelation){echo "checked";} echo ">
	<label for=\"breakRelation\">breakRelation</label><br>
	<input type=\"checkbox\" id=\"stopFight\" name=\"stopFight\" value=\"stopFight\""; if ($stopFight){echo "checked";} echo ">
	<label for=\"stopFight\">stopFight</label><br>
	<input type=\"checkbox\" id=\"trueFeelings\" name=\"trueFeelings\" value=\"trueFeelings\""; if ($trueFeelings){echo "checked";} echo ">
	<label for=\"trueFeelings\">trueFeelings</label><br>
	<input type=\"checkbox\" id=\"placeOrTime\" name=\"placeOrTime\" value=\"placeOrTime\""; if ($placeOrTime){echo "checked";} echo ">
	<label for=\"placeOrTime\">placeOrTime</label><br>
	<input type=\"checkbox\" id=\"reject\" name=\"reject\" value=\"reject\""; if ($reject){echo "checked";} echo ">
	<label for=\"reject\">reject</label><br>";
}

// Brains shame would go here if we tracked it, but we currently don't

// Bulls Heart
$hasheart = false;
if (array_key_exists ( 'heart' , $decodechar)){
	$hasheart = true;
	echo "<h2>You have the Bulls Heart!</h2>";
}

if ($hasheart){
	$heart = $decodechar['heart'];

	echo "Your Love is <input type=\"text\" id=\"love\" name=\"love\" content=\"" . $heart['love'] . "\"> and your rival is <input type=\"text\" id=\"rival\" name=\"rival\" content=\"" . $heart['rival'] . "\">.<br>";

	$roles = $heart['roles'];
	
	$defender  = $drives['defender'];
	$friend  = $drives['friend'];  
	$listener    = $drives['listener'];
	$enabler    = $drives['enabler'];

echo "
	<p>Your Roles:</p>
	<input type=\"checkbox\" id=\"defender\" name=\"defender\" value=\"defender\""; if ($defender){echo "checked";} echo ">
	<label for=\"defender\">defender</label><br>
	<input type=\"checkbox\" id=\"friend\" name=\"friend\" value=\"friend\""; if ($friend){echo "checked";} echo ">
	<label for=\"friend\">friend</label><br>
	<input type=\"checkbox\" id=\"listener\" name=\"listener\" value=\"listener\""; if ($listener){echo "checked";} echo ">
	<label for=\"listener\">listener</label><br>
	<input type=\"checkbox\" id=\"enabler\" name=\"enabler\" value=\"enabler\""; if ($enabler){echo "checked";} echo ">
	<label for=\"enabler\">enabler</label><br>";
}

// RIP Delinquent, no fun extras for you


// Doomed stuff, forget I said anything about the delinquent, why you so complex?!

// Doomtrack and such

$hasdoomtrack = false;
if (array_key_exists ( 'doomTrack' , $decodechar)){
	$hasdoomtrack = true;
}
$hasdoombringers = false;
if (array_key_exists ( 'doomBringers' , $decodechar)){
	$hasdoombringers = true;
}
$hasdoomsigns = false;
if (array_key_exists ( 'doomsigns' , $decodechar)){
	$hasdoomsigns = true;
}
$hasdoom = false;
if ($hasdoomtrack && $hasdoombringers && $hasdoomsigns){
	echo "<h2>You have a Doom...</h2>";
	$hasdoom = true;
}
if ($hasdoom){
	echo "<br>You have <input type=\"number\" id=\"doomtrack\" name=\"doontrack\" min=\"0\" max=\"4\" value="; 
	echo $decodechar['doomTrack']; 
	echo "><br>Your doomsigns are: <br>";
	
	$doomcollection = $decodechar['doomsigns'];
	
	$visions  = $doomcollection['visions'];
	$infinite  = $doomcollection['infinite'];  
	$portal    = $doomcollection['portal'];
	$bright    = $doomcollection['bright'];
	$bolstered    = $doomcollection['bolstered'];
	$perish    = $doomcollection['perish'];

echo "
	<p>Your Doomsigns:</p>
	<input type=\"checkbox\" id=\"visions\" name=\"visions\" value=\"visions\""; if ($visions){echo "checked";} echo ">
	<label for=\"visions\">visions</label><br>
	<input type=\"checkbox\" id=\"infinite\" name=\"infinite\" value=\"infinite\""; if ($infinite){echo "checked";} echo ">
	<label for=\"infinite\">infinite</label><br>
	<input type=\"checkbox\" id=\"portal\" name=\"portal\" value=\"portal\""; if ($portal){echo "checked";} echo ">
	<label for=\"portal\">portal</label><br>
	<input type=\"checkbox\" id=\"bright\" name=\"bright\" value=\"bright\""; if ($bright){echo "checked";} echo ">
	<label for=\"bright\">bright</label><br>
	<input type=\"checkbox\" id=\"bolstered\" name=\"bolstered\" value=\"bolstered\""; if ($bolstered){echo "checked";} echo ">
	<label for=\"bolstered\">bolstered</label><br>
	<input type=\"checkbox\" id=\"perish\" name=\"perish\" value=\"perish\""; if ($perish){echo "checked";} echo ">
	<label for=\"perish\">perish</label><br>";
	
	echo "You gain doom from: <br>";

	$doomgains = $decodechar['doomBringers'];
	
	$overexterting  = $doomgains['overexterting'];
	$innocents  = $doomgains['innocents'];  
	$alone    = $doomgains['alone'];
	$bright    = $doomgains['bright'];
	$mercy    = $doomgains['mercy'];
	$openly    = $doomgains['openly'];

echo "
	<p>Your Roles:</p>
	<input type=\"checkbox\" id=\"overexterting\" name=\"overexterting\" value=\"overexterting\""; if ($overexterting){echo "checked";} echo ">
	<label for=\"overexterting\">overexterting</label><br>
	<input type=\"checkbox\" id=\"innocents\" name=\"innocents\" value=\"innocents\""; if ($innocents){echo "checked";} echo ">
	<label for=\"innocents\">innocents</label><br>
	<input type=\"checkbox\" id=\"alone\" name=\"alone\" value=\"alone\""; if ($alone){echo "checked";} echo ">
	<label for=\"alone\">alone</label><br>
	<input type=\"checkbox\" id=\"loved\" name=\"loved\" value=\"loved\""; if ($loved){echo "checked";} echo ">
	<label for=\"loved\">loved</label><br>
	<input type=\"checkbox\" id=\"mercy\" name=\"mercy\" value=\"mercy\""; if ($mercy){echo "checked";} echo ">
	<label for=\"mercy\">mercy</label><br>
	<input type=\"checkbox\" id=\"openly\" name=\"openly\" value=\"openly\""; if ($openly){echo "checked";} echo ">
	<label for=\"openly\">openly</label><br>";
}

// Sanctuary
$hassanctuary = false;
if (array_key_exists ( 'sanctuary' , $decodechar)){
	$hassanctuary = true;
	echo "<h2>You have a sanctuary!</h2>";
}

if ($hassanctuary){
	$sanctuary = $decodechar['sanctuary'];
	
	//features
	$sanfeatures = $sanctuary['features'];
	
	$assistant  = $sanfeatures['assistant'];
	$traps  = $sanfeatures['traps'];  
	$tomes    = $sanfeatures['tomes'];
	$relics    = $sanfeatures['relics'];
	$teleportal    = $sanfeatures['teleportal'];
	$containment    = $sanfeatures['containment'];
	$computer    = $sanfeatures['computer'];
	$tools    = $sanfeatures['tools'];
	$meditation    = $sanfeatures['meditation'];
	$battery   = $sanfeatures['battery'];
	$enhancement    = $sanfeatures['enhancement'];
	$healing    = $sanfeatures['healing'];
	$art    = $sanfeatures['art'];

echo "
	<p>Your Sanctuary has the following features:</p>
	<input type=\"checkbox\" id=\"assistant\" name=\"assistant\" value=\"assistant\""; if ($assistant){echo "checked";} echo ">
	<label for=\"assistant\">assistant</label><br>
	<input type=\"checkbox\" id=\"traps\" name=\"traps\" value=\"traps\""; if ($traps){echo "checked";} echo ">
	<label for=\"traps\">traps</label><br>
	<input type=\"checkbox\" id=\"tomes\" name=\"tomes\" value=\"tomes\""; if ($tomes){echo "checked";} echo ">
	<label for=\"tomes\">tomes</label><br>
	<input type=\"checkbox\" id=\"relics\" name=\"relics\" value=\"relics\""; if ($relics){echo "checked";} echo ">
	<label for=\"relics\">relics</label><br>
	<input type=\"checkbox\" id=\"teleportal\" name=\"teleportal\" value=\"teleportal\""; if ($teleportal){echo "checked";} echo ">
	<label for=\"teleportal\">teleportal</label><br>
	<input type=\"checkbox\" id=\"containment\" name=\"containment\" value=\"containment\""; if ($containment){echo "checked";} echo ">
	<label for=\"containment\">containment</label><br>
	<input type=\"checkbox\" id=\"computer\" name=\"computer\" value=\"computer\""; if ($computer){echo "checked";} echo ">
	<label for=\"computer\">computer</label><br>
	<input type=\"checkbox\" id=\"tools\" name=\"tools\" value=\"tools\""; if ($tools){echo "checked";} echo ">
	<label for=\"tools\">tools</label><br>
	<input type=\"checkbox\" id=\"meditation\" name=\"meditation\" value=\"meditation\""; if ($meditation){echo "checked";} echo ">
	<label for=\"meditation\">meditation</label><br>
	<input type=\"checkbox\" id=\"battery\" name=\"battery\" value=\"battery\""; if ($battery){echo "checked";} echo ">
	<label for=\"battery\">battery</label><br>
	<input type=\"checkbox\" id=\"enhancement\" name=\"enhancement\" value=\"enhancement\""; if ($enhancement){echo "checked";} echo ">
	<label for=\"enhancement\">enhancement</label><br>
	<input type=\"checkbox\" id=\"healing\" name=\"healing\" value=\"healing\""; if ($healing){echo "checked";} echo ">
	<label for=\"healing\">healing</label><br>
	<input type=\"checkbox\" id=\"art\" name=\"art\" value=\"art\""; if ($art){echo "checked";} echo ">
	<label for=\"art\">art</label><br>";	
	
	//downsides
	$sandownsides = $sanctuary['downsides'];

	echo "But comes with some downsides: <br>";
	
	$access  = $sandownsides['access'];
	$attention  = $sandownsides['attention'];  
	$location    = $sandownsides['location'];
	$sandamaged    = $sandownsides['damaged'];
	$tied    = $sandownsides['tied'];

echo "
	<p>Your Downsides:</p>
	<input type=\"checkbox\" id=\"access\" name=\"access\" value=\"access\""; if ($access){echo "checked";} echo ">
	<label for=\"access\">access</label><br>
	<input type=\"checkbox\" id=\"attention\" name=\"attention\" value=\"attention\""; if ($attention){echo "checked";} echo ">
	<label for=\"attention\">attention</label><br>
	<input type=\"checkbox\" id=\"location\" name=\"location\" value=\"location\""; if ($location){echo "checked";} echo ">
	<label for=\"location\">location</label><br>
	<input type=\"checkbox\" id=\"sandamaged\" name=\"sandamaged\" value=\"sandamaged\""; if ($sandamaged){echo "checked";} echo ">
	<label for=\"sandamaged\">sandamaged</label><br>
	<input type=\"checkbox\" id=\"tied\" name=\"tied\" value=\"tied\""; if ($tied){echo "checked";} echo ">
	<label for=\"tied\">tied</label><br>";
	
	echo "To use it, the GM will assign you between 1 and 4 of these conditions each time: <br>";

	echo "❑ First, you must _______________________<br>
❑ You’ll need help from ___________________<br>
❑ You and your team will risk danger from ______<br>
❑ The best you can do is a lesser version, unreliable and limited<br>
❑ You’ll need to mark one box on your doom track<br>
❑ You’ll have to obtain ___________________<br>";
}

// Would be great to have a nemesis box

// Harbingers memories

$hasmemories = false;
if (array_key_exists ( 'memories' , $decodechar)){
	$hasmemories = true;
	echo "<h2>You have memories of the future!</h2>";
}

if ($hasmemories){
	$memories =  $decodechar['roles'];
	
	$monster  = $memories['monster'];
	$traitor  = $memories['traitor'];  
	$corruptor    = $memories['corruptor'];
	$martyr    = $memories['martyr'];
	$builder    = $memories['builder'];
	$leader    = $memories['leader'];

echo "
	<p>Your Memories:</p>
	Your memories score is " . $decodechar['memories'] . " and will increase as you fill in the memories below to a maximum of 3.<br>
	<input type=\"text\" id=\"monster\" name=\"monster\" content=\""; echo $monster; echo "\"> was the monster.<br>
	<input type=\"text\" id=\"traitor\" name=\"traitor\" content=\""; echo $traitor; echo "\"> was the traitor.<br>
	<input type=\"text\" id=\"corruptor\" name=\"corruptor\" content=\""; echo $corruptor; echo "\"> was the corruptor.<br>
	<input type=\"text\" id=\"martyr\" name=\"martyr\" content=\""; echo $martyr; echo "\"> was the martyr.<br>
	<input type=\"text\" id=\"builder\" name=\"builder\" content=\""; echo $builder; echo "\"> was the builder.<br>
	<input type=\"text\" id=\"leader\" name=\"leader\" content=\""; echo $leader; echo "\"> was the leader.<br> ";
}

// Innocent!

$hasfuturelife = false;
if (array_key_exists ( 'futureSelfInfo' , $decodechar)){
	$hasfuturelife = true;
	echo "<h2>You have an evil future self to defeat!</h2>";
}

if ($hasfuturelife){
	$selfinfo =  $decodechar['futureSelfInfo'];

	$lost  = $selfinfo['lost'];
	$failed  = $selfinfo['failed'];  
	$crime    = $selfinfo['crime'];
	$betray    = $selfinfo['betray'];
	$cost    = $selfinfo['cost'];
	$kill  = $selfinfo['kill'];
	$battled  = $selfinfo['battled'];  
	$innocent    = $selfinfo['innocent'];

echo "
	<p>These experiences turned to away from being a hero, you have experienced:</p>
	<input type=\"checkbox\" id=\"lost\" name=\"lost\" value=\"lost\""; if ($lost){echo "checked";} echo ">
	<label for=\"lost\">lost</label><br>
	<input type=\"checkbox\" id=\"failed\" name=\"failed\" value=\"failed\""; if ($failed){echo "checked";} echo ">
	<label for=\"failed\">failed</label><br>
	<input type=\"checkbox\" id=\"crime\" name=\"crime\" value=\"crime\""; if ($crime){echo "checked";} echo ">
	<label for=\"crime\">crime</label><br>
	<input type=\"checkbox\" id=\"betray\" name=\"betray\" value=\"betray\""; if ($betray){echo "checked";} echo ">
	<label for=\"betray\">betray</label><br>
	<input type=\"checkbox\" id=\"cost\" name=\"cost\" value=\"cost\"\""; if ($cost){echo "checked";} echo ">
	<label for=\"cost\">cost</label><br>
	<input type=\"checkbox\" id=\"kill\" name=\"kill\" value=\"kill\""; if ($kill){echo "checked";} echo ">
	<label for=\"kill\">kill</label><br>
	<input type=\"checkbox\" id=\"battled\" name=\"battled\" value=\"battled\""; if ($battled){echo "checked";} echo ">
	<label for=\"battled\">battled</label><br>
	<input type=\"checkbox\" id=\"innocent\" name=\"innocent\" value=\"innocent\""; if ($innocent){echo "checked";} echo ">
	<label for=\"innocent\">innocent</label><br>";
}

// Janus sheet has so much going on too, passing most of it up until I can see about changes

$hassecretid = false;
if (array_key_exists ( 'maskLabel' , $decodechar)){
	$hassecretid = true;
	echo "<h2>You have a secret identity and lead a double life!</h2>";
}

if ($hassecretid){
	echo "Your masks label is " . $decodechar['maskLabel'] . ".";
}

// Joined has no support for their extra currently




// Legacy Stuff

$haslegacy = false;
if (array_key_exists ( 'legacy' , $decodechar)){
	$haslegacy = true;
	echo "<h2>You strive to uphold a heroic legacy!</h2>";
}

if ($haslegacy){
	$legacyinfo = $decodechar['legacy'];
	
	$active  = $legacyinfo['active'];
	$retired  = $legacyinfo['retired'];  
	$possible    = $legacyinfo['possible'];
	$opponent    = $legacyinfo['opponent'];

echo "
	<p>Your Legacy contains:</p>
	<input type=\"text\" id=\"active\" name=\"active\" content=\""; echo $active; echo "\"> is still active and prominent in the city.<br>
	<input type=\"text\" id=\"retired\" name=\"retired\" content=\""; echo $retired; echo "\"> is retired and quite judgmental.<br>
	<input type=\"text\" id=\"possible\" name=\"possible\" content=\""; echo $possible; echo "\"> is the next possible member of your legacy.<br>
	<input type=\"text\" id=\"opponent\" name=\"opponent\" content=\""; echo $opponent; echo "\"> is the greatest opponent your legacy ever faced...and is still at large.<br>";
}


// Newborn Lessons

$haslessons = false;
if (array_key_exists ( 'lessons' , $decodechar)){
	$haslessons = true;
	echo "<h2>You are learning lessons about heroes, and the world!</h2>";
}

if ($haslessons){
	$lessoninfo = $decodechar['lessons'];
	
	$iam  = $lessoninfo['iam'];
	$should  = $lessoninfo['should'];  
	$always    = $lessoninfo['always'];
	$never    = $lessoninfo['never'];

echo "
	<p>Your Lessons are:</p>
	I am ...<input type=\"text\" id=\"iam\" name=\"iam\" content=\""; echo $iam; echo "\"><br>
	A superhero should ...<input type=\"text\" id=\"should\" name=\"should\" content=\""; echo $should; echo "\"><br>
	Always... <input type=\"text\" id=\"always\" name=\"always\" content=\""; echo $always; echo "\"><br>
	Never ...<input type=\"text\" id=\"never\" name=\"never\" content=\""; echo $never; echo "\"><br>";
}

// Nomad is nice and simple
$hasinfluenceGiven = false;
if (array_key_exists ( 'influenceGiven' , $decodechar)){
	$hasinfluenceGiven = true;
	echo "<h2>You are trying to make connections, but reaching out to others is hard...</h2>";
}

if ($hasinfluenceGiven){
	echo "<br>You have given out <input type=\"number\" id=\"infgiven\" name=\"infgiven\" min=\"0\" max=\"4\" value="; 
	echo $decodechar['influenceGiven'];
	echo "\">. You can only give out influence by revelaing a vulnerability.<br>";
	
	echo "Your influence currently grants you:<br>
		❑
1-2 Influence: When you defend someone who has Influence over you, you can ignore the Insecure condition.<br>
When you directly engage someone who has Influence over you, you can ignore the Afraid condition.<br>
3 Influence: When you take a powerful blow from someone with Influence over you, take -2 to the roll.<br>
4 Influence: When you pierce the mask of someone who has Influence over you, you can always ask them one question, even on a miss.<br>
5 Influence: When you spend a Team to help someone who has Influence over you, it gives them +2.<br><br>
In future, you may gain: <br>
6 Influence: When you accept the words of someone who has Influence over you, mark potential, clear a condition, or take +1 forward.<br>";
}

// Nothing in the Outsider JSON

// Having a Mentor is hard, Proteges know all about it
$hasmentor = false;
if (array_key_exists ( 'mentor' , $decodechar)){
	$hasmentor = true;
	echo "<h2>You have a mentor, who is training you to be a hero</h2>";
}

if ($hasmentor){
	$mendetails = $decodechar['mentor'];
	echo 	"Your mentor embodies the label <input type=\"text\" id=\"embodies\" name=\"embodies\" content=\""; echo $mendetails['embodies']; echo "\">.<br>
	Your mentor denies <input type=\"text\" id=\"denies\" name=\"denies\" content=\""; echo $mendetails['denies']; echo "\">.<br><br>
	They have also provided you with a base of operations, which includes:<br>";
	
	$menresources = $mendetails['resources'];
	
	$base  = $sanfeatures['base'];
	$vehicle  = $sanfeatures['vehicle'];  
	$supercomputer    = $sanfeatures['supercomputer'];
	$communicators    = $sanfeatures['communicators'];
	$surveillance    = $sanfeatures['surveillance'];
	$identities    = $sanfeatures['identities'];
	$badges    = $sanfeatures['badges'];
	$chem    = $sanfeatures['chem'];
	$med    = $sanfeatures['med'];
	$proteleportal   = $sanfeatures['teleportal'];
	$weapon    = $sanfeatures['weapon'];
	$security    = $sanfeatures['security'];
	$robots    = $sanfeatures['robots'];

echo "
	<p>Your Base has the following features:</p>
	<input type=\"checkbox\" id=\"base\" name=\"base\" value=\"base\""; if ($base){echo "checked";} echo ">
	<label for=\"base\">base</label><br>
	<input type=\"checkbox\" id=\"vehicle\" name=\"vehicle\" value=\"vehicle\""; if ($vehicle){echo "checked";} echo ">
	<label for=\"vehicle\">vehicle</label><br>
	<input type=\"checkbox\" id=\"supercomputer\" name=\"supercomputer\" value=\"supercomputer\""; if ($supercomputer){echo "checked";} echo ">
	<label for=\"supercomputer\">supercomputer</label><br>
	<input type=\"checkbox\" id=\"communicators\" name=\"communicators\" value=\"communicators\""; if ($communicators){echo "checked";} echo ">
	<label for=\"communicators\">communicators</label><br>
	<input type=\"checkbox\" id=\"surveillance\" name=\"surveillance\" value=\"surveillance\""; if ($surveillance){echo "checked";} echo ">
	<label for=\"surveillance\">surveillance</label><br>
	<input type=\"checkbox\" id=\"identities\" name=\"identities\" value=\"identities\""; if ($identities){echo "checked";} echo ">
	<label for=\"identities\">identities</label><br>
	<input type=\"checkbox\" id=\"badges\" name=\"badges\" value=\"badges\""; if ($badges){echo "checked";} echo ">
	<label for=\"badges\">badges</label><br>
	<input type=\"checkbox\" id=\"chem\" name=\"chem\" value=\"chem\""; if ($chem){echo "checked";} echo ">
	<label for=\"chem\">chem</label><br>
	<input type=\"checkbox\" id=\"med\" name=\"med\" value=\"med\""; if ($med){echo "checked";} echo ">
	<label for=\"med\">med</label><br>
	<input type=\"checkbox\" id=\"proteleportal\" name=\"proteleportal\" value=\"proteleportal\""; if ($proteleportal){echo "checked";} echo ">
	<label for=\"proteleportal\">proteleportal</label><br>
	<input type=\"checkbox\" id=\"weapon\" name=\"weapon\" value=\"weapon\""; if ($weapon){echo "checked";} echo ">
	<label for=\"weapon\">weapon</label><br>
	<input type=\"checkbox\" id=\"security\" name=\"security\" value=\"security\""; if ($security){echo "checked";} echo ">
	<label for=\"security\">security</label><br>
	<input type=\"checkbox\" id=\"robots\" name=\"robots\" value=\"robots\""; if ($robots){echo "checked";} echo ">
	<label for=\"robots\">robots</label><br>";
	
}

// Reformeds Friends in Low Places, obligations and favours
$hasfilp = false;
if (array_key_exists ( 'friends' , $decodechar)){
	$hasfilp = true;
	echo "<h2>You have ties to villains to whom you owe favours...</h2>";
}

if ($hasfilp){
	$filp = $decodechar['friends'];
	$friendcount = 0;
	foreach ($filp as $lowfriend){
		//print_r ($oneadvance); 
		echo "
		<p>Your 'friends' are:</p>
		<input type=\"text\" id=\"friend" . $friendcount . "\" name=\"friend" . $friendcount . "\" content=\"" . $lowfriend['name'] . "\"> 
		who specialises in <input type=\"text\" id=\"fspec" . $friendcount . "\" name=\"fspec" . $friendcount . "\" content=\"" . $lowfriend['speciality'] . "\"> 
		and your obligation to them is <input type=\"foblig" . $friendcount . "\" id=\"foblig" . $friendcount . "\" name=\"foblig" . $friendcount . "\" min=\"0\" max=\"4\" value=\"" . $lowfriend['obligation'] . "\">.<br>";
		$friendcount++;
	}
	
}

// Scions respect mechanics
$hasrespect = false;
if (array_key_exists ( 'enemy' , $decodechar)){ //I'm just checking for one, because each of the respect targets is its own base level entry, not collapsed in to a subsection
	$hasrespect = true;
	echo "<h2>You are working to earn respect from heroes, in defiance of your parent</h2>";
}

if ($hasrespect){
	echo "<p>You are seeking the respect of:</p>";
	
	echo "Your parents greatest enemy: <input type=\"text\" id=\"genemy\" name=\"genemy\" content=\"" . ($decodechar['enemy'])['name'] . "\"> 
	whose respect you have earned <input type=\"genemyrespect\" id=\"genemyrespect\" name=\"genemyrespect\" min=\"0\" max=\"4\" value=\"" . ($decodechar['enemy'])['respect'] . "\"><br>
	<input type=\"checkbox\" id=\"genemyadvance\" name=\"genemyadvance\" value=\"genemyadvance\""; if (($decodechar['enemy'])['advancement']){echo "checked";} echo ">
	<label for=\"genemyadvance\">Advancement Earned</label><br>";
	
	echo "The citys greatest leader: <input type=\"text\" id=\"gleader\" name=\"gleader\" content=\"" . ($decodechar['leader'])['name'] . "\"> 
	whose respect you have earned <input type=\"gleaderrespect\" id=\"gleaderrespect\" name=\"gleaderrespect\" min=\"0\" max=\"4\" value=\"" . ($decodechar['leader'])['respect'] . "\"><br>
	<input type=\"checkbox\" id=\"gleaderadvance\" name=\"gleaderadvance\" value=\"gleaderadvance\""; if (($decodechar['leader'])['advancement']){echo "checked";} echo ">
	<label for=\"gleaderadvance\">Advancement Earned</label><br>";
	
	echo "Your parents greatest victim: <input type=\"text\" id=\"gvictim\" name=\"gvictim\" content=\"" . ($decodechar['victim'])['name'] . "\"> 
	whose respect you have earned <input type=\"gvictimrespect\" id=\"gvictimrespect\" name=\"gvictimrespect\" min=\"0\" max=\"4\" value=\"" . ($decodechar['victim'])['respect'] . "\"><br>
	<input type=\"checkbox\" id=\"gvictimadvance\" name=\"gvictimadvance\" value=\"gvictimadvance\""; if (($decodechar['victim'])['advancement']){echo "checked";} echo ">
	<label for=\"gvictimadvance\">Advancement Earned</label><br>";
	
	echo "The city's greatest hero: <input type=\"text\" id=\"ghero\" name=\"ghero\" content=\"" . ($decodechar['hero'])['name'] . "\"> 
	whose respect you have earned <input type=\"gherorespect\" id=\"gherorespect\" name=\"gherorespect\" min=\"0\" max=\"4\" value=\"" . ($decodechar['hero'])['respect'] . "\"><br>
	<input type=\"checkbox\" id=\"gheroadvance\" name=\"gheroadvance\" value=\"gheroadvance\""; if (($decodechar['hero'])['advancement']){echo "checked";} echo ">
	<label for=\"gheroadvance\">Advancement Earned</label><br>";
	
	echo "Your personal idol: <input type=\"text\" id=\"pidol\" name=\"pidol\" content=\"" . ($decodechar['idol'])['name'] . "\"> 
	whose respect you have earned <input type=\"pidolrespect\" id=\"pidolrespect\" name=\"pidolrespect\" min=\"0\" max=\"4\" value=\"" . ($decodechar['idol'])['respect'] . "\"><br>
	<input type=\"checkbox\" id=\"pidoladvance\" name=\"pidoladvance\" value=\"pidoladvance\""; if (($decodechar['idol'])['advancement']){echo "checked";} echo ">
	<label for=\"pidoladvance\">Advancement Earned</label><br>";
	
	echo "The city's biggest celebrity: <input type=\"text\" id=\"bceleb\" name=\"bceleb\" content=\"" . ($decodechar['celebrity'])['name'] . "\"> 
	whose respect you have earned <input type=\"bcelebrespect\" id=\"bcelebrespect\" name=\"bcelebrespect\" min=\"0\" max=\"4\" value=\"" . ($decodechar['celebrity'])['respect'] . "\"><br>
	<input type=\"checkbox\" id=\"bcelebadvance\" name=\"bcelebadvance\" value=\"bcelebadvance\""; if (($decodechar['celebrity'])['advancement']){echo "checked";} echo ">
	<label for=\"bcelebadvance\">Advancement Earned</label><br>";
}

// Star's audience!
$hasaudience = false;
if (array_key_exists ( 'audience' , $decodechar)){
	$hasaudience = true;
	echo "<h2>You have an audience following you, and you need to keep them happy!</h2>";
}

if ($hasaudience){
	$audience =  ($decodechar['audience'])['loves'];

	$alike  = $audience['alike'];
	$dangerous  = $audience['dangerous'];  
	$noble    = $audience['noble'];
	$beautiful    = $audience['beautiful'];
	$charming    = $audience['charming'];
	$firebrand  = $audience['firebrand'];


echo "
	<p>Your Audience loves you because:</p>
	<input type=\"checkbox\" id=\"alike\" name=\"alike\" value=\"alike\""; if ($alike){echo "checked";} echo ">
	<label for=\"alike\">You are just like them</label><br>
	<input type=\"checkbox\" id=\"dangerous\" name=\"dangerous\" value=\"dangerous\""; if ($dangerous){echo "checked";} echo ">
	<label for=\"dangerous\">You’re a dangerous person, a bad seed</label><br>
	<input type=\"checkbox\" id=\"noble\" name=\"noble\" value=\"noble\""; if ($noble){echo "checked";} echo ">
	<label for=\"noble\">You’re noble warrior for justice </label><br>
	<input type=\"checkbox\" id=\"beautiful\" name=\"beautiful\" value=\"beautiful\""; if ($beautiful){echo "checked";} echo ">
	<label for=\"beautiful\">You’re stunning, unique, and beautiful</label><br>
	<input type=\"checkbox\" id=\"charming\" name=\"charming\" value=\"charming\"\""; if ($charming){echo "checked";} echo ">
	<label for=\"charming\">You’re charming, well-spoken, and smart </label><br>
	<input type=\"checkbox\" id=\"firebrand\" name=\"firebrand\" value=\"firebrand\""; if ($firebrand){echo "checked";} echo ">
	<label for=\"firebrand\">You’re a firebrand, a rabble rouser</label><br>";	
	
	// audience advantages
	
	$audienceadv =  ($decodechar['audience'])['advantages'];

	$devoted  = $audienceadv['devoted'];
	$speak  = $audienceadv['speak'];  
	$agent    = $audienceadv['agent'];
	$money    = $audienceadv['money'];
	$endorsement    = $audienceadv['endorsement'];
	$wider  = $audienceadv['wider'];


echo "
	<p>Your Audience has some advantages:</p>
	<input type=\"checkbox\" id=\"devoted\" name=\"devoted\" value=\"devoted\""; if ($devoted){echo "checked";} echo ">
	<label for=\"devoted\">Your audience is utterly devoted to you</label><br>
	<input type=\"checkbox\" id=\"speak\" name=\"speak\" value=\"speak\""; if ($speak){echo "checked";} echo ">
	<label for=\"speak\">You can easily speak to them at any time</label><br>
	<input type=\"checkbox\" id=\"agent\" name=\"agent\" value=\"agent\""; if ($agent){echo "checked";} echo ">
	<label for=\"agent\">You have a PR agent to handle your audience</label><br>
	<input type=\"checkbox\" id=\"money\" name=\"money\" value=\"money\""; if ($money){echo "checked";} echo ">
	<label for=\"money\">You earn a lot of money from their interest</label><br>
	<input type=\"checkbox\" id=\"endorsement\" name=\"endorsement\" value=\"endorsement\"\""; if ($endorsement){echo "checked";} echo ">
	<label for=\"endorsement\">You have a major hero’s endorsement</label><br>
	<input type=\"checkbox\" id=\"wider\" name=\"wider\" value=\"wider\""; if ($wider){echo "checked";} echo ">
	<label for=\"wider\">You have a much wider audience</label><br>";		
	
	// audience demands
	
	$audiencedem =  ($decodechar['audience'])['demands'];

	$stimulation  = $audiencedem['stimulation'];
	$perfection  = $audiencedem['perfection'];  
	$drama    = $audiencedem['drama'];
	$heroism    = $audiencedem['heroism'];
	$novelty    = $audiencedem['novelty'];
	$chemistry  = $audiencedem['chemistry'];


echo "
	<p>Your Audience has some advantages:</p>
	<input type=\"checkbox\" id=\"stimulation\" name=\"stimulation\" value=\"stimulation\""; if ($stimulation){echo "checked";} echo ">
	<label for=\"stimulation\">They require constant stimulation</label><br>
	<input type=\"checkbox\" id=\"perfection\" name=\"perfection\" value=\"perfection\""; if ($perfection){echo "checked";} echo ">
	<label for=\"perfection\">They require perfection—no mistakes</label><br>
	<input type=\"checkbox\" id=\"drama\" name=\"drama\" value=\"drama\""; if ($drama){echo "checked";} echo ">
	<label for=\"drama\">They require frequent bouts of drama</label><br>
	<input type=\"checkbox\" id=\"heroism\" name=\"heroism\" value=\"heroism\""; if ($heroism){echo "checked";} echo ">
	<label for=\"heroism\">They require major acts of heroism</label><br>
	<input type=\"checkbox\" id=\"novelty\" name=\"novelty\" value=\"novelty\"\""; if ($novelty){echo "checked";} echo ">
	<label for=\"novelty\">They require novelty and brand new action</label><br>
	<input type=\"checkbox\" id=\"chemistry\" name=\"chemistry\" value=\"chemistry\""; if ($chemistry){echo "checked";} echo ">
	<label for=\"chemistry\">They require chemistry with your allies</label><br>";	
	
}

echo "</form>";
echo "<a href=\"http://localhost/webmaddie/\">Start Again</a></p>";