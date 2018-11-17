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
						<h5 class="card-title" id="titulo" >...</h5>
						<input type="text" class="idE" name="idEquipamento" value="<?php echo $value->id?>" >
						<img src="../..<?php echo $value->src_img ?>" class="img-responsive rounded mx-auto d-block">
						<h6 class="card-subtitle mb-2 text-muted"><?php echo $value->modelo ?></h6>
						<p class="card-text"><?php echo $value->descricao ?></p>
						<p>Status: <span> <?php echo $value->status ?></span></p>
						<div class="btn-group" role="group" aria-label="Basic example" >
							<a type="button" href="monitoramento.php?id=<?php echo $value->id ?>" class="btn btn-secondary btn-lg view" data-toggle="tooltip" data-placement="top" title="ver">
								<i class="fas fa-eye"></i>
							</a>
							<button type="button" class="btn btn-secondary btn-lg edit" data-toggle="tooltip" data-placement="top" title="editar">
								<i class="fas fa-cog"></i>
							</button>
							<button type="button" class="btn btn-secondary btn-lg delete" data-toggle="modal" data-placement="top"  data-target="#exampleModalCenter" title="apagar equipamento">
								<i class="far fa-trash-alt"></i>
							</button>
						</div>
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
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header ">
				<h5 class="modal-title text-center modalTitulo" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle " ></i>Apagar
				?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body ">
				<p class="text-left"> Você tem certeza que deseja excluir este equipamento? Isto removera permanentemente o equipamento do sistema</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="deletarE" ><i class="far fa-trash-alt"></i>Apagar</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var div = "";
		$('.idE').hide();
		$('.delete').click(function(){
			 div = $(this).parent().parent().parent();
			 var idE = div.find("[name='idEquipamento']").val();
	
			 console.log("id:"+idE);
			console.log(div);

			$('#deletarE').click(function(){
				//div.fadeOut("slow");
				$.ajax({
						url: "../../control/ajax/deletarEquipamento-ajax.php",
						type: "POST",
						data:{idE: idE},
						datatype: "json"
				}).done(function(e){
					console.log("ok:"+e);
					div.fadeOut();


				}).fail(function(){
					console.log("Erro");
				})

			})
			//div.fadeOut("slow");

		});

	});
</script>
<style type="text/css">
#addIcon{
	margin-top: 40px;
	height: 100px;
}
.fa-exclamation-triangle{
	margin:5px;
}
h2{
	font-family: "Comic-sans";
}
.modalTitulo{
	margin-left:30%;
}
</style>



<?php include_once "../templates/footerLogado.php";?>