<?php include_once "templates/topo.php";?>
<div class="container-fluid formCad">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-12"></div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<!-- start Form -->
			<form class="form-container">
				<div class="alert " id="mensagem"></div>
				<h1 class="text-center">Cadastro</h1>
				<div class="form-group">
					<label for="nome">Nome </label>
					<input type="text" class="form-control" id="nome" placeholder="Entre com o seu nome">
				</div>
				<div class="form-group">
					<label for="email">Email </label>
					<input type="email" class="form-control" id="email" placeholder="Entre com o seu email">
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" class="form-control" id="senha" placeholder="entre com sua senha">
				</div>
					<div class="form-group">
					<label for="cSenha">Senha</label>
					<input type="password" class="form-control" id="cSenha" placeholder="Confirme sua senha">
				</div>


				<button type="submit" id="btnCad" class="btn btn-success btn-block">Entrar</button>
				<p>Já possui uma conta?<a href="login.php"> clique aqui</a> para entrar</p>
			</form>
			<!-- end form-->
		</div>
		


		<div class="col-md-3 col-sm-3 col-xs-12"></div>
		
	</div>
</div>
<?php include_once "templates/footer.php"?>