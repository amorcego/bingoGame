<?php
	include'funcoes.php';
	verifica('b1');
?>
<html>
    <head>
        <title>Bingo online</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="iso-8859-1">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js"></script>
		<script>
			$(document).ready(function(){
				setInterval("jogos()", 30000); 
			});
			function jogos(){
				location.reload();
				/*$.ajax({url:"funcoes.php", type:"post", data: {funcao: "jogos"}, success: function(result){
					$("#jogos").html(result);
				}});*/
			}
		</script>
    </head>
    <body>
		<div id="conteudo">
			<center>
				<h2>Salas de bingo</h2>
				<div id="jogos">
					<?php
						jogos();
					?>
				</div>
				<div id="msg">
				</div>
			</center>
		</div>
    </body>
</html>