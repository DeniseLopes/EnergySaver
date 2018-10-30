<?php include"../templates/topoLogado.php";
if(isset($_SESSION['logado'])!="sim"){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php' >";
}else{
	?>

	<!-- sidebar-wrapper  -->
	<main class="page-content">
		<div class="container-fluid">
			<div class="jumbotron">
				<h1>Gerenciar Equipamentos</h1> 
				<p>no momento você não possui nenhum equipamento cadastrado! <a href="#">clique aqui</a> para adicionar um</p> 
			</div>
		</div>
	</main>
<?php  }
include_once "../templates/footerLogado.php";
?>