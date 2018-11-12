s<?php include"../templates/topoLogado.php";
require_once "../../control/EquipamentoController.class.php";
require_once "../../control/Traffic.class.php";
$equipamentos = new EquipamentoController();
new Traffic();
$arr=$equipamentos->getAll();
$objeto = json_decode($arr);


if(isset($_SESSION['logado'])!="sim"){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php' >";
}else{?>

	<!-- sidebar-wrapper  -->
	<main class="page-content">
		
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body p-0">
							<div class="row p-5">
								<div class="col-md-6">
									<img src="../../assets/imgs/fav2.png">
								</div>

								<div class="col-md-6 text-right">
									<p class="font-weight-bold mb-1">Invoice #550</p>
									<p class="text-muted">Due to: 4 Dec, 2019</p>
								</div>
							</div>

							<hr class="my-5">

							<div class="row pb-5 p-5">
								<div class="col-md-6">
									<p class="font-weight-bold mb-4">Client Information</p>
									<p class="mb-1">John Doe, Mrs Emma Downson</p>
									<p>Acme Inc</p>
									<p class="mb-1">Berlin, Germany</p>
									<p class="mb-1">6781 45P</p>
								</div>

								<div class="col-md-6 text-right">
									<p class="font-weight-bold mb-4">Payment Details</p>
									<p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
									<p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
									<p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
									<p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
								</div>
							</div>



							<!-- -->


						</div>
					</div>
				</div>
			</div>

			<div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>

		</div>



	</main>
	<style type="text/css">
	
</style>


<?php  }
include_once "../templates/footerLogado.php";
?>