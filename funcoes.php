<?php
session_start();
/*configurando o servidor para interpretar os erros*/
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
	error_reporting(E_ALL);

header("Content-Type: text/html;  charset=ISO-8859-1",true);
//chama função apartir de dados recebidos de ajax 
    if(isset($_POST['funcao'])){
		$_POST['funcao']();
	}
	
//conexão com banco de dados pasando query
	function &banco($q){
		try {
			$conn = new PDO('mysql:host=mysql.hostinger.com.br;dbname=u295717340_bingo', 'u295717340_adm', '41354135');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$data = $conn->query($q);
			return $data;	
		} catch(PDOException $e) {
			echo 'ERRO: '. $e->getMessage();
		}
	}
	
//verifica autenticação jogadores
	function verifica($n){
		if($_SESSION[$n] == false){
			header("Location: index.php");
		}
	}
	
//função para verificar se nome do jogar é unico, se verdadeiro redireciona para proxima tela
    function nome(){
		$pesquisa =& banco('SELECT * FROM bingo where nome="'.$_POST['nome'].'"');
		if($pesquisa->rowCount() == 0){
			banco('INSERT INTO bingo (nome) VALUES ("'.$_POST['nome'].'")');
			$_SESSION['nome'] = $_POST['nome'];
			$_SESSION['b1'] = true;
			echo '<script>location.href="sala1.php";</script>';
		}else{
			echo 'Nome de usuario já existente';
		}
    }
	
//função para ler jogos em andamento
	function jogos(){
		$pesquisa =& banco('SELECT * FROM jogos');
		foreach($pesquisa as $row){
			if($row['andamento']==1){
				if($row['protegido']==1){
					echo '<div class="fas fa-lock"><input type="button" disabled value="JOGO EM ANDAMENTO" ></div><br>';
				}else{
					echo '<input type="button" disabled value="JOGO EM ANDAMENTO" ><br>';
				}
			}else{
				if($row['protegido']==1){
					echo '<div class="fas fa-lock"><input type="button" id="sala" value="'.$row['titulo'].'" ></div><br>';
				}else{
					echo '<input type="button" id="sala" value="'.$row['titulo'].'" ><br>';
				}
			}
		}
	}
	
//função para ler inicio do jogos
	function jogo(){
		$pesquisa =& banco('SELECT * FROM bingo WHERE sala="'.$_SESSION['sala'].'"');
		foreach($pesquisa as $row){
			echo $row['nome'].' ';
			if($row['pronto'] == 1){
				echo '- [PRONTO]<br>';
			}else{
				echo '- [ESCOLHENDO]<br>';
			}
		}
		$qtdJogadores = $pesquisa->rowCount();
		$pesquisa =& banco('SELECT * FROM bingo WHERE pronto=1 AND sala="'.$_SESSION['sala'].'"');
		$jogadoresProntos = $pesquisa->rowCount();
		if($qtdJogadores>=2 && $qtdJogadores == $jogadoresProntos){
			$pesquisa =& banco('UPDATE jogos SET andamento=1, cheia="", linha="", data="'.strtotime(date('d-m-Y H:i:s')).'" WHERE titulo="'.$_SESSION['sala'].'"');
			$_SESSION['b2'] = true;
			echo '<script>location.href="sala3.php";</script>';
		}
	}
	
//função para entrar na sala selecionada
	function entrarSala(){
		$pesquisa =& banco('UPDATE bingo SET sala="'.$_POST['sala'].'" WHERE nome="'.$_SESSION['nome'].'"');
		$_SESSION['sala'] = $_POST['sala'];
		$pesquisa =& banco('SELECT * FROM bingo WHERE sala="'.$_SESSION['sala'].'"');
		
		if($pesquisa->rowCount() == 1){
			$pesquisa =& banco('UPDATE jogos SET adm="'.$_SESSION['nome'].'" WHERE titulo="'.$_POST['sala'].'"');
			$_SESSION['cartela'] = array();
		}
		echo '<script>location.href="sala2.php";</script>';
	}
	
