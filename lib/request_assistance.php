<?php
// Connetto il DB
require('../lib/connect_db.php');
$search = $_POST['search'];

// Preparo la Query per mostrare tutti i device caricati nella tabella del database
$query = "SELECT * FROM assistance WHERE title LIKE '%".$search."%' OR answer LIKE '%".$search."%' ORDER BY title LIMIT 20";
// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
if(mysql_num_rows($result) != 0){
while($row = mysql_fetch_array($result)){
$i++;
 ?>
<div id="result" onclick="if(document.getElementById('r_<?=$i?>') .style.display=='none') {document.getElementById('r_<?=$i?>') .style.display=''}else{document.getElementById('r_<?=$i?>') .style.display='none'}">Topic: <b>"<?=$row['title']?>"</b> </div>
<div id="r_<?=$i?>" style="display:none;"><h2><?=$row['title']?></h2>
<p><?=$row['answer']?></p></div>

 <?php
	}
}else{
	echo"<hr /><center style='margin-top:20px;'>No results</center>";

}
?>