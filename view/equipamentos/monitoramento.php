<?php
include_once "../templates/topoLogado.php";
require_once "../../control/EquipamentoController.class.php";
require_once "../../control/EquipamentoController.class.php";
$equipamentos = new EquipamentoController();
$arr=$equipamentos->getOne($_GET['id']);
$objeto = json_decode($arr);

?>
<main class="page-content">
	
	<div clas="col-sm-12">
		<div class=" "  id="filtro">
			<h1></h1>
			<div  class="row">

				<form class="form-horizontal col-sm-6 " action="" method="post">
					<h1 class="text-center">Filtrar por data</h1>
					<div class="form-group registration-date">
						<p >de: </p>
						<div class="input-group ">
							<button class="far fa-calendar-alt"  style="height: 40px" disabled></button>
							<input class="form-control" name="registration_date" id="date_ini" type="date">
							<button class="far fa-clock" style="height: 40px" disabled></button>
							<input class="form-control" name="registration_time" id="horaIni" type="time">
						</div>
						<label >até:</label>
						<div class="input-group ">
							<button class="far fa-calendar-alt"  style="height: 40px" disabled></button>
							<input class="form-control" name="registration_date" id="date_fim" type="date">
							<button class="far fa-clock"  style="height: 40px" disabled></button>
							<input class="form-control" name="registration_time" id="horaFim" type="time">

						</div>
						<button class="btn btn-info btn-lg col-sm-3" id="btnFiltro" ><i class="fab fa-searchengin"></i></button>
					</div>
				</form>
				<div class="card col-sm-6 ">
					<input type="text"  id= "equipamento" value="<?php echo $objeto->id?>">
					<div class="card-body col-sm-8 col-md-8 ">
						<h5 class="card-title" id="titulo" ></h5>
						<div id="ft">
							<img src="../..<?php echo $objeto->src_img?>"  class="img-responsive rounded ">
						</div>
						<h6 class="card-subtitle mb-2 text-muted" id="mode"><?php echo $objeto->modelo?></h6>
						<p class="card-text" id="descri"><?php echo $objeto->descricao?></p>
						<p>Status: <span> conectado</span></p>
						<div class="col-sm-12 ">
							<select class="custom-select" id="ss">
								<option  value ="<?php echo $value->id?>"><?php echo $objeto->modelo  ?></option>
							</select>
						</div>
					</div>


				</div>
			</div>
			<div class="row">
				<div class="col-sm-5"></div>
			</div>
		</div>
		<hr>
		<canvas   id="myChart" width="600" height="180" class="container"></canvas>
		<hr>

		<div class="container-fluid col-sm-11" id="exportar"  >
			<h5>Exportar como: <h5>
				<div class="btn-group" role="group" aria-label="Basic example" >
					<button type="button" class="btn btn-secondary btn-lg exportar" data-toggle="tooltip" data-placement="top" title="Baixar como pdf">
						<i class="far fa-file-pdf"></i>
					</button>
					<button type="button" class="btn btn-secondary btn-lg exportar" data-toggle="tooltip" data-placement="top" title="Baixar como excel">
						<i class="far fa-file-excel"></i>
					</button>
					<button type="button" class="btn btn-secondary btn-lg exportar" data-toggle="tooltip" data-placement="top" title="Baixar como png"><i class="fas fa-images"></i></button>
				</div>
			</div>
		</div>		
	</main>
	<script type="text/javascript" src="../../assets/js/Chart.min.js"></script>
	<script type="text/javascript" src="../../assets/js/graficos.js"></script>
	<style type="text/css">
	canvas{
		margin-top: 20px;

	}

	#exportar{
		height: 70px;
		
		border-radius: 6px;
	}
	h1{
		color:rgba(69,69,69,0.7);
	}
	#filtro{
		background: rgba(200,200,200,0.5);
	}
	#btnFiltro, #btnEquip{
		margin: 10px;
		float: right;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){

		$('#myChart').hide();
		$('.exportar').prop('disabled', true);
		
		$('#btnFiltro').click(function(e){
			e.preventDefault();
			var dataHoraIni =  $('#date_ini').val() + " " + $('#horaIni').val();
			var dataHoraFim =  $('#date_fim').val() + " "+ $('#horaFim').val();
			var idEquipamento = $('#equipamento').val();

			$.ajax({
				url: "../../control/ajax/filtroConsumo-ajax.php",
				data:{dataHoraIni:dataHoraIni, dataHoraFim:dataHoraFim, idEquipamento:idEquipamento},
				datatype:"json",
				type:"POST"
			}).done(function(e){
				//console.log("done:"+e);
				
				$sucesso = $.parseJSON(e)['sucesso'];
				if($sucesso){
					$consumo = $.parseJSON(e)['consumo'];
					var dadosConsumo ="";
					var dadosDataHora = [];
					$.each($consumo,function(chave,valor){
						/*	retorno+= valor['corrente_segundo']+";"+valor['data_hora'] +"\n";*/
						dadosConsumo+= Math.round(valor['corrente_segundo'])+ ",";
						dadosDataHora[chave] = valor['data_hora'].split(" ")[1] ;

					});						
					/*var data = dadosDataHora.split(" ");*/
					dadosConsumo= dadosConsumo.slice(0,-1);
					console.log(dadosDataHora);	
					mostraGrafico(dadosConsumo);					

				}
			}).fail(function(){
				console.log("erro");
			});
		});
	});
	function mostraGrafico(){
		$('#myChart').fadeIn();
		var ctx = $("#myChart");
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["00:00", "02:00", "04:00","06:00", "08:00","10:00", "12:00","14:00", "16:00","18:00", "20:00","22:00", "23:59"],
				datasets: [{
					label: 'Registro do dia 07/11/2018',
					data: [0, 6, 15,12, 3,5, 18,14, 10,19, 11,5,10],
					backgroundColor: [
					'rgba(69, 69, 69, 0.2)'

					],
					borderColor: [
					'rgba(0,0,0,1)'

					],
					borderWidth: 1
				}
				]
			},
			options:{
				title:{
					display:true,
					fontSize:20,
					text: "Grafico de consumo "
				},
				labels:{
					fontStyle:"bold"
				}
			}	
		});
	}
</script>


<?php include_once "../templates/footerLogado.php"; ?>
