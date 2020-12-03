<?php

require __DIR__ . '/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Common\Aws;
include './madfunctions.php';

session_start();



$provider = new \Wohali\OAuth2\Client\Provider\Discord([
    'clientId' => '',
    'clientSecret' => '',
    'redirectUri' => ''
]);

  if (isset($_COOKIE['maddiesave'])) {
	
	buildstart();
	echo "<p>Welcome back, your ID is " . $_COOKIE['maddiesave'] . "</p>";
	echo "<p><a href='./expcookie.php'>Click here to expire the cookie</a></p>";
	$discordid = $_COOKIE['maddiesave'];
	awsconnect($discordid);
	
} elseif (!isset($_GET['code'])) {

    // Get authorization code
	$options = [
    'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
    'scope' => ['identify', 'guilds'] // array or string
];

	$authUrl = $provider->getAuthorizationUrl($options);
   // $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    // header('Location: ' . $authUrl);
	buildstart();
	echo "
	<body>
	<h1>Welcome to Web M.A.D.D.I.E</h1>
	<p>
	<a href=" . $authUrl . "><img src=\"./resources/maddie.png\" alt=\"MADDIE Logo\" width=\"500\" height=\"500\"> <br>
	To get started, click here to log in using Discord</a></p>
	";

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');
	

} else {

    // Get an access token using the provided authorization code
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Show some token details
    /* echo '<h2>Token details:</h2>';
    echo 'Token: ' . $token->getToken() . "<br/>";
    echo 'Refresh token: ' . $token->getRefreshToken() . "<br/>";
    echo 'Expires: ' . $token->getExpires() . " - ";
    echo ($token->hasExpired() ? 'expired' : 'not expired') . "<br/>";
	*/

    // Look up the user's profile with the provided token
    try {

        $user = $provider->getResourceOwner($token);
		$userarray = $user->toArray();
		
		
		//save the ID in a cookie
		setcookie('maddiesave', $userarray["id"], time() + (86400 * 30) , "/");

		buildstart();
        echo '<body>
			<h1>Welcome to Web M.A.D.D.I.E</h1>
			<h2>Your details:</h2><p>';
        printf('Hello %s#%s!<br/><br/>', $user->getUsername(), $user->getDiscriminator());
        //var_export($user->toArray());
		
		echo "Your Discord User ID is " . $userarray["id"] . "<br>";
		$discordid = $userarray["id"];

/* This is broken code that was going to get a list of servers, but not currently needed
		$guildsgoto = getResourceOwnerDetailsUrl($token) . "/guilds";
		$guilds = $provider->getAuthenticatedRequest(
            'GET',
            $guildsgoto,
            $accessToken
        );
*/

//Do AWS stuff
awsconnect($discordid);

    } catch (Exception $e) {

        // Failed to get user details
        exit($e);

    }
}