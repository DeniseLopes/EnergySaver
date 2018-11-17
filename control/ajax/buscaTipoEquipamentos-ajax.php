<?php
require_once "../EquipamentoController.class.php";
if(isset($_POST)){
	$equipamento= new EquipamentoController();
	$retorno =$equipamento->getTipo();
	echo $retorno;
}else{
	echo "nada recebido";
}*/
echo "ok";
?>

