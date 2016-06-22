<div style="margin:auto; text-aling:center; width:850px;">
<!-- jQuery library (served from Google) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />
<style type="text/css">
  .bx-wrapper .bx-pager {
    bottom: -95px;
  }
  
  .bx-wrapper .bx-pager a {
    border: solid #ccc 1px;
    display: block;
    margin: 0 5px;
    padding: 3px;
  }
  
  .bx-wrapper .bx-pager a:hover,
  .bx-wrapper .bx-pager a.active {
    border: solid #5280DD 1px;
  }
  
  .bx-wrapper {
    margin-bottom: 120px;
  }
</style>
<?php
// Connetto il DB
require('lib/connect_db.php');
$id = abs($_GET['id']);
// Preparo la Query per mostrare tutti i device caricati nella tabella del database
$query = "SELECT * FROM devices WHERE id = $id";
// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
while($row = mysql_fetch_array($result)){
 ?>
<h1><?=$row['nome']?></h1>
<p style="float:right; width:50%;">
<span  style=" font-size:20px;"" ><b> Descrizione </b> </span> <br />
<?=utf8_encode($row['features'])?>
<br /><br />
<span  style=" font-size:20px;"" ><b> Contenuto </b> </span> <br />
<?=utf8_encode($row['box'])?> </p>
<div class="device-show">
<ul class="bxslider">
 <li><img src="<?=$row['img_1']?>" class="fitimage" /> </li>
<?php

if($row['img_2'] != NULL){
 echo " <li>	<img src='".$row['img_2']."' />	 </li>";
	}
	if($row['img_3'] != NULL){
 echo " <li>	<img src='".$row['img_3']."' />	</li>";
	}
	
?>
	</ul>
	
<div style="text-align:center; margin:3px; margin: auto;  float:left;">
<?php
$colori =  preg_split("/[\s,]+/", $row['colore']);
for($i=0;$i<count($colori); $i++){
	echo '<div style=" width:40px; height:40px; border-radius:40px;margin: 3px; float:left; background-color:'.$colori[$i].'"></div>';

}
?>
</div>
<div style="text-align:center; padding:3px; font-size:40px; width:50%; float:left;"><b><?=$row['prezzo']?> €</b></div>
<div style="text-align:center; padding:3px; width:50%; float:right;"></div>

</div>
<?php
	}
?>
<div style='clear:left; padding:3px;'></div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
// Attiva lo slider
$('.bxslider').bxSlider( {mode: 'horizontal'});
// Abilito il Sottomenu rendendolo visibile
$( "#submain" ).css( "display", "block" );
// Aggiungo i link dinamicamente
$( "#submenu" ).append("<li><a href='index.php?s=device&show=all'>All</a></li>");
$( "#submenu" ).append('<li><a href="index.php?s=device&show=category">By Category</a></li>');
$( "#submenu" ).append('<li><a href="index.php?s=device&show=promotion">PROMOTION</a></li>');
});

</script>