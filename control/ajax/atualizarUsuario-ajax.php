<?php
include_once "../UsuarioController.class.php";

$usuario = new UsuarioController();
$usuario->queryUpdate($_POST);
?>