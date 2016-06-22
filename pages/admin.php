<center><h1>Admin</h1>
<p>In questa pagina possiamo popolare il database attraverso i form per velocizzare il tutto</p>
</center>

<?php
require('lib/connect_db.php');
// SOLO PER DEBUG DI ERRORI :error_reporting(E_ALL);
if(isset($_POST)){

	if($_GET['action'] == "add-device"){
	//Upload delle immagini
	foreach ($_FILES["file"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["file"]["tmp_name"][$key];
        $name = $_FILES["file"]["name"][$key];
        $up = '/membri/hypcim/img/'.$name;
        move_uploaded_file($tmp_name, $up) or die("Problemi con UPLOAD");
        // Salvo i nomi dei tre file in un array per inserirli nella query
         $file_name[] = "http://hypcim.altervista.org/img/".$name;
    		}
	}
	// Il testo con gli accenti è una rogna va formattato prima di inserirlo per evitare problemi con ' " e compagnia bella'
	$_POST["features"] = mysql_real_escape_string($_POST["features"]);
	$_POST["box"] = mysql_real_escape_string($_POST["box"]);
	// Inseriamo il valore nel Database
		$query = "INSERT INTO `devices` (`id`,`nome`, `prezzo`, `capacita`, `colore`, `features`, `box`, `img_1`, `img_2`, `img_3`, `categoria`) VALUES(NULL,'".$_POST["name"]."',
		'".$_POST["prezzo"]."',
		'".$_POST["capacita"]."', 
		'".$_POST["colore"]."',
		'".$_POST["features"]."',
		'".$_POST["box"]."',
		'".$file_name[0]."',
		'".$file_name[1]."',
		'".$file_name[2]."',
		'".$_POST["categoria"]."');";
		echo $query;
	// Eseguo la query per recuperare le informazioni dal database
	$result = mysql_query($query, $mysql) or die("Errore, Impossibile aggiungere le informazioni al database - ".mysql_errno()."- <br />".mysql_error());
	echo"<center><h1>Operazione Eseguita</h1><p>Occhio a riaggiornare la pagina perchè potrebbe inserire di nuovo il device</p></center>";
	}
	
	if($_GET['action'] == "del-device"){
		$query = "DELETE FROM devices WHERE id = ".abs($_POST['device-id']);
		// Eseguo la query per recuperare le informazioni dal database
		$result = mysql_query($query, $mysql) or die("Errore, Impossibile eliminare le informazioni dal database");
		echo"<center><h1>Operazione Eseguita</h1><p>Il device è stato rimosso</p></center>";
	}

}

?>

<form action="index.php?s=admin&action=add-device" method="post" class="bootstrap-frm"  enctype="multipart/form-data">
    <h1>Aggiungi Device
        <span>Compila tutti i campi obbligatori.</span>
    </h1>
    <label>
        <span>Nome Device:</span>
        <input id="name" type="text" name="name" placeholder="ex.iPhone 6" />
    </label>
    
    <label>
        <span>Prezzo :</span>
        <input id="prezzo" type="text" name="prezzo" placeholder="Solo Cifre 00.00" />
    </label>

    <label>
        <span>Capacità :</span>
        <input id="capacita" type="text" name="capacita" placeholder="ex.64" /> GB
    </label>

    <label>
        <span>Colore :</span>
        <input id="colore" type="text" name="colore" placeholder="Scriverli cosi : black,white" /> 
    
    <label>
        <span>Testo features :</span>
        <textarea id="features" name="features" placeholder="Testo delle features del device"></textarea>
    </label> 
    <label>
        <span>Testo BOX :</span>
        <textarea id="box" name="box" placeholder="Testo 'Cosa c'è nella scatola'"></textarea>
    </label>
     <label>
        <span>Categoria :</span><select name="categoria">
        <option value="Smartphone">Smartphone</option>
        <option value="Tablet">Tablet</option>      
        <option value="Network">Network</option>        
        <option value="Smartliving">Smart Living</option>
        </select>
    </label>
        <label>
        <span>Immagini :</span>
        <input id="file1" name="file[]" type="file" accept="image/*">
        <input id="file2" name="file[]" type="file" accept="image/*">
        <input id="file3" name="file[]" type="file" accept="image/*">
           <span>&nbsp;</span> 
    </label>    
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Aggiungi" /> 
    </label>    
</form>
<div style="clear:both"></div>
<form action="index.php?s=admin&action=del-device" method="post" class="bootstrap-frm"  enctype="multipart/form-data">
    <h1>Rimuovi Device
        <span>Seleziona dalla lista e premi rimuovi.</span>
    </h1>

     <label>
        <span>Device :</span><select name="device-id">
        <?php
        // Preparo la Query per mostrare tutti i device caricati nella tabella del database
		$query = "SELECT * FROM devices ORDER BY id DESC";
		// Eseguo la query per recuperare le informazioni dal database
		$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
		// Metto fuori i risultati dall'array
		while($row = mysql_fetch_array($result)){
			?>
        <option value="<?=$row['id']?>"><?php echo $row['id']." - ".$row['nome'] ?></option>
        <?php
    	} // Fine While
        ?>
        </select>
    </label>
        
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Rimuovi" /> 
    </label>    
</form>

