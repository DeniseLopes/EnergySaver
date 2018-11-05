<?php
class EquipamentoModel{
	private $id;
	private $modelo;
	private $tipo;
	private $wattsPotencia;
	private $status;
	private $gerenciadorId;

	public function getGerenciadorId(){
		return $this->gerenciadorId;
	}
	public function setGerenciadorId($valor){
		$this->gerenciadorId = $valor;
	}
	public function getTipo(){
		return $this->tipo;
	}
	public function setTipo($valor){
		$this->tipo = $valor;
	}
	public function getId()	{
		return $this->id;
	}
	public function setId($valor){
		$this->id = $valor;
	}
	public function getModelo(){
		return $this->modelo;
	}
	public function setModelo($valor){
		$this->modelo = $valor;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setStatus($valor){
		$this->status = $valor;
	}
	public function getWattsPotencia(){
		return $this->wattsPotencia;
	}
	public function setWattsPotencia($valor){
		$this->wattsPotencia = $valor;
	}

}
?>