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
	public function gerenciadores($idEquipamento){
		$retorno= array();
		session_start();
		
		$retorno['sucesso']=false;
		try{
			$cst=$this->conexao->connect()->prepare("select id, mac_address from gerenciador id where id not in (select gerenciador_id from equipamento) and usuario_id =:idUser or id = (select gerenciador_id from equipamento where id = :idEquip)
");
			$cst->bindParam(':idUser', $_SESSION['id'], PDO::PARAM_STR);
			$cst->bindParam(':idEquip', $idEquipamento, PDO::PARAM_STR);
			if($cst->execute()){
				$retorno['sucesso'] =true;
				$retorno['equipamentos']=$cst->fetchALL(PDO::FETCH_ASSOC);
				$retorno['equipamento_id']= $idEquipamento;
				$retorno['user_id']  = $_SESSION['id'];

			}
		}catch(PDOException $ex){
		$retorno['mensagem'] = "erro:".$ex->getMessage();
		}
		return json_encode($retorno);
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
	public function getGerenciadores(){
		$retorno = array();
		try{
			$cst =$this->conexao->connect()->prepare("select * from gerenciador where usuario_id = :idUser");
			$cst->bindParam(":idUser",$_SESSION['id'], PDO::PARAM_STR);
			if($cst->execute()){
				$rst= $cst->fetchAll(PDO::FETCH_ASSOC);

			}
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
		return json_encode($rst);

	}
	public function select($id){
		$retorno = array();
		$retorno['sucesso'] =false;
		try{
			$cst=$this->conexao->connect()->prepare("select * from gerenciador where id=:id");
			$cst->bindParam(":id",$id,PDO::PARAM_STR);
			if($cst->execute()){
				$retorno['sucesso']=true;
				$retorno['gerenciadores']=$cst->fetch();
			}

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		return json_encode($retorno);
	}
	public function update(){
		$retorno = array();
		$retorno['sucesso']=false;
		try{
			$cst =$this->conexao->connect()->prepare("update gerenciador set descricao = :desc, ip=:ip, mac_address=:mac where id = :id");
			$cst->bindValue(":desc", $this->gerenciador->getDesc());
			$cst->bindValue(":ip", $this->gerenciador->getIp());
			$cst->bindValue(":mac", $this->gerenciador->getMac());
			$cst->bindValue(":id", $this->gerenciador->getId());
			if($cst->execute()){
				$retorno['sucesso']=true;
				$retorno['mensagem']= "Gerenciador atualizado com sucesso";
			}
		}catch(PDOException $ex){
			$retorno['mensagem'] = $retorno['sucesso']=true;
			$retorno['mensagem']= "erro: ".$ex->getMessage();
		}
		return json_encode($retorno);
	}

	public function verificaEquipamentos($id){
		$linhas= 0;
		try{
			$cst=$this->conexao->connect()->prepare("select * from equipamento where gerenciador_id = :id");
			$cst->bindParam(":id",$id, PDO::PARAM_STR);
			if($cst->execute()){
				$linhas= $cst->rowCount();
				return $linhas;	
			}


		}catch(PDOException $ex){
			$ex->getMessage();
		}

	}
	public function delete(){
		$retorno = array();
		$retorno['sucesso']=false;
		$linhas = self::verificaEquipamentos($this->gerenciador->getId());
		$retorno['linhas']= $linhas;
		try{
			if($linhas ==0){	
				$cst=$this->conexao->connect()->prepare("delete from gerenciador where id= :id");
				$cst->bindValue(":id", $this->gerenciador->getId());
				if($cst->execute()){
					$retorno['sucesso']= true;	
					$retorno['mensagem']= "Equipamento removido com sucesso";
				}
			}else{
				$retorno['mensagem']= "Não é possível remover este gerenciador pois existe um equipamento vinculado a ele. remova-o equipamento antes e tente novamente";
			}
		}catch(PDOException $ex){
			$retorno['mensagem']=$ex->getMessage();
		}
		return json_encode($retorno);
	}

}
?>
