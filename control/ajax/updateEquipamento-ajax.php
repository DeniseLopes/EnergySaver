<?php
require_once "../../model/EquipamentoModel.class.php";
require_once "../EquipamentoController.class.php";
	/*private $id;
	private $modelo;
	private $tipo;
	private $wattsPotencia;
	private $status;
	private $gerenciadorId;
	private $descricao;*/


	if(isset($_POST)){
		$equipamento = new EquipamentoModel();
		$controlador = new EquipamentoController();
		$equipamento->setId($_POST['idEquipamento']);
		$equipamento->setModelo($_POST['modelo']);
		$equipamento->setTipo($_POST['tipo']);
		$equipamento->setWattsPotencia($_POST['potencia']);
		$equipamento->setGerenciadorId($_POST['mac']);
		$equipamento->setDescricao($_POST['desc']);
		$retorno =$controlador->update($equipamento);
		echo $retorno;
	}
	?>