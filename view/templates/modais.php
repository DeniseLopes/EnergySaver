	<!--Modal cadastro equipamento -->

	<div class="modal fade" id="myModal">
		<div class="modal-dialog ">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title text-center"><i class="fas fa-edit"></i>Configuração de equipamentos</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form id="altEq">
						<div id="erroE">
							<p class="alert"></p>
						</div>
						<div id="imgEquipamento">
								<img  src=""  id="imagemE" class="rounded img-responsive mx-auto d-block " alt="..." style='max-height: 150px'>
							</div>
						<div class="form-row">
							
							<div class="form-group col-sm-12 col-md-12">
								<label for ="tipo_equipamento">Tipo </label>
								<select id="tipo_equipamento" class="form-control" >
								</select>
							</div>
							<div class="form-group col-sm-5 col-md-5">
								<label for="modeloE">Modelo</label>
								<input type="text" name="" class="form-control" id="modeloE">						
							</div>
							<div class="form-group col-md-2 col-sm-2">
								<label for="wattsE">Potencia</label>
								<input type="number" name="" class="form-control" id="wattsE">
							</div>
							<div class="form-group col-sm-5 col-md-5">
								<label for="macG">Nº Mac Gerenciador</label>
								<select id ="macG" class="form-control">
								</select>
							</div>
							<div class="form-group col-sm-12 col-md-12" >
								<label for="descricaoE"></label>
								<textarea class="form-control" id="descricaoE"></textarea>
							</div>
						</div>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-success" id="updateE" ><i class="fas fa-sync-alt"></i>Atualizar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>Fechar</button>
				</div>

			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cadastrar Equipamento</h5>
				<button type="button" id="" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div id="mensagemE"><p class="alert "></p></div>

			<div class="modal-body">
				<div id="imgIconCad">
					<img  src=""  id="image" class="rounded mx-auto d-block" alt="..." style='max-height: 150px'>
				</div>
				<form id="cadEquipamento">
					<div class="form-group">
						<label for ="tipoEquipamento">Tipo </label>
						<select id="tipoEquipamento" class="form-control">

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
					<div class="form-group">
						<label for ="macGerenciador">Mac Gerenciador </label>
						<select id="macGerenciador" class="form-control">
							<!-- <option selected>Escolha</option>	-->

						</select>
					</div>
					<div class="form-group">
						<label for="message-text" class="col-form-label">Descrição:</label>
						<textarea class="form-control" id="descricao"></textarea>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-success" id="cadastrarE" >Salvar </button>
			</div>
		</div>
	</div>
</div>
<!-- Fim Modal -->


<!--  Modal Gerenciador -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Adicionar Gerenciador</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div id="msgCadGerenciador" class= "text-center alert alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p></p></div>
					<div class="form-group">
						<label for="mac" class="col-form-label">Endereço MAC:</label>
						<input type="text" class="form-control" id="mac">
					</div>
					<div class="form-group">
						<label for="ip" class="col-form-label" disabled>IP:</label>
						<input type="text" class="form-control" id="ip" >
					</div>

					<div class="form-group">
						<label for="message-text" class="col-form-label">Descrição:</label>
						<textarea class="form-control" id="desc"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-success" id="cadGerenciador">Cadastrar</button>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="../../assets/css/estiloModais.css">
<!-- Fim Modal -->
<script type="text/javascript" src="../../assets/js/jquery.js"></script>