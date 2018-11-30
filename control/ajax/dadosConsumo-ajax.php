<?php require_once "../EquipamentoController.class.php"
		if(isset($_POST)){
			$equipamento = new EquipamentoController();
			$ini = $_POST['dataHoraIni'];
			$fim = $_POST['dataHoraFim'];
			$id = $_POST['idEquipamento'];
			$retorno =$equipamento->getPicos($ini,$fim,$id);
			echo $retorno
		}
?>