	<!--Modal cadastro equipamento -->

	
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
						<div id="msgCadGerenciador" class= "text-center alert"></div>
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
	
	<!-- Fim Modal -->