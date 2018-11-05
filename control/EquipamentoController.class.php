<?php
require_once "../../model/EquipamentoModel.class.php";
require_once "Conexao.class.php";
class EquipamentoController{
	private $equipamento;
	private $conexao;
	public function __construct(){
		$this->conexao = new Conexao();
	}
	public function getEquipamento(){
		return $this->equipamento;
	}
	public function setEquipamento($equipamento){
		$this->equipamento = $equipamento;
	}
	public function getTipo(){
		$retorno = array();
		try{
			$cst= $this->conexao->connect()->prepare("select id, nome from categoria_equipamento");
			if($cst->execute()){
				$rst = $cst->fetchAll(PDO::FETCH_ASSOC);
				$retorno['a']=$rst;
				echo json_encode($retorno);
			}else{
				echo "ocorreu um erro";
			}
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}
	public function insert(){
		$retorno = array();
		$gerenciadorExiste = self::busgaGerenciadorId();
		if($gerenciadorExiste){
			try{
				$cst= $this->conexao->connect()->prepare("insert into equipamento(tipo,modelo, watts_potencia, status,gerenciador_id) values(:tipo, :modelo, :watts, :status, :id_gerenciador)");
				$cst->bindValue(":tipo", $this->equipamento->getTipo(), PDO::PARAM_STR);
				$cst->bindValue(":modelo",$this->equipamento->getModelo(), PDO::PARAM_STR);
				$cst->bindValue(":watts",$this->equipamento->getWattsPotencia(), PDO::PARAM_STR);
				$cst->bindValue(":status", $this->equipamento->getStatus(), PDO::PARAM_STR);
				$cst->bindValue(":id_gerenciador", $this->equipamento->getGerenciadorId(), PDO::PARAM_STR);
				if($cst->execute()){
					$retorno['sucesso']=true;
					$retorno['mensagem']= "Equipamento cadastrado com sucesso!";
				}else{
					$retorno['sucesso']=false;
					$retorno['mensagem']= "falha na execução";
				}
			}catch(PDOException $e){
				$retorno['sucesso']=false;
				$retorno['mensagem']= "erro: ".$e->getMessage();
			}
		}else{
			$retorno['sucesso']=false;
			$retorno['mensagem']= "O endereço de mac do gerenciador informado não é valido";
		}
		echo json_encode($retorno);
	}
	private function busgaGerenciadorId(){
		try{
			$linhas= 0;
			$cst= $this->conexao->connect()->prepare("select * from gerenciador where id = :id ");
			$cst->bindValue(":id", $this->equipamento->getGerenciadorId(), PDO::PARAM_STR);
			if($cst->execute()){
				$linhas = $cst->rowCount();
				if($linhas==0){
					return false;
				}else{
					return true;
				}
			}
		}catch(PDOException $ex){
			echo $ex->getMessage();
			return false;
		}
	}
	public function getAll(){
		$retorno = array();
		session_start();
		try{
			$cst=$this->conexao->connect()->prepare("select * from equipamento where id = :id");
			$cst->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
			if($cst->execute()){
				$retorno['sucesso']= true;
				$resultSet = $cst->fetchAll(PDO::FETCH_ASSOC);
				$retorno['equipamentos']= $resultSet;
			}else{
				$retorno['sucesso']=false;
			}
		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			$retorno['mensagem']= "erro: ". $ex->getMessage();
		}
		echo json_encode($retorno);
	}
}
?>