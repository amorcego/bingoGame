<?php
//classe comexão com banco de dados
	class Conexao {
		
	//atributos
		private $drive;
		private $banco;
		private $usuario;
		private $senha;
		private $condicao;
		private $retorno;
		
	//metodos especiais
		public function __construct(){
			$this->setDrive('mysql:host=mysql.hostinger.com.br');
			$this->setBanco('u715618394_carda');
			$this->setUsuario('u715618394_ton');
			$this->setSenha('c41350000');
		}
		protected function getDrive(){
			return $this->drive;
		}
		private function setDrive($d){
			$this->drive = $d;
		}
		protected function getBanco(){
			return $this->banco;
		}
		private function setBanco($b){
			$this->banco = $b;
		}
		protected function getUsuario(){
			return $this->usuario;
		}
		private function setUsuario($u){
			$this->usuario = $u;
		}
		protected function getSenha(){
			return $this->senha;
		}
		private function setSenha($s){
			$this->senha = $s;
		}
		public function getCondicao(){
			return $this->condicao;
		}
		public function setCondicao($c){
			$this->condicao = $c;
		}
		public function getRetorno(){
			return $this->retorno;
		}
		public function setRetorno($r){
			$this->retorno = $r;
		}
		
	//metodos
		public function pesquisa($q){
			try {
				$conn = new PDO($this->getDrive().';dbname='.$this->getBanco(),$this->getUsuario(),$this->getSenha());
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$data = $conn->query($q);
				$array = array();
				foreach($data as $row){
					array_push($array, $row);
				}
				$this->setRetorno($array);
			}
			catch(PDOException $e) {
				echo 'ERRO: ' . $e->getMessage();
			}
		}
		
		public function atualizacao($qr){
			try {
				$conn = new PDO($this->getDrive().';dbname='.$this->getBanco(),$this->getUsuario(),$this->getSenha());
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$data = $conn->query($qr);
				$count = $data->rowCount();
				$this->setRetorno($count);
			}
			catch(PDOException $e) {
				echo 'ERRO: ' . $e->getMessage();
			}
		}
		
		public function lCardapio($a, $b, $c){
			try {
				$conn = new PDO($this->getDrive().';dbname='.$this->getBanco(),$this->getUsuario(),$this->getSenha());
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$data = $conn->query('SELECT DISTINCT categoria  FROM cardapio');
				foreach($data as $row){
					echo $a;
					$data1 = $conn->query("SELECT * FROM cardapio");
					foreach($data1 as $row1){
						if($row['categoria']==$row1['categoria']){
							echo $b;
						}
					}
					echo $c;
				}
			}
			catch(PDOException $e) {
				echo 'ERRO: ' . $e->getMessage();
			}
		}
		
		public function log($m){
			try {
				$conn = new PDO($this->getDrive().';dbname='.$this->getBanco(),$this->getUsuario(),$this->getSenha());
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				session_start();
				date_default_timezone_set('America/Sao_Paulo');
				$data = $conn->query('INSERT INTO log (data, hora, nome, evento, nivelP) VALUES ("'.date('d/m/Y').'","'.date('H:i:s').'","'.$_SESSION['nome'].'","'.$m.'","'.$_SESSION['nivel'].'")');
			}
			catch(PDOException $e) {
				echo 'ERRO: ' . $e->getMessage();
			}
		}
	}
?>