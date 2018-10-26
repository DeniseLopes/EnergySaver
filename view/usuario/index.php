<?php include"../templates/topoLogado.php";
if(isset($_SESSION['logado'])!="sim"){
echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php' >";
}else{
?>

<!-- sidebar-wrapper  -->
<main class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="form-group col-md-12">
				<h2>Sidebar template</h2>
				<p>This is a responsive sidebar template with dropdown menu based on bootstrap 4 framework.</p>
			</div>
		</div>
		<hr>  
		<div class="row">
			<div class="form-group col-md-12">                    
				<div> You can find the latest update on <a href="#"  > Github</a></div>
			</div>
		</div>
		<hr> 

		</div>
	</main>
	<!-- page-content" -->




<!-- /#wrapper -->
<?php  }
include_once "../templates/footerLogado.php";
?>