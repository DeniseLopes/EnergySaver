<?php
 require_once "../GerenciadorController.class.php";
 require_once "../../model/GerenciadorModel.class.php";

 	$gerenciador = new GerenciadorModel();
 	$controle = new GerenciadorController($gerenciador);
 	$controle->getAll();
?>