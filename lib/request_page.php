<?php
// prendo il contenuto della variabile GET s
$show = strip_tags(stripcslashes($_GET['s']));
// Contiene in nomi dei file in /pages contenuti per l'inclusione
$whitelist = ['home','device','sl','assistance', 'admin', 'show'];
//rimuoviamo roba strana che possono inserire malintenzionati
  if(in_array($show, $whitelist) or $_GET == null) {
       if(!isset($_GET['s'])){
             $show = "home";
           } 
    include("../pages/".$show. ".php");
  }else{
  include("../pages/404.php");
  }

?>