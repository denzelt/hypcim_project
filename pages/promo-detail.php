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
$query = "SELECT * FROM devices d,promo p WHERE p.device_id = d.id AND p.id = ".$id;
// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
while($row = mysql_fetch_array($result)){
 ?>
 <h2>Device » Promotion » <?=$row['nome']?></h2>

<div style="text-align:center; padding:3px; width:50%; float:right;">

<div style="font-size:20px; margin:auto;display:block; text-align:left; padding:10px;"><b> Promotion Details </b> <br /> 
<p><?=utf8_encode($row['details'])?></p>
<hr width="80%" />
<center>
<span style="font-size:40px;">Promotion Price: <b><br /><?=$row['new_price']?> €/month</b></span>
<hr width="80%" />
<a href="index.php?s=show&id=<?=$row['device_id']?>"><span id="showmore" class="button" style="cursor:pointer;">See Device Page</span></a>
<a href="#" onclick="javascript:alert('Function Disabled');"><span id="showmore" class="button" style="cursor:pointer;">BUY NOW</span></a>
</center>
<h2> HelpDesk </h2>
<p><a href="#"><span id="help" class="button" style="cursor:pointer;">Question & Answers</span></a>
<a href="#" onclick="javascript:alert('Function Disabled');"><span id="help" class="button" style="cursor:pointer;">Chat with operator</span></a>
<a href="#"><span id="help" class="button" style="cursor:pointer;">Contact us</span></a>
</p>
</div>

</div>

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

<div style="text-align:center; margin:3px; margin: auto;  float:right;">
<?php
$colori =  preg_split("/[\s,]+/", $row['colore']);
for($i=0;$i<count($colori); $i++){
	echo '<div style=" width:40px; height:40px; border-radius:40px;margin: 3px; float:left; background-color:'.$colori[$i].'"></div>';

}
?>
</div>

</div>




<?php
	}
?>
<div style='clear:both; padding:3px;'></div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
// Attiva lo slider
$('.bxslider').bxSlider( {mode: 'horizontal'});
// Abilito il Sottomenu rendendolo visibile
$( "#submain" ).css( "display", "block" );
// Aggiungo i link dinamicamente
$( "#submenu" ).append("<li><a href='index.php?s=device'>All</a></li>");
$( "#submenu" ).append('<li><a href="index.php?s=device-cat">By Category</a></li>');
$( "#submenu" ).append('<li><a href="index.php?s=promo">Promotion</a></li>');
});

</script>