//função para ficar pronto para o jogo
	function pronto(){
		$pesquisa =& banco('UPDATE bingo SET pronto=1 WHERE nome="'.$_SESSION['nome'].'"');
		echo '<script>$("div #btnCartela").hide(); $("div #btnPronto").val("Aguardando...");</script>';
	}
	
//função para imprimir botao na tela do administrador
	function InputAdm(){
		$pesquisa =& banco('SELECT *FROM jogos WHERE titulo="'.$_SESSION['sala'].'"');
		foreach($pesquisa as $row){
			if($row['adm'] == $_SESSION['nome']){
				echo '<input id="btnPause" type="button" value="Iniciar/ Parar">';
			}
		}
	}
	
//gera números aleatórios para cartela
	function cartelas(){
		$i = 0;
		$cartela = array();
		while($i < 5){
			$valor1 = rand(1,15);
			while(in_array($valor1, $cartela)){
				$valor1 = rand(1,15);
			}
			$cartela[] = $valor1;
			
			$valor2 = rand(16,30);
			while(in_array($valor2, $cartela)){
				$valor2 = rand(16,30);
			}
			$cartela[] = $valor2;
			
			$valor3 = rand(31,45);
			while(in_array($valor3, $cartela)){
				$valor3 = rand(31,45);
			}
			$cartela[] = $valor3;
			
			$valor4 = rand(46,60);
			while(in_array($valor4, $cartela)){
				$valor4 = rand(46,60);
			}
			$cartela[] = $valor4;
			
			$valor5 = rand(61,75);
			while(in_array($valor5, $cartela)){
				$valor5 = rand(61,75);
			}
			$cartela[] = $valor5;
			$i++;
		}
		$pesquisa =& banco('UPDATE bingo SET cartela="'.serialize($cartela).'" WHERE nome="'.$_SESSION['nome'].'"');
		cartela();
	}
	
//função para ler cartela cadastrada no banco de dados
	function cartela(){
		$pesquisa =& banco('SELECT * FROM bingo WHERE nome="'.$_SESSION['nome'].'"');
		$array = array();
		foreach($pesquisa as $row){
			$array = unserialize($row['cartela']);
		}
		$i = 0;
		while($i < count($array)){
			echo '<div class="campoCartela">'.$array[$i].'</div>';
			$i++;
		}
	}
	
