<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />
<style type="text/css">
  20px;
  }
</style>
<div style="margin:auto; width:850px; height:auto;">
<?php
	if(!isset($_GET['cat'])){
	$category = array(
    "0" => "Tv&Entertainment",
    "1" => "Health",
    "2" => "Home&Family",
    "3" => "Service",
    );

    if(isset($_GET['id'])){
    	// Connetto il DB
	require('lib/connect_db.php');
	$id = abs($_GET['id']);
	// Preparo la Query per mostrare tutti i device caricati nella tabella del database
	$query = "SELECT * FROM smartlife WHERE id = ".$id;
	// Eseguo la query per recuperare le informazioni dal database
	$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
	// Se non esiste
  if( mysql_num_rows($result) == 0) { include('pages/404.php'); exit();}
	// Metto fuori i risultati dall'array
	while($row = mysql_fetch_array($result)){

?>
	<div style="padding:5px;">
        <a href="#" onclick="javascript:history.back();"><span id="showmore quickbutton" class="button">« Back</span></a>
        
        <a href="index.php?s=assistance"><span id="showmore quickbutton" class="button" style="float:right;">Highlights</span></a>
     </div>
<h2><?=$row['title']?></h2>

<div style="text-align:center; padding:3px; width:50%; float:right;">
	<div style="font-size:20px; margin:auto;display:block; text-align:left; padding:10px;"><b> Service Details </b> <br /> 
	<p><?=html_entity_decode($row['description'])?></p>
		<hr width="80%" />
		<center>
		<?php
		 if($row['price']!= ''){
		?>
			<span style="font-size:40px;">Service Price: <b><br /><?=$row['price']?> €/month</b></span>
				<hr width="80%" />
				<a href="#" onclick="javascript:alert('Function Disabled');"><span id="showmore" class="button" style="cursor:pointer;">Activate NOW</span></a>
		<?php
		 	}
		?>
		<?php
			if($row['device-id'] != '-1'){echo'<a href="index.php?s=show&id='.$row['device-id'].'"><span id="showmore" class="button" style="cursor:pointer;">See Device Attached</span></a>';}
		?>
				
		</center>
	<h2> HelpDesk </h2>
		<p>
			<a href="index.php?s=assistance"><span id="help" class="button" style="cursor:pointer;">Question & Answers</span></a>
			<a href="#" onclick="javascript:alert('Function Disabled');"><span id="help" class="button" style="cursor:pointer;">Chat with operator</span></a>
			<a href="index.php?s=contactus"><span id="help" class="button" style="cursor:pointer;">Contact us</span></a>
		</p>
	</div>

</div>

<div class="device-show">
	<ul class="bxslider">
		<li><img src="<?=$row['img']?>" class="fitimage" /> </li>
	<?php
	$did = $row['device-id'];
	$query = "SELECT * FROM devices WHERE id =".$did;
	// Eseguo la query per recuperare le informazioni dal database
	$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
	// Metto fuori i risultati dall'array
	while($img = mysql_fetch_array($result)){
		if($img['img_1'] != NULL){
 			echo " <li>	<img src='".$img['img_1']."' class='fitimage' />	 </li>";
		}
	}
	?>;
	</ul>
</div>
<div style="clear:both; paddding:5px;"></div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
// Attiva lo slider
$('.bxslider').bxSlider( {mode: 'horizontal',   auto: true});
});

</script>
<?php
		}

    }else{
	
?>

<h2>Smart Life » By Category</h2>
		<center>
		<a href="#" onclick="javascript:history.back();"><span id="showmore quickbutton" class="button">« Back</span></a>
		<a href="index.php?s=device-cat&cat=Smartphone"><span id="showmore quickbutton" class="button">Go To Smartphone Device</span></a>
		<a href="index.php?s=device-cat&cat=Tablet"><span id="showmore quickbutton" class="button">Go To Tablet Device</span></a>
		<a href="index.php?s=device-cat&cat=Network"><span id="showmore quickbutton" class="button"> Go To Network Device</span></a>
		<a href="index.php?s=device-cat&cat=Smart%20Living"><span id="showmore quickbutton" class="button">Go To Smart Living Device</span></a>
		<a href="index.php?s=assistance"><span id="showmore quickbutton" class="button">Highlights</span></a>
		</center>
<div class="smartcat"><a href="index.php?s=smartlife&cat=<?=urlencode('Tv&Entertainment')?>"><img src="images/sl1.png" class="fitimage" /></a></div>
<div class="smartcat"><a href="index.php?s=smartlife&cat=Health"><img src="images/sl2.png" class="fitimage" /></a></div>
<div class="smartcat"><a href="index.php?s=smartlife&cat=<?=urlencode('Home&Family')?>"><img src="images/sl3.png" class="fitimage" /></a></div>
<div class="smartcat"><a href="index.php?s=smartlife&cat=Service"><img src="images/sl4.png" class="fitimage" /></a></div>
<div class="smartcat"></div>
</div>
<div style="clear:both; margin-bottom:10px;"> </div>
<?php
}
// End Default page
	}else{
	$cat = 	$_GET['cat'];

?>
<div style="padding:5px;">
        <a href="#" onclick="javascript:history.back();"><span id="showmore quickbutton" class="button">« Back</span></a>
        
        <a href="index.php?s=assistance"><span id="showmore quickbutton" class="button" style="float:right;">Highlights</span></a>
        </div>
<h2>Smart Life » By Category » <?=$cat?></h2>
<?php
// Connetto il DB
	require('lib/connect_db.php');
	$page = $_GET['page'];
	if ($page == 0 or $page == 1 ){
  		  	$page = 1;
   			 $limit_r = 0;
		}else{
		 $limit_r = 3 * ($page - 1);
	}

// Controllo gli elementi della tabella di una categoria per le operazioni preliminari
$query = "SELECT * FROM smartlife WHERE category ='".$cat."' ORDER BY id DESC ";
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Numero di risultati ottenuti
 $row_count = mysql_num_rows($result);
//numero di pagine necessarie da mostrare
$p = ceil($row_count/3);

$query = "SELECT * FROM smartlife WHERE category ='".$cat."' ORDER BY id DESC LIMIT 3 OFFSET ".$limit_r;
// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
while($row = mysql_fetch_array($result)){
$i++;
 ?>
<div id="response">
<div class="device-c">
<a href="index.php?s=smartlife&id=<?=$row['id']?>" style="color:#000;   text-decoration: none;">
<h2 style="margin-top:-10px; font-size:16px;"><i class="fa fa-pied-piper" aria-hidden="true"></i> <?=$row['title']?></h2>
<img src="<?=$row['img']?>" class="fitimage" />
<br />
<?php
 if($row['price']!= ''){
 	?>

<div style="text-align:center; padding:3px; font-size:20px;"><b><?=$row['price']?> €</b></div>
<?php
}
?>
<center><i class="fa fa-info-circle" aria-hidden="true"></i></center>
</a>
</div>

<?php
if($i%3 == 0){
 echo"<div style='clear:both; padding:3px;'></div>";
        }

    } 
     echo"<div style='clear:both; padding:3px;'></div>";
echo "<center>";
//  numerazione delle pagine
for($ip = 1; $ip <= $p; $ip++){
    if ($page == $ip)   {  
    echo "<a href ='index.php?s=smartlife&cat=$cat&page=$ip' class='pagenumb-c'>$ip</a>";
    }else{
    echo "<a href ='index.php?s=smartlife&cat=$cat&page=$ip' class='pagenumb'>$ip</a>";
    }


echo "</center>";
}
?>
</div>
<div style='clear:both; padding:10px;'></div>

</div>



<?php
	} //else
?>
<script type="text/javascript">
$( document ).ready(function() {
// Abilito il Sottomenu rendendolo visibile
$( "#submain" ).css( "display", "block" );
// Aggiungo i link dinamicamente
$( "#submenu" ).append('<li><a href="index.php?s=smartlife">By Category</a></li>');

});

</script>