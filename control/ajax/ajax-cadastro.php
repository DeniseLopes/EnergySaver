<?php
require_once "../UsuarioController.class.php";
if(isset($_POST)){
	$usuario = new UsuarioController();
	$usuario->queryInsert($_POST);
	
}else{
	
}
?>