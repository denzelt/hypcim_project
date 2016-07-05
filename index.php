<!--
/*  ---------------------------------------------------  */
/*  HYPERMEDIA EXAM PROJECT                              */
/*  Politecnico di Milano - 2016                          */
/*  Giuliano Cotrufo - Andrea Cavallaro - Dario Messina  */
/*  ---------------------------------------------------  */
-->
<html>
<head>
  <meta charset="utf-8">
<title>HYPERMEDIA PROJECT: CIM</title>


<!--// Carico le librerie jQuery -->
<script src="https://code.jquery.com/jquery-git2.min.js" /></script>
<!--// Carico WebFont da allegare al foglio di stile [ FONT : Muli ] -->
<link href='https://fonts.googleapis.com/css?family=Muli:400,400italic' rel='stylesheet' type='text/css'>
<!--// Icone di FontAwesome da usare con i tag -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!--// Carico il foglio di stile -->
<link href='style.css' rel='stylesheet' type='text/css'>
</head>
<body>
 <!-- // Conterrà tutta la pagina web -->
  <div id="content">

  <!--  //Heading e Logo -->
    <div id="head"></div>

  <!--  // Barra di Navigazione -->
    <nav id="main">

    

      <ul>
        <div style="float:left;font-size:32px; margin-top:-5px;">
        <li> <a href="index.php?s=home"><i class="fa fa-home" aria-hidden="true"></i></a></li>
        </div>
        <li><a href="index.php?s=home">  HOME   </a></li> 
        <li><a href="index.php?s=device">  DEVICE   </a></li>  
        <li><a href="index.php?s=sl">  SMARTLIFE   </a></li>  
        <li><a href="index.php?s=assistance">  ASSISTANCE   </a></li>  
        <li><a href="index.php?s=altro">  XXXXXX   </a></li>
        <li><a href="index.php?s=admin">  Admin   </a></li>
        <div style="float:right; font-size:32px;margin-top:-10px;">
         <i class="fa fa-shopping-cart" aria-hidden="true"></i>
         <i class="fa fa-envelope" aria-hidden="true"></i>
        </div>
      </ul>

    </nav>
    <nav id="submain">
      <ul class="top" id="submenu">

      </ul>
    </nav>
<div id="page">

</div>
<footer>
 <?php include('footer.php'); ?>
   
 </footer>
  </div><!--// fine div#content -->
  <script type="text/javascript">
$( document ).ready(function() {
  var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
      }
  };
var s = getUrlParameter('s');

    $.ajax({
                    type: 'GET',
                    url: 'lib/request_page.php',
                    data: 's='+ s,
                    success: function(data) {
                        $('#page').fadeOut(function() {
                            $.get('lib/request_page.php?s=' + s, function(data) {
                                $('#page').html(data);
                                $('#page').fadeIn();
                            });
                        });
                    }
                });


  });

  </script>
</body>
</html>
