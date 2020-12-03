<?PHP
//Expire the cookie for more testing
if (isset($_COOKIE['maddiesave'])) {
	unset($_COOKIE['maddiesave']); 
	setcookie('maddiesave', "", 1, "/");
	echo "<a href='./'>Click here to return to MADDIE</a>";
}
?>