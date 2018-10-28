<?php
require_once "../UsuarioController.class.php";
session_start();
$usuario = new UsuarioController();
$foto =$_FILES['foto'];

$caminho ="../../uf/".$_SESSION['id']."/";
$str= basename($_FILES['foto']['name']);
$ext = explode(".", $str);
$ext = '.'.$ext[(count($ext)-1)];
$nome_img = $_SESSION['id']."_perfil".$ext;
$uploadFile =$caminho .$nome_img;
if($uploadFile==null){

}
$_SESSION['img_perfil']= "../../uf/".$_SESSION['id']."/".$nome_img;
if(move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)){
	$usuario->uploadFoto($uploadFile);
	echo ($uploadFile) ;
}else{
	echo "falha ao enviar";
}

?>