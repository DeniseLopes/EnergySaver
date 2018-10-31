<?php
class EquipamentoModel{
	private $id;
	private $nome;
	private $dispositivoId;
	private $wattsPotencia;
	private $status;


	public function getId(){
		return $this->id;
	}
	public function setId($valor){
		$this->id = $valor;
	}
	public function getNome(){
		return $this->nome;
	}
	public function setNome($valor){
		$this->nome = $valor;
	}
	public function getDispositivoId(){
		return $this->dispositivoId;
	}
	public function setDispositivoId($valor){
		$this->dispositivoId = $valor;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setStatus($valor){
		$this->status = $valor;
	}

}
?>