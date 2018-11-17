<?php
require_once "../EquipamentoController.class.php";

if (isset($_POST)) {
	$equipamento = new EquipamentoController();
	$retorno = $equipamento->delete($_POST['idE']);
	echo $retorno;
}
?>