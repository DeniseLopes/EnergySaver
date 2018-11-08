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
	.main-container{
    
background: #d53369; /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #d53369 , #cbad6d); /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #d53369 , #cbad6d); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        
    }
.highlight  {
    width: 600px;
    color: white;
    background: rgba(0, 0, 0, 0.26);
    border-radius: 10px;
    padding: 3%;
    
	}
    
.highlight img {
    
    float: left;
    width: 100px;
    height: 100px; 
    margin: 10px;
    }
    
.highlight ul {
    list-style-image: url('http://icons.iconarchive.com/icons/yusuke-kamiyamane/fugue/16/tick-small-icon.png');
    margin-left: 1%;
    float: left; 
    clear: right
    }
    
.highlight button {
   margin-left: 1%;
    float: right;
    }

.highlight h1,h2,h3,h4,h5,h6 {
    padding-bottom: 2%;
  border-bottom: 2px dashed rgba(255, 255, 255, 0.41);
    font-size:20px;
    text-align : center;
    text-transform: uppercase;
    }
    
.highlight p {
    text-align: justify;
    }
</style>

<?php  }
include_once "../templates/footerLogado.php";
?>