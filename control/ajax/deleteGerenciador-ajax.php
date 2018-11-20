<?php require_once "../GerenciadorController.class.php";
require_once "../../model/GerenciadorModel.class.php";
if(isset($_POST)){
	$gerenciador = new GerenciadorModel();
	$gerenciador->setId($_POST['id']);
	$controle = new GerenciadorController($gerenciador);
	$resposta = $controle->delete();
	echo $resposta;
}
?>