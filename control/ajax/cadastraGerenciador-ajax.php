<?php 
require_once "../../model/GerenciadorModel.class.php";
require_once "../GerenciadorController.class.php";


$gerenciador = new GerenciadorModel();
if($_POST){

	$gerenciador->setMac($_POST['mac']);
	$gerenciador->setIp($_POST['ip']);
	$gerenciador->setDesc($_POST['desc']);
	$controle = new GerenciadorController($gerenciador);
	$controle->inserir();


}

?>