//função para contar as pedras
	function jogando(){$pesquisa =& banco('SELECT *FROM jogos WHERE titulo="'.$_SESSION['sala'].'"');
		foreach($pesquisa as $linha){
			if($linha['adm'] == $_SESSION['nome']){
				$pesquisa =& banco('SELECT * FROM jogos WHERE titulo="'.$_SESSION['sala'].'"');
				foreach($pesquisa as $row){
					if(($row['data']+6)<=strtotime(date('d-m-Y H:i:s')) && $row['pause'] == 0 && count(unserialize($row['pedras'])) < 75){
						$busca = 1;
						while($busca){
							$valor = rand(1,75);
							$busca = in_array($valor, $_SESSION['cartela']);
						}
						$_SESSION['cartela'][] = $valor;
						$atualiza =& banco('UPDATE jogos SET pedras="'.serialize($_SESSION['cartela']).'", data="'.strtotime(date('d-m-Y H:i:s')).'" WHERE titulo="'.$_SESSION['sala'].'"');
						echo '<script>
								/*funcao alarme garçom*/
								navigator.vibrate( 500);
								var audioCtx = new (window.AudioContext || window.webkitAudioContext)(); 
								var source = audioCtx.createBufferSource(); 
								var xhr = new XMLHttpRequest(); 
								xhr.open("GET", "bip.mp3"); 
								xhr.responseType = "arraybuffer"; 
								xhr.addEventListener("load", function (r) { 
									audioCtx.decodeAudioData( xhr.response, 
									function (buffer) { 
										source.buffer = buffer; 
										source.connect(audioCtx.destination); 
										source.loop = false; 
									}); 
									source.start(0); 
								}); 
								xhr.send();
								AudioContext.close();
							</script>';
					}
				}
			}else{
				$pesquisa =& banco('SELECT * FROM jogos WHERE titulo="'.$_SESSION['sala'].'"');
				foreach($pesquisa as $row){
					if(($row['data']+5)<=strtotime(date('d-m-Y H:i:s')) && $row['pause'] == 0 && count(unserialize($row['pedras'])) < 75){
						echo '<script>
								/*funcao alarme garçom*/
								navigator.vibrate( 500);
								var audioCtx = new (window.AudioContext || window.webkitAudioContext)(); 
								var source = audioCtx.createBufferSource(); 
								var xhr = new XMLHttpRequest(); 
								xhr.open("GET", "bip.mp3"); 
								xhr.responseType = "arraybuffer"; 
								xhr.addEventListener("load", function (r) { 
									audioCtx.decodeAudioData( xhr.response, 
									function (buffer) { 
										source.buffer = buffer; 
										source.connect(audioCtx.destination); 
										source.loop = false; 
									}); 
									source.start(0); 
								}); 
								xhr.send();
								AudioContext.close();
							</script>';
					}
				}
			}
		}
		$ler =& banco('SELECT * FROM jogos WHERE titulo="'.$_SESSION['sala'].'"');
		$array = array();
		foreach($ler as $row){
			if($row['cheia']!=""){
				echo '<script>alert("'.$row['cheia'].' Completou sua cartela! ");</script>';
				echo '<script> location.href="sala1.php"; </script>';
				$atualiza =& banco('UPDATE bingo SET pronto=0, sala="" WHERE nome="'.$_SESSION['nome'].'"');
				$_SESSION['b2'] = false;
				unset($_SESSION['pedrasConfirmadas']);
			}
			
			$array = unserialize($row['pedras']);
		}
		$i = 0;
		while($i < count($array)){
			if($i == (count($array)-1)){
				echo '<div id="pedraVez">'.$array[$i].'</div>';
				echo '<script> 
						$("#historico div:contains('.str_pad($array[$i], 2, '0', STR_PAD_LEFT).')").css( "background-color", "rgb(0, 0, 0)" );
					</script>';
			}else{
				echo '<script> 
						$("#historico div:contains('.str_pad($array[$i], 2, '0', STR_PAD_LEFT).')").css( "background-color", "rgb(0, 0, 0)" );
					</script>';
			}
			$i++;
		}
	}
	
//função para pausar o jogo
	function pause(){
		$pesquisa =& banco('SELECT * FROM jogos WHERE titulo="'.$_SESSION['sala'].'"');
		foreach($pesquisa as $row){
			if($row['pause'] == 1){
				$atualiza =& banco('UPDATE jogos SET pause=0 WHERE titulo="'.$_SESSION['sala'].'"');
			}else{
				$atualiza =& banco('UPDATE jogos SET pause=1 WHERE titulo="'.$_SESSION['sala'].'"');
			}
		}
		
	}
//função para marcar numeros na cartela	
	function marcar(){
		if(!isset($_SESSION['pedrasConfirmadas'])){
			$_SESSION['pedrasConfirmadas'] = array();
		}
		if(in_array($_POST['numero'], $_SESSION['pedrasConfirmadas'])){
			$ind = array_search($_POST['numero'], $_SESSION['pedrasConfirmadas']);
			unset($_SESSION['pedrasConfirmadas'][$ind]);
		}else{
			array_push($_SESSION['pedrasConfirmadas'], $_POST['numero']);
		}
		//var_dump($_SESSION['pedrasConfirmadas']);
		if(count($_SESSION['pedrasConfirmadas']) == 25){
			$query =& banco('SELECT * FROM jogos WHERE titulo="'.$_SESSION['sala'].'"');
			foreach($query as $row){
				$QtdCantada = count(unserialize($row['pedras']));
				$diferenca = count(array_diff(unserialize($row['pedras']), $_SESSION['pedrasConfirmadas']));
				if($diferenca == ($QtdCantada-25)){
					$atualiza =& banco('UPDATE jogos SET pedras="", andamento=0, pause=1, cheia="'.$_SESSION['nome'].'" WHERE titulo="'.$_SESSION['sala'].'"');
					echo $row['cheia'].' ganhou!';
				}else{
					echo 'está marcando errado';
				}
			}
		}
	}
	
?>