<?php require_once "../GerenciadorController.class.php";
require_once "../../model/GerenciadorModel.class.php";
if(isset($_POST)){
	$gerenciador = new GerenciadorModel();
	$controle = new GerenciadorController($gerenciador);
	$retorno = $controle->gerenciadores($_POST['idE']);
	echo $retorno;
}
?>