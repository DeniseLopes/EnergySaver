<?php include "templates/topo.php"?>
<div class="container-fluid bg">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-12"></div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<!-- start Form -->
			<form class="form-container">				
				<div class="alert " id="mensagem"></div>
				<h1 class="text-center">login</h1>
				<div class="form-group">
					<label for="emailL">Email </label>
					<input type="email" class="form-control" id="emailL" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="senhaL">Senha</label>
					<input type="password" class="form-control" id="senhaL" placeholder="Password">
				</div>

			
				<button type="submit" class="btn btn-success btn-block" id="btnLogin">Entrar</button>
				<p>Ainda não tem cadastro?<a href="cadastro.php"> clique aqui</a> para se cadastrar</p>
			</form>
			<!-- end form-->
		</div>
		


		<div class="col-md-3 col-sm-3 col-xs-12"></div>
		
	</div>
</div>
	<style type="text/css">
		
	

	</style>
<?php include "templates/footer.php";?>