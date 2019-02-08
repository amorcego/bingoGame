$(document).ready(function(){//somente executa após html pronto
    //ajax envia nome jogador para php
    $("#btnEnvia").click(function(){
        nome = $("#nome").val();
		if(nome){
			$.ajax({url: "funcoes.php",type: "post", data: {funcao: "nome", nome: nome}, success: function(result){
				$("#msg").html(result);
			}});
		}else {
			$("#msg").html("Preencha o campo acima");
		}
    });
	//ajax entrar na sala selecionada
	$("div #sala").click(function(){
		sala = $(this).val();
		$.ajax({url:"funcoes.php", type:"post", data: {funcao: "entrarSala", sala: sala}, success: function(result){
			$("#msg").html(result);
		}});
	});
	//ajax alterar cartela
	$("#btnCartela").click(function(){
		$.ajax({url:"funcoes.php", type:"post", data: {funcao: "cartelas"}, success: function(result){
			$("#cartela").html(result);
		}});
	});
	//ajax do comando ficar preparado para o jogo
	$("#btnPronto").click(function(){
		pronto = $(this).val();
		$.ajax({url:"funcoes.php", type:"post", data: {funcao: "pronto", pronto: pronto}, success: function(result){
			$("#msg").html(result);
		}});
	});
	//ajax do comando para pausar o jogo
	$("div #btnPause").click(function(){
		$.ajax({url:"funcoes.php", type:"post", data: {funcao: "pause"}, success: function(result){
			$("#msg1").html(result);
		}});
	});
	//ajax do comando para marcar numero da cartela
	$("div .campoCartela").click(function(){
		if($(this).css("background-color") == "rgb(105, 105, 105)"){
			$(this).css("background-color", "rgb(255, 0, 0)");
		}else{
			$(this).css("background-color", "rgb(105, 105, 105)");
		}
		numero = $(this).text();
		$.ajax({url:"funcoes.php", type:"post", data: {funcao: "marcar", numero: numero}, success: function(result){
			$("#msg1").html(result);
		}});
	});
  
});