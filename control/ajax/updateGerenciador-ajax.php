<?php require_once "../GerenciadorController.class.php";
	require_once "../../model/GerenciadorModel.class.php";

	if(isset($_POST)){
		session_start();
		$gerenciador = new GerenciadorModel();
		$gerenciador->setId($_POST['id']);
		$gerenciador->setMac($_POST['mac']);
		$gerenciador->setIp($_POST['ip']);
		$gerenciador->setUsuarioId($_SESSION['id']);
		$gerenciador->setDesc($_POST['desc']);
		$controle = new GerenciadorController($gerenciador);
		$retorno =$controle->update();
		echo $retorno;
	}
?>