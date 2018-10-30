<?php
require_once "../UsuarioController.class.php";
$usuario = new UsuarioController();
$usuario->userLogin($_POST);

?>