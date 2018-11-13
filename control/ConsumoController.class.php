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
			$cst = $this->conexao->connect()->prepare("select corrente_segundo, data_hora from consumo where equipamento_id =22 and data_hora between'2018-11-12 20:00' and '2018-11-12 20:30'");
		
			if($cst->execute()){
				$rst = $cst->fetchall(PDO::FETCH_ASSOC);
				$retorno['consumo']= $rst;
				$retorno['sucesso']=true;
				

			}

		}catch(PDOException $ex){

			$retorno['sucesso']=false;
			$retorno['mensagem'] =  $ex->getMessage();
			$retorno['sql']= "select corrente_segundo from consumo where equipamento_id =$idEquip and data_hora between'$inicio' and '$fim' ";
		}
		return json_encode($retorno);
	}
}
?>