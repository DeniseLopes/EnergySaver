<?php include_once "../templates/topoLogado.php";
require_once "../../control/GerenciadorController.class.php";
require_once "../../model/GerenciadorModel.class.php";
$modelo = new GerenciadorModel();
$gerenciador = new GerenciadorController($modelo);
$data = json_decode($gerenciador->getGerenciadores());


?>
<main class="page-content">
	<div class="container">
		<table class="table table-striped text-center">
			<thead class="thead-dark">
				<tr>
					<th>Id:</th>
					<th>Mac:</th>
					<th>IP:</th>
					<th>Descrição:</th>					
					<th colspan="2">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($data as  $value) {?>
					<tr>
						<td class="tdid"><?php echo $value->id ?></td>
						<td><?php echo $value->mac_address ?></td>
						<td><?php echo $value->ip ?></td>
						<td><?php echo $value->descricao?></td>
						<td><a class="btn-lg btn-info alt"  href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-edit">Alterar</a></td>
							<td><a class="btn-lg btn-danger del" href="#" data-toggle="modal" data-placement="top"  data-target="#modalCenter"><i class="far fa-trash-alt">Excluir</a></td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</main>

		<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
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
				<p class="text-left"> Você tem certeza que deseja excluir este gerenciador? Isto removerá permanentemente o mesmo do sistema</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-ban"></i>Cancelar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="deletarG" ><i class="far fa-trash-alt"></i>Apagar</button>
			</div>
		</div>
	</div>
</div>
		<script type="text/javascript">
			var id ="";
			var mac;
			var desc;
			var ip;
			$(".alt").click(function(){
				id = $(this).parent().parent().find(".tdid").text();
				$.ajax({
					url:"../../control/ajax/dadosGerenciado-ajax.php",
					type:"POST",
					datatype:"json",
					data:{id:id}
				}).done(function(e){
					// console.log("feito:"+ e);
					$sucesso = $.parseJSON(e)['sucesso'];
					if ($sucesso){
						var gerenciador = $.parseJSON(e)['gerenciadores'];
						mac = gerenciador.mac_address;
						ip = gerenciador.ip;
						desc = gerenciador.descricao;
						$('#macE').val(gerenciador.mac_address);
						$('#ipE').val(gerenciador.ip);
						$('#descE').val(gerenciador.descricao);

					}

				}).fail(function(){
					console.log("Erro");

				});
			});
			$('.del').click(function(){
				id = $(this).parent().parent().find(".tdid").text();
				div =$(this).parent().parent();
			});
			$('#deletarG').click(function(data){
				$.ajax({
					url:"../../control/ajax/deleteGerenciador-ajax.php",
					data:{id:id},
					datatype:"json",
					type:"POST"
				}).done(function(e){
					console.log("feito:"+e);
					div.fadeOut();
				}).fail(function(){

				});
			})

			$('#altGerenciador').click(function(){
				ip = $('#ipE').val();
				mac = $('#macE').val();
				desc = $('#descE').val();
				$("#msgAltGerenciador").removeClass("alert-success");
				var mac_regex = /^([0-9A-F]{2}[:-]){5}[0-9A-F]{2}$/i;
				var ip_regex = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
				ip = $('#ipE').val();
				if(!ip_regex.test(ip)){
					$('#msgAltGerenciador').addClass("alert-warning");
					$("#ipE").focus();
					$("#msgAltGerenciador p").html("O <b>IP </b> informado não é um ip válido");
					$("#msgAltGerenciador").fadeIn();
				}
				else if(!mac_regex.test(mac)){
					$('#msgAltGerenciador').addClass("alert-warning");
					$("#macE").focus();
					$("#msgAltGerenciador p").html("O endereço <b>mac </b> informado não é válido");
					$("#msgAltGerenciador").fadeIn();

				}else{
					$("#msgAltGerenciador").removeClass("alert-warning");
					$('#msgAltGerenciador').fadeOut();
					$.ajax({
						url:"../../control/ajax/updateGerenciador-ajax.php",
						data:{ip:ip, mac:mac, desc:desc, id:id},
						datatype: "json",
						type:"POST"
					}).done(function(data){
						console.log("done:"+data);
						$sucesso = $.parseJSON(data)['sucesso'];
						$mensagem = $.parseJSON(data)['mensagem'];
						if($sucesso)
							$('#msgAltGerenciador').addClass("alert-success");
						else
							$('#msgAltGerenciador').addClass("alert-danger");		
						
						$('#msgAltGerenciador p').html($mensagem);
						window.setTimeout("location.href='listar.php'",1500);

					}).fail(function(){
						$('#msgAltGerenciador').addClass("alert-danger");
						$('#msgAltGerenciador p').html("falha ao se conectar com a base. Contate o suporte técnico");

					}).always(function(){
						$('#msgAltGerenciador').fadeIn("slow");

					});
				}
			});


		</script>
<?php include_once "../templates/footerLogado.php";?>