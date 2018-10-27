<?php
require_once "../UsuarioController.class.php";
$usuario= new UsuarioController();
$usuario->verificaEmail($_POST['email']);
?>
