<?php
require_once "../ConsumoController.class.php";
$consumo = new ConsumoController();
if(isset($_POST)){
	$inicio = $_POST['dataHoraIni'];
	$fim= $_POST['dataHoraFim'];
	$idEquipamento=$_POST['idEquipamento'];
	$consumo->selectForDate($inicio, $fim, $idEquipamento);
}
?>