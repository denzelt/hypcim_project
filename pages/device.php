<div style="margin:auto; text-aling:center; width:850px;">
<h1>Device</h1>
<p>Welcome in the Device page, here you can navigate throught our catalog. You can view all devices or you can choose a category. You can also check the Promotion page where there are always good deals!</p>
<form name="filters" method="get" action="index.php?s=device">

  <label>Price: <span id="slidernumber"></span>
    <input type="range" name="price" min="0" max="1500" step="10" id="price">
  </label>
  <input type="submit" value="Mostra">
</form>
<?php
// Connetto il DB
require('lib/connect_db.php');
// Preparo la Query per mostrare tutti i device caricati nella tabella del database
$query = "SELECT * FROM devices ORDER BY id DESC LIMIT 9";
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
</div>
<script type="text/javascript">
$( document ).ready(function() {
// Abilito il Sottomenu rendendolo visibile
$( "#submain" ).css( "display", "block" );
// Aggiungo i link dinamicamente
$( "#submenu" ).append("<li><a href='index.php?s=device&show=all'>All</a></li>");
$( "#submenu" ).append('<li><a href="index.php?s=device&show=category">By Category</a></li>');
$( "#submenu" ).append('<li><a href="index.php?s=device&show=promotion">PROMOTION</a></li>');

  $("#price").change(function(){
    var newval=$(this).val();
    $("#slidernumber").text(newval);
    $.ajax({
                    type: 'GET',
                    url: 'lib/request_device.php',
                    data: 'max_price=' + newval,
                    success: function() {
                        $('#response').fadeOut(function() {
                            $.get('lib/request_device.php', function(data) {
                                $('#response').html(data);
                                $('#response').fadeIn();
                            });
                        });
                    }
                });


  });


});

</script>
