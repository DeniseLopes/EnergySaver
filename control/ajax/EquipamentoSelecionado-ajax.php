<?php
require_once "../EquipamentoController.class.php";
$controle = new EquipamentoController();
$retorno = $controle->getOne($_POST['id']);
echo $retorno;
?>