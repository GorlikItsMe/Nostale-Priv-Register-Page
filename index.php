<?php
require_once 'include.php';
echo '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="img/icon.png" type="image/x-icon" />

<script src="./js/jquery.min.js"></script>
<script src="./js/script.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">

<title>'.$title.'</title>
</head>
';

if(!isset($_GET['user'])){$user='None';}else{$user=$_GET['user'];}
if(isset($_GET['reg'])){
	if($_GET['reg']=="sucess"){
		echo '<div id="container">
			<img src="img/logo.png" width="100%">
			<center>
			<div><h1>Registered</h1></div>
			<div>Username: <b>'.$user.'</b></div>
			<div>Download Lancher: <a id="link" href="'.$downloadLink.'">'.$downloadName.'</a></div>
			<br>
			<div><a id="link" href="'.$backLink.'">Back</a> &nbsp;|&nbsp; <a id="link" href="login.php">Login</a></div>
			</center>
		</div>
		';
	
	exit();
	}
}

//SITE BUILD

function hasError($error)
{
	die('<body><div id="tos-container"><div><h1>Register...</h1></div><div>'.$error.'</div>
	<div><a id="link" href="index.php">Back</a></div>
	</div></body>');
}

if (isset($_POST['reg']))
{
	
$iserror = false;
$descerror = '';
if (! isset($_POST['username'])) {hasError("Username Isn't Set!");}
if ($_POST['username'] !== filtruj($_POST['username'])){hasError("Username had blocked charakters!");}

if (! isset($_POST['pass1'])){ hasError("pass1 Isn't Set!");}
if ($_POST['pass1'] !== filtruj($_POST['pass1'])){ hasError("Pass1 had blocked charakters!");}

if (! isset($_POST['pass2'])){ hasError("pass2 Isn't Set!");}
if ($_POST['pass2'] !== filtruj($_POST['pass2'])){ hasError("Pass2 had blocked charakters!");}

if (! isset($_POST['email'])){ hasError("email Isn't Set!");}
if ($_POST['email'] !== filtruj($_POST['email'])){ hasError("Email had blocked charakters!");}

if ($_POST['pass1'] !== $_POST['pass2']){ hasError("Passwords are not the same");}
$ch=true;
if (strlen($_POST['pass1']) < 6){$ch=false;}
if (strlen($_POST['pass1']) >= 30){$ch=false;}
if ($ch==false){hasError("Passwords Must have minimum 6 charakters and max 30<br>");}

$ch=true;
if (strlen($_POST['username']) < 6){$ch=false;}
if (strlen($_POST['username']) >= 30){$ch=false;}
if ($ch==false){hasError("Username Must have minimum 6 charakters and max 30<br>");}

$ip = filtruj($_SERVER['REMOTE_ADDR']);



if ($iserror==true){echo 'Login Error<br>'.$descerror; exit();}


	if ($_POST['pass1'] !== $_POST['pass2']){ hasError('Passwords aren\'t the same!');}
	
	
	# username
	$username = $_POST['username'];
	$params = array($username);
	$opts = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = "SELECT Name FROM Account WHERE Name= ?";
	$results = sqlsrv_query($mssql, $sql, $params, $opts);
	$username_exist = sqlsrv_num_rows($results);           // $username_exist 1 - username not available
	
	if($username_exist == 1){die("Username NOT available!<br>");}
	else {echo "Username available<br>";}
	
	
	#email
	$Email =  strtolower(trim($_POST["email"])); 
	$Email = filter_var($Email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$Email = htmlspecialchars($Email, ENT_QUOTES);
	$params = array($Email);
	$opts = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = "SELECT Name FROM Account WHERE Email= ?";
	$results = sqlsrv_query($mssql, $sql, $params, $opts);
	$Email_exist = sqlsrv_num_rows($results);
	if($Email_exist == 1)
		die('Email not available! <br>');
	else{
		if (strpos($Email,'@')){echo ('Email Available');}
		else{die('This is not Email!');}
	}
	
	echo 'Rejestruje!';
	$pass = hash("sha512", $_POST['pass1']);


	
//$sql = "INSERT INTO Account (Name, Password, Authority, Email, RegistrationIP, VerificationToken) VALUES ( ?, ?, '0', ?, ?, 'yes')";
$sql = "INSERT INTO Account (Name, Password, Authority, Email, RegistrationIP, VerificationToken) VALUES ( ?, ?, '0', ?, ?, ?)";
$params = array($_POST['username'], $pass, $_POST['email'], $ip, "yes");

$result = sqlsrv_query($mssql, $sql, $params);
$user = $_POST['username'];
exit(header("Location: index.php?reg=sucess&user=$user"));


}
?>

<div id="container"><form method="POST" action="index.php"> 
	<img src="img/logo.png" width="100%">
	<div class="tooltip" class="tooltip"><input id="user" name="username" type="text" placeholder="Username" onfocus="this.placeholder=''" onblur="this.placeholder='Username'" >
		
		<span class="tooltip-right" id="user-result">Najlepszy RadivTale</span>
		
		<span class="tooltiptext">Username must be between 6 and 30 characters</span>
	</div>

	<div class="tooltip"><input id="mail" name="email" type="text" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'" >
		
		<span class="tooltip-right" id="mail-result">Najlepszy RadivTale</span>
		
		<span class="tooltiptext">Your email address. Please do not use yahoo!</span>
	</div> 
	&nbsp;
	<div class="tooltip"><input name="pass1" type="password" id="noremember" pattern=".{6,30}" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" >
		<span class="tooltiptext">Password must be between 6 and 30 characters. We recommand to use complexe password.</span>
	</div>
	<div class="tooltip"><input name="pass2" type="password" id="noremember" pattern=".{6,30}" placeholder="Repeat Password" onfocus="this.placeholder=''" onblur="this.placeholder='Repeat Password'" >
		<span class="tooltiptext">Repeat your Password</span>
	</div>
	
	<input type="submit" value="Register" name="reg"/>
    
</form></div>  

<script type="text/javascript" src="js/script.js"></script>

</body>
</html>