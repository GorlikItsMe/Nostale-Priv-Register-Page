<?php
# CONFIG

$dbhostname = "127.0.0.1"; //MsSQl Server Addres
$db = array(
    "Database" => "opennos", // Database Name
    "Uid" => "sa", //Database User
    "PWD" => "password", // Database Password;
);

$downloadLink= "/yourlancher.exe";
$downloadName= "Download us Lancher";

$backLink= "https://mywebsite.xyz";

$title = 'MySerwer - Register Page';


# functions 
# dont touch ;-)

	
error_reporting(E_ALL);
ini_set('display_errors',1); 

$mssql = sqlsrv_connect($dbhostname, $db);
if(!$mssql)
die('Something went wrong while connecting to MSSQL');
if(empty($dbhostname))
die("<h1>Server its not configurate chceck config</h1>");


function filtruj($zmienna)
{
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna);
		$zmienna = filter_var($zmienna, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    return htmlspecialchars(trim($zmienna));
}



?>