<div style="margin:auto; text-aling:center; width:850px;">
<h2>Device » All Device</h2>
<p>Welcome in the Device page, here you can navigate throught our catalog. You can view all devices or you can choose a category. You can also check the Promotion page where there are always good deals!</p>
<form name="filters" method="get" action="index.php?s=device">
<h3>Quick Filters</h3> 
<p>Filters allow you to quickly view all device in one page defined by your search criteria.</p>
 <label><b>Max Price:</b> <span id="slidernumber">(0 - 1500)</span>€
    <input type="range" name="price" min="50" max="1500" step="10" id="price" style="display:block;">
  </label>
</form>
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

// Controllo gli elementi della ptabella per le operazioni preliminari
$query = "SELECT * FROM devices ORDER BY id DESC ";
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Numero di risultati ottenuti
$row_count = mysql_num_rows($result);
//numero di pagine necessarie da mostrare
$p = ceil($row_count/3);

// Preparo la Query per mostrare tutti i device caricati nella tabella del database
$query = "SELECT * FROM devices ORDER BY id DESC LIMIT 3 OFFSET ".$limit_r;
// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
while($row = mysql_fetch_array($result)){
$i++;
 ?>
<div id="response">
<div class="device-c">
<a href="index.php?s=show&id=<?=$row['id']?>" style="color:#000;   text-decoration: none;">
<h2 style="margin-top:-10px; font-size:16px;"><i class="fa fa-tablet" aria-hidden="true"></i> <?=$row['nome']?></h2>
<img src="<?=$row['img_1']?>" class="fitimage" />
<br />
<div style="text-align:center; padding:3px; font-size:20px;"><b><?=$row['prezzo']?> €</b></div>
<center><i class="fa fa-info-circle" aria-hidden="true"></i></center>
</a>
</div>

<?php
if($i%3 == 0){
 echo"<div style='clear:left; padding:3px;'></div>";
	}

}
?>
</div>
<div style='clear:left; padding:3px;'></div>
<center style="margin-top:10px;">
<?php
//  numerazione delle pagine
for($ip = 1; $ip <= $p; $ip++){
    if ($page == $ip)   {  
    echo "<a href ='index.php?s=device&page=$ip' class='pagenumb-c'>$ip</a>";
    }else{
    echo "<a href ='index.php?s=device&page=$ip' class='pagenumb'>$ip</a>";
    }
}
?>
</center>
</div>
</div>
<div style='clear:left; padding:3px;'></div>

<script type="text/javascript">
$( document ).ready(function() {
// Abilito il Sottomenu rendendolo visibile
$( "#submain" ).css( "display", "block" );
// Aggiungo i link dinamicamente
$( "#submenu" ).append("<li><a href='index.php?s=device'>All</a></li>");
$( "#submenu" ).append('<li><a href="index.php?s=device-cat">By Category</a></li>');
$( "#submenu" ).append('<li><a href="index.php?s=promo">Promotion</a></li>');

  $("#price").change(function(){
    var newval=$(this).val();
    $("#slidernumber").text(newval);
    $.ajax({
                    type: 'GET',
                    url: 'lib/request_device.php',
                    data: 'max_price=' + newval,
                    success: function(data) {
                        $('#response').fadeOut(function() {
                            $.get('lib/request_device.php?max_price=' + newval , function(data) {
                                $('#response').html(data);
                                $('#response').fadeIn();
                            });
                        });
                    }
                });


  });


});

</script>