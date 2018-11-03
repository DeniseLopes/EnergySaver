<?php require_once "../GerenciadorController.class.php";
require_once "../../model/GerenciadorModel.class.php";
$modelo = new GerenciadorModel();
$controle = new GerenciadorController($modelo);
$controle->find($_POST['idEquipamento']);
?>