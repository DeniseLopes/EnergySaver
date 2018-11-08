<?php include_once "../templates/topoLogado.php";
require_once "../../control/EquipamentoController.class.php";
$equipamentos = new EquipamentoController();
$arr=$equipamentos->getAll();
$objeto = json_decode($arr);

?>
<main class="page-content">
	<div class="jumbotron text-center">
		<div class="page-header">
			<h2 class="alert alert-dark ">Equipamentos Cadastrados</h2>
		</div>
		<div class="row ">
			<?php foreach ($objeto as  $value) { ?>
				<div class="card col-sm-6 col-md-4">
					<div class="card-body">
						<h5 class="card-title" id="titulo" ></h5>
						<img src="../..<?php echo $value->src_img ?>" class="img-responsive rounded mx-auto d-block">
						<h6 class="card-subtitle mb-2 text-muted"><?php echo $value->modelo ?></h6>
						<p class="card-text"><?php echo $value->descricao ?></p>
						<p>Status: <span> <?php echo $value->status ?></span></p>
						<a href="monitoramento.php?id=<?php echo $value->id ?>" class="card-link">Ver</a>
					</div>
				</div>
			<?php } ?>
			<div class="card col-sm-6 col-md-4">
				<div class="card-body">
					<h5 class="card-title">Adicionar Equipamento</h5>
					<a href="#" data-toggle="modal" id="ModalEquipamento" data-target="#modal"><img src="../../assets/imgs/add-equip.png" class="img-responsive" id="addIcon"></a>
				</div>
			</div>
		</div>
		
	</div>
</main>
<style type="text/css">
#addIcon{
	margin-top: 40px;
	height: 100px;
}
h2{
	font-family: "Comic-sans";
}
</style>

</script>

<?php include_once "../templates/footerLogado.php";?>