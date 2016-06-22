<?php

$servername = "localhost";
$username = "hypcim";
$password = "passwordftp";
$dbname = "my_hypcim";
$mysql = mysql_connect($servername, $username, $password) or die("Errore: Impossibile connettersi al database MYSQL - Verificare i dati di connessione");
mb_internal_encoding('UTF-8');
mysql_select_db($dbname,$mysql);

?>

