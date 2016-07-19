<div style="margin:auto; width:850px;">
<h2>Device » Promotion by Category </h2>
<p>In this page you can find all the promos relate to our device. Check out our Mobile and Home offers and don't miss our Entertainment offers!</p>
       <center>
        <a href="#" onclick="javascript:history.back();"><span id="showmore quickbutton" class="button">« Back</span></a>
        <a href="index.php?s=device-cat&cat=Smartphone"><span id="showmore quickbutton" class="button">Go To Smartphone Device</span></a>
        <a href="index.php?s=device-cat&cat=Tablet"><span id="showmore quickbutton" class="button">Go To Tablet Device</span></a>
        <a href="index.php?s=device-cat&cat=Network"><span id="showmore quickbutton" class="button"> Go To Network Device</span></a>
        <a href="index.php?s=device-cat&cat=Smart%20Living"><span id="showmore quickbutton" class="button">Go To Smart Living Device</span></a>
        <a href="index.php?s=assistance"><span id="showmore quickbutton" class="button">Highlights</span></a>
        </center>
<?php
// Default Page
$cat = $_GET['cat'];
if (!isset($_GET['cat'])){
    $category = array(
    "0" => "Home",
    "1" => "Mobile+Home",
    "2" => "Mobile",
    "3" => "Entertainment",
    );
?>


<?php
// Connetto il DB
require('lib/connect_db.php');
    for($c= 0; $c<4; $c++){
        //Costruisco dinamicamente le ctegorie
        echo "  <div id='response'><h2>".$category[$c]."</h2>";
        $query = "SELECT * FROM devices d,promo p WHERE p.device_id = d.id AND p.cat_promo ='".$category[$c]."' ORDER BY p.id DESC LIMIT 3";
        // Eseguo la query per recuperare le informazioni dal database
        $result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
        // Metto fuori i risultati dall'array
        while($row = mysql_fetch_array($result)){
        $i++;
        ?>

        <div class="device-c">
       <a href="index.php?s=promo-detail&id=<?=$row['id']?>" style="color:#000;   text-decoration: none;">
       <h2 style="margin-top:-10px; font-size:16px;"><i class="fa fa-signal" aria-hidden="true"></i> <?=$row['nome']?></h2>
       <img src="<?=$row['img_1']?>" class="fitimage" />
       <br />
       <div style="text-align:center; padding:3px; font-size:20px;"><b><?=$row['new_price']?> € /month</b></div>
       <div style="text-align:left; padding:3px; font-size:20px;"><hr width='80%' style="color:#acacac;" /><ul><?=$row['details']?> </ul></div>
       <center><i class="fa fa-info-circle" aria-hidden="true"></i></center>
       </a>
       </div>
       <?php
     } // end while
   ?>
   </div>
   <div style='clear:left; padding:3px;'></div>
       <center><a href="index.php?s=promo&cat=<?=$category[$c]?>"><span id="showmore" class="button" style="cursor:pointer;">Show More</span></a></center>
       <div style='clear:left; padding:3px;'></div>
    <?php
    
  }//end While e del For
//End default page
    }else{
// Category PROMO Details
    ?>
    <h2><?=$cat?> </h2>
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
$query = "SELECT * FROM promo WHERE cat_promo ='".$cat."' ORDER BY id DESC ";
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Numero di risultati ottenuti
 $row_count = mysql_num_rows($result);
//numero di pagine necessarie da mostrare
$p = ceil($row_count/3);

$query = "SELECT * FROM devices d,promo p WHERE p.device_id = d.id AND p.cat_promo ='".$cat."' ORDER BY p.id DESC LIMIT 3 OFFSET ".$limit_r;
// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
while($row = mysql_fetch_array($result)){
$i++;

 ?>
<div id="response">
<div class="device-c">

<a href="index.php?s=show-promo&id=<?=$row['id']?>" style="color:#000;   text-decoration: none;">
<h2 style="margin-top:-10px; font-size:16px;"><i class="fa fa-tablet" aria-hidden="true"></i> <?=$row['nome']?></h2>
<img src="<?=$row['img_1']?>" class="fitimage" />
<br />
<div style="text-align:center; padding:3px; font-size:20px;"><b><?=$row['prezzo']?> €</b></div>
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
    echo "<a href ='index.php?s=promo&cat=".urlencode($cat)."&page=$ip' class='pagenumb-c'>$ip</a>";
    }else{
    echo "<a href ='index.php?s=promo&cat=".urlencode($cat)."&page=$ip' class='pagenumb'>$ip</a>";
    }

        }
echo "</center>";
}
?>
<div style='clear:both; padding:3px;'></div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
// Abilito il Sottomenu rendendolo visibile
$( "#submain" ).css( "display", "block" );
// Aggiungo i link dinamicamente
$( "#submenu" ).append("<li><a href='index.php?s=device'>All</a></li>");
$( "#submenu" ).append('<li><a href="index.php?s=device-cat">By Category</a></li>');
$( "#submenu" ).append('<li><a href="index.php?s=promo">Promotion</a></li>');

});

</script>