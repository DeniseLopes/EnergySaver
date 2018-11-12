<?php
class ConsumoModel{
	private $id;
	private $corrente;
	private $dataHora;
	private $equipamentoId;

	public function getId(){
		return $this->id;

	}
	public function setId($valor){
		$this->id= $valor;
	}
	public function getCorrente(){
		return $this->corrente;
	}
	public function setCorrente($valor){
		$this->corrente = $valor;
	}
	public function getDataHora(){
		return $this->dataHora;
	}
	public function setDataHora($valor){
		$this->dataHora = $valor;
	}
	public function getEquipamentoId(){
		return $this->equipamentoId;
	}
	public function setEquipamentoId($valor){
		$this->equipamentoId = $valor;
	}
}
?>