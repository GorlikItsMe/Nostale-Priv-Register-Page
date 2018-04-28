<?php
# CONFIG

$dbhostname = "localhost"; //MsSQl Server Addres
$db = array(
    "Database" => "opennos", // Database Name
    "Uid" => "sa", //Database User
    "PWD" => "password", // Database Password;
);

$downloadLink= "/yourlancher.exe";
$downloadName= "Download us Lancher";

$backLink= "http://radivtale.pl";

$title = 'RadivTale.pl - Register Page';


# functions 
# dont touch ;-)

$polaczenie = @new mysqli($mysql_host, $mysql_db_user, $mysql_db_password, $mysql_db_name);

if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	
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
        $zmienna = stripslashes($zmienna); // usuwamy slashe
		$zmienna = filter_var($zmienna, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
   // usuwamy spacje, tagi html oraz niebezpieczne znaki
    return htmlspecialchars(trim($zmienna));
}



?>