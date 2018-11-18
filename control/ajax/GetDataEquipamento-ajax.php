
<?php 
require_once "../EquipamentoController.class.php";

if(isset($_POST)){
	$equipamento = new EquipamentoController();
	$retorno=$equipamento->select($_POST['idE']);
	echo $retorno;
}
?>