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
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/scripts.js"></script>
		<script>
			$(document).ready(function(){
				setInterval("jogo()", 1000); 
			});
			function jogo(){
				$.ajax({url:"funcoes.php", type:"post", data: {funcao: "jogo"}, success: function(result){
					$("#msg").html(result);
				}});
			}
		</script>
    </head>
    <body>
		<div id="conteudo">
			<center>
			<div style="color: yellow; background-color: rgba(0, 0, 0, 0.8);" id="msg"></div>
				<input type="button" id="btnCartela" name="btnCartela" value="Trocar cartela">
				<div id="cartela">
					<?php cartela(); ?>
				</div>
				<input type="button" id="btnPronto" name="btnPronto" value="Pronto">
				<br>
			</center>
		</div>
    </body>
</html>