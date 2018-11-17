<?php
require_once "../Conexao.class.php";
$conexao = new Conexao();
$cst = $conexao->connect()->prepare("select id, nome from categoria_equipamento");
if($cst->execute()){
	$rst= $cst->fetchALL(PDO::FETCH_ASSOC);
	echo json_encode($rst);
}
?>