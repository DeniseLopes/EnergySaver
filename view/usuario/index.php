<?php include"../templates/topoLogado.php";


if(isset($_SESSION['logado'])!="sim"){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php' >";
}else{

	?>

	<!-- sidebar-wrapper  -->
	<main class="page-content">
		<div class="jumbotron">			
			<h1 class="text-center"> Meus equipamentos</h1>
			<div class=" row">
				
				<p id="semEquipamento">no momento você não possui nenhum equipamento cadastrado! <a href="#">clique aqui</a> para adicionar </p> 

				<div class="card col-sm-6 col-md-4">
					<div class="card-body">
						<h5 class="card-title">Computador</h5>
						<img src="../../assets/imgs/computador-icon.png" class="img-responsive rounded mx-auto d-block">
						<h6 class="card-subtitle mb-2 text-muted">ACCEPT DTH110DG</h6>
						<p class="card-text">descrição sobre o equipamento com no máximo 200 caracteres com informações adicionais.</p>
						<p>Status: <span> Desligado</span></p>
						<a href="http://websitedesigntamilnadu.com" class="card-link">Ver</a>
					</div>
				</div>
				<div class="card col-sm-6 col-md-4">
					<div class="card-body">
						<h5 class="card-title">Impressora</h5>
						<img src="../../assets/imgs/impressora-icon.png" class="img-responsive rounded mx-auto d-block">
						<h6 class="card-subtitle mb-2 text-muted">HP laserJet 5100</h6>
						<p class="card-text">descrição sobre o equipamento com no máximo 200 caracteres com informações adicionais.</p>
						<p>Status: <span> Ligado</span></p>
						<a href="#" class="card-link">Ver</a>

					</div>
				</div>
				<div class="card col-sm-6 col-md-4">
					<div class="card-body">
						<h5 class="card-title">TV</h5>
						<img src="../../assets/imgs/tv.png" class="img-responsive rounded mx-auto d-block">
						<h6 class="card-subtitle mb-2 text-muted">Sansung Smarth SUHD</h6>
						<p class="card-text">descrição sobre o equipamento com no máximo 200 caracteres com informações adicionais.</p>
						<p>Status:<span> Desconectado</span></p>
						<a href="#" class="card-link">Ver</a>

					</div>
				</div>
				<div class="card col-sm-6 col-md-4">
					<div class="card-body">
						<h5 class="card-title">Adicionar Equipamento</h5>
						<a href="#" data-toggle="modal" id="ModalEquipamento" data-target="#modal"><img src="../../assets/imgs/add-equip.png" class="img-responsive rounded mx-auto d-block"></a>


					</div>
				</div>




			</div>
		</div>

	</main>
	<!--Modal -->

	
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cadastrar Equipamento</h5>
					<button type="button" id="" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<div id="imgIconCad">
						<img  src=""  id="image" class="rounded mx-auto d-block" alt="..." style='max-height: 150px'>
					</div>
					<form id="cadEquipamento">
						<div class="form-group">
							<label for ="tipoEquipamento">Tipo </label>
							<select id="tipoEquipamento" class="form-control">
								<option selected>Escolha</option>

								
							</select>
						</div>
						<div class="form-group">
							<label for="modelo">Modelo </label>
							<input type="text" class="form-control " id="modelo">
						</div>
						<div class="form-group">
							<label for="watts">Potencia</label>
							<input type="number" class="form-control " placeholder="watts de potência do equipamento" id="watts">
						</div>

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-success" >Salvar </button>
				</div>
			</div>
			<!-- FIM MODAL -->
			<script type="text/javascript">
				$('#ModalEquipamento').click(function(){


					$.ajax({
						url: "../../control/ajax/buscaTipoEquipamentos-ajax.php",
						type:"POST"
					}).done(function(e){
						/*console.log("OK:"+ e);*/


						$categorias = $.parseJSON(e)['a'];

						var categorias="<option value='-1' selected>Selecione</option>";
						$.each($categorias,function(chave,valor){
							categorias+= '<option value="'+ valor['id'] + '">'+valor['nome'] +"</input>";
							$('#tipoEquipamento').html(categorias);

						});
						console.log(categorias);

					}).fail(function(){
						console.log("erro");
					});
				});
				$('#tipoEquipamento').change(function(e){
					$('#imgIconCad').hide();

					
					var opcao = $(this).val();
					switch(opcao){
						case "1":
						$('#imgIconCad img').attr("src", "../../assets/imgs/computador-icon.png");	
						$('#imgIconCad').fadeIn("slow");
						break;
						case "2" :
						$('#imgIconCad img').attr("src", "../../assets/imgs/impressora-icon.png");
						$('#imgIconCad').fadeIn("slow");
						break;
						case "3" :
						$('#imgIconCad img').attr("src", "../../assets/imgs/geladeira-icon.png");
						$('#imgIconCad').fadeIn("slow");
						break;
						case "4" :
						$('#imgIconCad img').attr("src", "../../assets/imgs/transformador-icon.png");
						$('#imgIconCad').fadeIn("slow");
						break;
						case "5" :
						$('#imgIconCad img').attr("src", "../../assets/imgs/ar-condicionado-icon.png");
						$('#imgIconCad').fadeIn("slow");
						break;
						case "6" :
						$('#imgIconCad img').attr("src", "../../assets/imgs/tv-icon.png");
						$('#imgIconCad').fadeIn("slow");
						break;
						case "7" :
						$('#imgIconCad img').attr("src", "../../assets/imgs/radio	-icon.png");
						$('#imgIconCad').fadeIn("slow");
						break;
						case "-1":
						$('#imgIconCad').hide();

					}
					

				});
			</script>
		<?php  }
		include_once "../templates/footerLogado.php";
		?>