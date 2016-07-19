<div style="margin:auto; width:850px;">
<!-- jQuery library (served from Google) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="/css/jquery.bxslider.css" rel="stylesheet" />

<?php
  // Connetto il DB
  require('lib/connect_db.php');
  $id = abs($_GET['id']);
  // Preparo la Query per mostrare tutti i device caricati nella tabella del database
  $query = "SELECT * FROM devices WHERE id = $id";
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
  <h1><?=$row['nome']?></h1>
      <div style="float:right; width:50%;">
            <span style=" font-size:20px; " ><b> Description </b> </span> <br />
            <p style="display:block;">
              <?=utf8_encode($row['features'])?>
           </p>
        <br />
            <span  style="font-size:20px;">
               <b> What's in the box: </b> 
            </span> 
        <br />
            <p>
              <?=utf8_encode($row['box'])?>
           </p>
            <p>
              <h1>Trouble? Check out Help Desk:</h1> 
                <a href="index.php?s=assistance"><span id="help" class="button" style="cursor:pointer;">Assistance Device</span></a>
                <a href="#" onclick="javascript:alert('Disabled Function');"><span id="help" class="button" style="cursor:pointer;">Chat with Operator</span></a>
                <a href="index.php?s=contact"><span id="help" class="button" style="cursor:pointer;">Contact us</span></a>
            </p>
            <p>
              <h1>Payment</h1>
                <center>
                    <a href="#" onclick="javascript:alert('Function Disabled');"><span id="showmore" class="button" style="cursor:pointer;width:100%; text-align:center;">BUY NOW</span></a><br />
                    <img src="img/ebs-logos.png" height="40px" width="300px" />
                </center>
            </p>
        </div>
  
  <div class="device-show">
      <ul class="bxslider">
         <li> <img src="<?=$row['img_1']?>" class="fitimage" /> </li>
  <?php
       if($row['img_2'] != NULL){  echo " <li>	<img src='".$row['img_2']."' />	 </li>"; }
	     if($row['img_3'] != NULL){  echo " <li>	<img src='".$row['img_3']."' />	 </li>"; }
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
  
  <div style="text-align:center; padding:3px; font-size:40px; width:50%; float:left;">
      <b><?=$row['prezzo']?> €</b>
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
$('.bxslider').bxSlider( {mode: 'horizontal',  auto: true});
// Abilito il Sottomenu rendendolo visibile
$( "#submain" ).css( "display", "block" );
// Aggiungo i link dinamicamente
$( "#submenu" ).append("<li><a href='index.php?s=device'>All</a></li>");
$( "#submenu" ).append('<li><a href="index.php?s=device-cat">By Category</a></li>');
$( "#submenu" ).append('<li><a href="index.php?s=promo">Promotion</a></li>');
});

</script>