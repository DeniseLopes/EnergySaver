<?php
include_once "../templates/topoLogado.php";
require_once "../../control/EquipamentoController.class.php";
require_once "../../control/EquipamentoController.class.php";
$equipamentos = new EquipamentoController();
$arr=$equipamentos->getOne($_GET['id']);
$objeto = json_decode($arr);

foreach ($objeto as $key => $value) {
}


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
							<input class="form-control" name="registration_date" id="registration-date" type="date">
							<button class="far fa-clock" style="height: 40px" disabled></button>
							<input class="form-control" name="registration_time" id="registration-time" type="time">
						</div>
						<label >até:</label>
						<div class="input-group ">
							<button class="far fa-calendar-alt"  style="height: 40px" disabled></button>
							<input class="form-control" name="registration_date" id="registration-date" type="date">
							<button class="far fa-clock" style="height: 40px" disabled></button>
							<input class="form-control" name="registration_time" id="registration-time" type="time">

						</div>
						<button class="btn btn-info btn-lg col-sm-3" id="btnFiltro" ><i class="fab fa-searchengin"></i></button>
					</div>
				</form>
				<div class="card col-sm-6 ">
					<div class="card-body col-sm-8 col-md-8 ">
						<h5 class="card-title" id="titulo" ></h5>
						<img src="../..<?php echo $value->src_img?>" class="img-responsive rounded ">
						<h6 class="card-subtitle mb-2 text-muted"><?php echo $value->modelo?></h6>
						<p class="card-text"><?php echo $value->descricao?></p>
						<p>Status: <span> conectado</span></p>
						<div class="col-sm-12 ">
							<select class="custom-select">
								<option selected>Selecione</option>
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
		<canvas id="myChart" width="600" height="180" class="container"></canvas>
		<hr>

		<div class="container-fluid col-sm-11" id="exportar">
			<h5>Exportar como: <h5>
				<div class="btn-group" role="group" aria-label="Basic example">
					<button type="button" class="btn btn-secondary btn-lg" data-toggle="tooltip" data-placement="top" title="Baixar como pdf">
						<i class="far fa-file-pdf"></i>
					</button>
					<button type="button" class="btn btn-secondary btn-lg" data-toggle="tooltip" data-placement="top" title="Baixar como excel">
						<i class="far fa-file-excel"></i>
					</button>
					<button type="button" class="btn btn-secondary btn-lg" data-toggle="tooltip" data-placement="top" title="Baixar como png"><i class="fas fa-images"></i></button>
				</div>
			</div>
		</div>
		<select>
			<option selected value=-1> selecione</option>
			<option value=1> opção 1</option>

			<option> opção 2</option>

			<option> opção 3</option>

			<option> opção 4</option>

			<option> opção 5</option>
		</select>
		
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



<?php include_once "../templates/footerLogado.php"; ?>
