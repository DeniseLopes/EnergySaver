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
				$retorno['sucesso']=true;
				$retorno['equipamentos']=$rst;
			}else{
				$retorno['mensagem']= "ocorreu um erro";
			}
		}catch(PDOException $ex){
			$retorno['mensagem']= $ex->getMessage();
		}
		return json_encode($retorno);
	}
	public function select($id){
		$retorno = array();

		$retorno['sucesso']=false;
		try{
			$cst =$this->conexao->connect()->prepare("select * from equipamento where id = :id");
			$cst->bindParam(":id", $id, PDO::PARAM_STR);
			if($cst->execute()){
				$retorno['sucesso']=true;
				$retorno['equipamento'] = $cst->fetch();
			}

		}catch(PDOException $ex){
			$ex->getMessage();
		}
		return json_encode($retorno);
	}
	public function insert(){
		$retorno = array();
		$gerenciadorExiste = self::busgaGerenciadorId();
		$tipo = self::retornaSrc($this->equipamento->getTipo());
		$src = "/assets/imgs/".$tipo. "-icon.png";
		if($gerenciadorExiste){
			try{
				$cst= $this->conexao->connect()->prepare("insert into equipamento(tipo,modelo, watts_potencia,gerenciador_id,descricao, status, src_img) values(:tipo, :modelo, :watts, :id_gerenciador, :desc,:status, :src)");
				$cst->bindValue(":tipo", $this->equipamento->getTipo(), PDO::PARAM_STR);
				$cst->bindValue(":modelo",$this->equipamento->getModelo(), PDO::PARAM_STR);				
				$cst->bindValue(":status", $this->equipamento->getStatus(), PDO::PARAM_STR);	
				$cst->bindValue(":id_gerenciador", $this->equipamento->getGerenciadorId(), PDO::PARAM_STR);
				$cst->bindValue(":desc", $this->equipamento->getDescricao(), PDO::PARAM_STR);
				$cst->bindValue(":watts",$this->equipamento->getWattsPotencia(), PDO::PARAM_STR);
				$cst->bindParam(":src", $src, PDO::PARAM_STR);

				if($cst->execute()){
					$retorno['sucesso']=true;
					$retorno['mensagem']= "Equipamento cadastrado com sucesso!";
					$retorno['src_img'] = $src;
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
		try{
			$cst=$this->conexao->connect()->prepare("select * from equipamento where gerenciador_id in(select id from gerenciador where usuario_id= :id)");
			$cst->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
			if($cst->execute()){
				$resultSet = $cst->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($resultSet);
			}else{
			}
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
		return json_encode($retorno);
	}
	public function getOne($id){
		$retorno = null;
		try{
			$cst = $this->conexao->connect()->prepare("select * from equipamento where id = :id");
			$cst->bindParam(":id",$id, PDO::PARAM_STR);
			if($cst->execute()){
				$retorno = $cst->fetch();	
			}
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
		return json_encode($retorno);

	}
	public function retornaSrc($tipo){
		$cst=$this->conexao->connect()->prepare("select nome from categoria_equipamento where id = :id");
		$cst->bindParam(":id", $tipo, PDO::PARAM_STR);
		if($cst->execute()){
			$rst= $cst->fetch();
		}
		
		return $rst['nome'];
	}
	public function getEquipamentos($id){
		$retorno = array();
		session_start();
		try{
			$cst=$this->conexao->connect()->prepare("select modelo,id from equipamento where id !=:id and gerenciador_id in (select id from gerenciador where usuario_id =:userId)");
			$cst->bindParam(":id",$id,PDO::PARAM_STR);
			$cst->bindParam(":userId", $_SESSION['id'], PDO::PARAM_STR);
			if($cst->execute()){
				$rst= $cst->fetchAll(PDO::FETCH_ASSOC);
				$retorno['equipamentos']= $rst;
				$retorno['sucesso']= true;
				$retorno['mensagem']= "total de linhas: :". $cst->rowCount() ;
				
			}else{
				$retorno['sucesso']= false;
				$retorno['mensagem']="erro de sql";
			}
		}catch(PDOException $ex){
			$retorno['sucesso']= false;
			$retorno['mensagem']="erro:"+ $ex->getMessage();
		}
		echo json_encode($retorno);
	}
	public function delete($id){
		$retorno = array();
		$query1= "delete from equipamento where id =". $id;	
		$query2 = "delete from consumo where equipamento_id =".$id;
		try{
			$conn = new PDO ("mysql:host=localhost;dbname=gerenciador", "root", "");
			$conn->beginTransaction(); 
			$cst=$conn->exec($query2);
			$cst=$conn->exec($query1);
			$conn->commit();
			$retorno['sucesso']=true;
			$retorno['mensagem']= "equipamento removido com sucesso@";
		}catch(PDOException $ex){
			$conn->rollback();
			$retorno['sucesso']=false;
			$retorno['mensagem']= "erro:".	$ex->getMessage();
		}
		return json_encode($retorno);
	}
	public function update($equipamento){
		$retorno = array();
		$retorno['sucesso']= false;
		try{
			$cst = $this->conexao->connect()->prepare("update equipamento set modelo= :modelo , tipo= :tipo,  gerenciador_id= :idG, watts_potencia =:watts, descricao = :descricao where id = :id ");
			$cst->bindParam(":modelo",$equipamento->getModelo(), PDO::PARAM_STR);
			$cst->bindParam(":tipo",$equipamento->getTipo(), PDO::PARAM_STR);
			$cst->bindParam(":idG",$equipamento->getGerenciadorId(), PDO::PARAM_STR);
			$cst->bindParam(":watts",$equipamento->getWattsPotencia(), PDO::PARAM_STR);
			$cst->bindParam(":descricao",$equipamento->getDescricao(), PDO::PARAM_STR);
			$cst->bindParam(":id",$equipamento->getId(), PDO::PARAM_STR);
			if ($cst->execute()) {
				$retorno['sucesso']= true;
				$retorno['mensagem']= "Dados atualizados com sucesso";	
			}
		}catch(PDOException $e){
			$retorno['sucesso']= false;
			$retorno['mensagem']="erro :".$e->getMessage();
		}		
		return json_encode($retorno);
	}
}
?>