<?php
require_once "../GerenciadorController.class.php";
require_once "../../model/GerenciadorModel.class.php";
if(isset($_POST)){

	$modelo = new GerenciadorModel();
	$gerenciador = new GerenciadorController($modelo);
	$retorno = $gerenciador->select($_POST['id']);
	echo $retorno;
}
?>