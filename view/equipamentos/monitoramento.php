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
							<button class="far fa-calendar-alt "  style="height: 40px" disabled></button>
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
					<div class="card-body col-sm-8 col-md-8 text-center ">
						<h5 class="card-title" id="titulo" ></h5>
						<div id="ft" class="row">
							<img src="../..<?php echo $objeto->src_img?>"  class="img-responsive rounded mx-auto d-block ">
						</div>
						<h6 class="card-subtitle mb-2 text-muted" id="mode"><?php echo $objeto->modelo?></h6>
						<p class="card-text" id="descri"><?php echo $objeto->descricao?></p>
						<p>Status: <span> conectado</span></p>

					</div>


				</div>
			</div>
			<div class="row">
				<div class="col-sm-5"></div>
			</div>
		</div>
		<div id="divCanvas">
			<hr>
			
			
			<canvas   id="myChart" height="400" class="container"></canvas>
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
			<hr>


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
		var url_base64jp = document.getElementById("myChart").toDataURL("image/jpg");

		$('#divCanvas').hide();
		$('.exportar').prop('disabled', true);

		$('#btnFiltro').click(function(e){
			e.preventDefault();
			var dataHoraIni =  $('#date_ini').val() + " " + $('#horaIni').val();
			var dataHoraFim =  $('#date_fim').val() + " "+ $('#horaFim').val();
			var idEquipamento = $('#equipamento').val();
			var titulo = "Monitoramento do dia "+ (dataHoraIni.split(" ")[0]).split("-").reverse().join("/") + " ao dia " +dataHoraFim.split(" ")[0].split("-").reverse().join("/");
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
					var dados = {
						dadosConsumo :[],
						dadosDataHora :[]
					}
					$.each($consumo,function(chave,valor){
						/*	retorno+= valor['corrente_segundo']+";"+valor['data_hora'] +"\n";*/
						dados.dadosConsumo.push(Math.round(valor['corrente_segundo']));
						dados.dadosDataHora.push(valor['data_hora'].split(" ")[1].split(" ")[0]);
					});						

					/*var data = dadosDataHora.split(" ");*/
					console.log(dados);	
					mostraGrafico(dados.dadosConsumo, dados.dadosDataHora, titulo);
									

				}
			}).fail(function(){
				console.log("erro");
			});
		});
	});/*
	function addData(chart,data){
		chart.data.labels.push(data); 
		chart.data.datasets.forEach((dataset)=>{
			dataset.data.push(data);
		});
		chart.update();
	}*/
	function mostraGrafico(consumo,datahora,titulo){
		$('#divCanvas').fadeIn();
		$('.exportar').prop('disabled', false);
		var ctx = $("#myChart");
		var data  = {
			labels:datahora,
			datasets:[
			{
				label: "Watts registrado",
				data: consumo,
				backgroundColor:'rgba(69,69,69,0.3)',
				borderColor:"#333",
				birderWidth:1,
				lineTension:0
			}
			]
		}
		var options = {
			title:{
				display:true,
				position:"top",
				text: titulo,
				fontSize:12,
				fontColor:"#444"
			},
			legend :{
				display:true
			}
		};
		var chart = new Chart(ctx,{
			type:"line",
			data:data,
			options:options
		}); 
	}
</script>


<?php include_once "../templates/footerLogado.php"; ?>
