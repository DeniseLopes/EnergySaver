<?php
	require_once "../EquipamentoController.class.php";
	
	$controle = new EquipamentoController();
	$retorno =$controle->getEquipamentos($_POST['valor'],1);

?>