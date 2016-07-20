<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
// Connetto il DB
require('../../lib/connect_db.php');
$cat = $_GET['categoria'];
$page = abs($_GET['page']);
if ($page == 0 or $page == 1 ){
    $page = 1;
    $limit_r = 3;
}else{
    $limit_r = 3 * $page;
}
if($cat == ''){
	// Preparo la Query per mostrare tutti i device caricati nella tabella del database
	$query = "SELECT id, nome, prezzo, img_1 FROM devices ORDER BY prezzo DESC LIMIT 3,$limit_r";
}else{
	$query = "SELECT id, nome, prezzo, img_1 FROM devices WHERE categoria = '".$cat."' ORDER BY prezzo DESC LIMIT 3,".$limit_r;
}

// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
if(count($result) != 0){
while($row = mysql_fetch_array($result)){
$i++;
 $records[] = $row;
	}
echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';

}else{

 echo "<center>No device match this criteria.</center>";

}

?>