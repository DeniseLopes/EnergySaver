<?php
require_once "../EquipamentoController.class.php";
require_once "../../model/EquipamentoModel.class.php";

if(isset($_POST)){
	$equipamento = new EquipamentoModel();
	$equipamento->setTipo($_POST['tipo']);
	$equipamento->setModelo($_POST['modelo']);
	$equipamento->setWattsPotencia($_POST['potencia']);
	$equipamento->setGerenciadorId($_POST['idGerenciador']);
	$controle = new EquipamentoController();
	$controle->setEquipamento($equipamento);
	$controle->insert();
}

?>