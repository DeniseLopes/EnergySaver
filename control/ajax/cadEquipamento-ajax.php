<?php
require_once "../EquipamentoController.class.php";
require_once "../../model/EquipamentoModel.class.php";

if(isset($_POST)){
	$equipamento = new EquipamentoModel();
	$equipamento->setTipo($_POST['tipo']);
	$equipamento->setModelo($_POST['modelo']);
	$equipamento->setWattsPotencia($_POST['potencia']);
	$equipamento->setDescricao($_POST['desc']);
	$equipamento->setGerenciadorId($_POST['idGerenciador']);	
	$equipamento->setStatus("desconectado");
	$controle = new EquipamentoController();
	$controle->setEquipamento($equipamento);
	$controle->insert();
}

?>