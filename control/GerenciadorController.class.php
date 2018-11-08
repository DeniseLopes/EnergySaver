<?php
require_once "Conexao.class.php";
require_once "../../model/GerenciadorModel.class.php";
class GerenciadorController{
	private $conexao;
	private $gerenciador;

	public function __construct($gerenciador){
		$this->conexao = new Conexao();
		$this->gerenciador = $gerenciador;
	}

	public function inserir(){
		session_start();
		$retorno = array();
		$idUser= $_SESSION['id'];
		try{
			$cst = $this->conexao->connect()->prepare("insert into gerenciador(mac_address,ip,descricao, usuario_id) values(:mac, :ip, :desc, :idUser)");
			$cst->bindValue(":mac",$this->gerenciador->getMac(), PDO::PARAM_STR);
			$cst->bindValue(":ip", $this->gerenciador->getIp(), PDO::PARAM_STR);
			$cst->bindValue(":desc", $this->gerenciador->getDesc(), PDO::PARAM_STR);
			$cst->bindParam(":idUser",$idUser, PDO::PARAM_STR);
			if($cst->execute()){
				$retorno['sucesso']=true;
				$retorno['mensagem']= "Gerenciador registrado com sucesso!";
			}else{
				$retorno['sucesso']=false;
				$retorno['mensagem']= "Erro ao tentar inserir o gerenciador";
			}
		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			$retorno['mensagem']= "erro: ".$ex->getMessage();
		}
		echo json_encode($retorno);
	}
	public function find($id){
		$retorno = array();
		session_start();
		try{
			$cst=$this->conexao->connect()->prepare("select modelo from equipamento where id in(select equipamento_id from gerenciador where usuario_id = :idUser);");
			$cst->bindParam(":idUser",$_SESSION['id']);
			if($cst->execute()){
				$rst= $cst->fetchAll(PDO::FETCH_ASSOC);
				$retorno['sucesso']= true;
				$retorno['modelos'] = $rst;
			}else{
				$retorno['sucesso']= false;				
			}
		}catch(PDOException $ex){
			$retorno['sucesso']= false;
			$retorno['mensagem'] ="falha:".$ex->getMessage();
		}
		echo json_encode($retorno);
	}
	public function getAll(){
		$retorno = array();
		session_start();
		try{
			$cst =$this->conexao->connect()->prepare("select id,mac_address from gerenciador where id not in (select gerenciador_id from equipamento) and usuario_id = :idUser");
			$cst->bindParam(":idUser",$_SESSION['id'], PDO::PARAM_STR);
			if($cst->execute()){
				$rst= $cst->fetchAll(PDO::FETCH_ASSOC);
				$retorno['sucesso']=true;
				$retorno['gerenciadores']= $rst;
			}else{
				$retorno['sucesso']=false;
			}
		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			$retorno['mensagem']= "erro :".$ex->getMessage();
		}
		echo json_encode($retorno);
	}
}
?>
