<?php
require_once "Conexao.class.php";
require_once "../../model/ConsumoModel.class.php";


class ConsumoController{
	private $conexao;
	private $consumo;
	public function __construct(){
		$this->conexao = new Conexao();
		$this->consumo = new ConsumoModel();
	}
	public function selectForDate($inicio,$fim, $idEquip){
		$retorno = array();
		$retorno['sucesso']=false;
		try{
			$cst = $this->conexao->connect()->prepare("select corrente_segundo from consumo where equipamento_id =:equipamentoId and data_hora between':ini' and 'fim' ");
			$cst->bindParam(":equipamentoId", $idEquip, PDO::PARAM_STR);
			$cst->bindParam(":ini", $inicio, PDO::PARAM_STR);
			$cst->bindParam(":fim",$fim, PDO::PARAM_STR);
			if($cst->execute()){
				$rst = $cst->fetch();
				$retorno['consumo']= $rst;
				$retorno['sucesso']=true;

			}

		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			$retorno['mensagem'] =  $ex->getMessage();
		}
		return json_encode($retorno);
	}
}
?>