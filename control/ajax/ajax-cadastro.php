<?php
require_once "../UsuarioController.class.php";
require_once "../../model/UsuarioModel.class.php";
if(isset($_POST)){
	$usuario = new UsuarioModel();
	$usuario->setNome($_POST['nome']);
	$usuario->setSobrenome($_POST['sobrenome']);
	$usuario->setEmail($_POST['email']);
	$usuario->setSenha(sha1($_POST['senha']));
	$controle = new UsuarioController();
	$controle->queryInsert($usuario);
	
}else{
	echo "não recebi nada";	
}
?>