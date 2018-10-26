<?php 
class conexao{
	private $base;
	private $usuario;
	private $host;
	private $senha;
	private static $pdo;	

	public function __construct(){
		$this->base="gerenciador";
		$this->senha="";
		$this->usuario="root";
		$this->host="localhost";
		$pdo=null;
	}
	public function connect(){
		try{
			if(is_null(self::$pdo)){
				self::$pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->base, $this->usuario, $this->senha);
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			return self::$pdo;
		}catch(PDOException $e){
			echo 'Error: '.$e->getMessage();
		}
	}

	public function lastInsertId(){
		return self::$pdo->lastInsertId();
	}
}
?>