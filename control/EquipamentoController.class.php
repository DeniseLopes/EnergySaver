<?php
require_once "../../model/EquipamentoModel.class.php";

require_once "Conexao.class.php";
class EquipamentoController{
	private $equipamento;
	private $conexao;


	public function __construct(){
		$this->equipamento = new EquipamentoModel();
		$this->conexao = new Conexao();
	}

	public function getTipo(){
		$retorno = array();
		try{
			$cst= $this->conexao->connect()->prepare("select id, nome from categoria_equipamento");
			if($cst->execute()){
				$rst = $cst->fetchAll(PDO::FETCH_ASSOC);
				echo json_encode($rst);
				return true;

			}else{
				echo "ocorreu um erro";
			}
		}catch(PDOException $ex){
			$ex->getMessage();
		}
		return false;
	}



}
?>