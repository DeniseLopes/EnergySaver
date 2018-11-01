s<?php include"../templates/topoLogado.php";


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



	
<?php  }
include_once "../templates/footerLogado.php";
?>