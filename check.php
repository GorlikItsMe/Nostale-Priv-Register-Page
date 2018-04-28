<?php
require_once('include.php');
if(isset($_POST["user"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
		die();
	$username =  strtolower(trim($_POST["user"])); 
	$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$username = htmlspecialchars($username, ENT_QUOTES);
	$params = array($username);
	$opts = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = "SELECT Name FROM Account WHERE Name= ?";
	$results = sqlsrv_query($mssql, $sql, $params, $opts);
	$username_exist = sqlsrv_num_rows($results);
	if($username_exist == 1)
		die('<span style="color:#F44336;"><i class="fa fa-ban" aria-hidden="true"></i> Username not available! Try again.</span>');
	else
		die('<span style="color:#8BC34A;"><i class="fa fa-check" aria-hidden="true"></i> Available</span>');
}
if(isset($_POST["mail"]))
{
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
		die();
	$Email =  strtolower(trim($_POST["mail"])); 
	$Email = filter_var($Email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$Email = htmlspecialchars($Email, ENT_QUOTES);
	$params = array($Email);
	$opts = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$sql = "SELECT Name FROM Account WHERE Email= ?";
	$results = sqlsrv_query($mssql, $sql, $params, $opts);
	$Email_exist = sqlsrv_num_rows($results);
	if($Email_exist == 1)
		die('<span style="color:#F44336;"><i class="fa fa-ban" aria-hidden="true"></i> Email not available! Try again.</span>');
	else{
		if (strpos($Email,'@')){die('<span style="color:#8BC34A;"><i class="fa fa-check" aria-hidden="true"></i> Available</span>');}
		else{die('<span style="color:#F44336;"><i class="fa fa-ban" aria-hidden="true"></i> This is not Email!</span>');}
	}
}
?>
