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
		$query = "select corrente_segundo, data_hora from consumo where equipamento_id =".$idEquip . "  and data_hora between '". $inicio."' and '". $fim ."'";
		$retorno['sucesso']=false;
		try{
			$cst = $this->conexao->connect()->prepare($query);
			if($cst->execute()){
				$rst = $cst->fetchALL(PDO::FETCH_ASSOC);
				$retorno['consumo']= $rst;
				$retorno['sucesso']=true;
			}
		}catch(PDOException $ex){
			$retorno['sucesso']=false;
			$retorno['consumo'] = "erro :".  $ex->getMessage();
		}
		return json_encode($retorno);
	}
}
?>