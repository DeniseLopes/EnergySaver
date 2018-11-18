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
			<?php foreach ($objeto as  $value) { 
				$tipo="";
				switch ($value->tipo) {
					case 1:
					$tipo = "Computador";
					break;
					case 2:
					$tipo = "Impressora";
					break;
					case 3:
					$tipo = "Geladeira";
					break;
					case 4:
					$tipo = "Transformador";
					break;
					case 5:
					$tipo = "Ar-condicionado";
					break;
					case 6:
					$tipo = "TV";
					break;
					case 7:
					$tipo = "Radio";
					break;
					default:
						# code...
					break;
				}
				?>
				<div class="card col-sm-6 col-md-4">
					<div class="card-body">
						<h5 class="card-title" id="titulo" ><?php echo $tipo?></h5>
						<input type="text" class="idE" name="idEquipamento" value="<?php echo $value->id?>" >
						<img src="../..<?php echo $value->src_img ?>" class="img-responsive rounded mx-auto d-block">
						<h6 class="card-subtitle mb-2 text-muted"><?php echo $value->modelo ?></h6>
						<p class="card-text"><?php echo $value->descricao ?></p>
						<p>Status: <span class=" text-danger"> <?php echo $value->status ?></span></p>
						<div class="btn-group" role="group" aria-label="Basic example" >
							<a type="button" href="monitoramento.php?id=<?php echo $value->id ?>" class="btn btn-secondary btn-lg view" data-toggle="tooltip" data-placement="top" title="ver">
								<i class="fas fa-eye"></i>
							</a>
							<a type="button" class="btn btn-secondary btn-lg edit" data-toggle="modal" data-target="#myModal" data-placement="top" title="editar" id="editar">
								<i class="fas fa-cog"></i>
							</a>
							<a type="button" class="btn btn-secondary btn-lg delete" data-toggle="modal" data-placement="top"  data-target="#exampleModalCenter" title="apagar equipamento">
								<i class="far fa-trash-alt"></i>
							</a>
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
	$('.edit').click(function(){
		var equipamento;
		var tipo;
		var gerenciador;
		div = $(this).parent().parent().parent();
		var idE = div.find("[name='idEquipamento']").val();
		$.ajax({
			type:"POST",
			data:{idE: idE},
			datatype:"json",
			url: "../../control/ajax/GetDataEquipamento-ajax.php" 
		}).done(function(e){
			console.log("done:"+ e);
			$sucesso = $.parseJSON(e)['sucesso'];
			if($sucesso){
				equipamento= $.parseJSON(e)['equipamento'];
				tipo = equipamento.tipo;
				gerenciador = equipamento.gerenciador_id;
				console.log(equipamento.modelo);
				$('#imagemE').attr("src", "../../"+equipamento.src_img);
				$('#imgEquipamento').fadeIn();
				$('#modeloE').val(equipamento.modelo);
				$('#wattsE').val(equipamento.watts_potencia);
				$('#descricaoE').val(equipamento.descricao);

			}else{
				console.log("Erro no done");
			}
		}).fail(function(){
			console.log("erro");
		})
		$.ajax({
			url: "../../control/ajax/teste.php",
			type:"POST",
		}).done(function(data){
			//console.log("done 1:"+data);
			$categorias = $.parseJSON(data);
			var options="";
			$.each($categorias,function(chave,valor){
				if(valor['id'] ==tipo ){
					options+= '<option selected value="'+ valor['id'] + '">'+valor['nome'] +"</option>";
				}else
				options+= '<option value="'+ valor['id'] + '">'+valor['nome'] +"</option>";
				$('#tipo_equipamento').html(options);
				
			});
			//console.log("opções:"+ options);
		}).fail(function(){
			console.log("erro");
		});
		$.ajax({
			url:"../../control/ajax/buscaGerenciadores-ajax.php",
			type:"POST"
		}).done(function(e){
	//	console.log("done:"+ e);
	$gerenciadores = $.parseJSON(e)['gerenciadores'];
	var options="";
	$.each($gerenciadores,function(chave,valor){
		if(valor['id']== gerenciador){
			options+= '<option selected value="'+ valor['id'] + '">'+valor['mac_address'] +"</input>";

		}else
		options+= '<option value="'+ valor['id'] + '">'+valor['mac_address'] +"</input>";
		$('#macG').html(options);

	});
		//console.log("options::"+ options);
	}).fail(function(){
		console.log("fail");
	})
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