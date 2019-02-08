<?php
	include'funcoes.php';
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
    </head>
    <body>
		<div id="conteudo">
			<center>
				<input type="text" name="nome" id="nome" placeholder="Nome:"><br>
				<input type="hidden" name="funcao" id="funcao" value="nome">
				<input type="button" name="btnEnvia" id="btnEnvia" value="Continuar">
				<div id="msg"></div>
			</cemter>
		</div>
    </body>
</html>