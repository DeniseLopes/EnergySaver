<?php include_once "templates/topo.php";?>
<div class="container-fluid formCad">
	<div class="row centered-form">
		<div class="col-xs-12 col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Cadasdtre-se <small>É gratis!</small></h3>
				</div>
				<div class="panel-body">
					<form role="form" id="formCad">
						<div id="mensagem" class="alert"><p></p> </div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="first_name" id="nome" class="form-control input-sm" placeholder="First Name">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="last_name" id="sobrenome" class="form-control input-sm" placeholder="Last Name">
								</div>
							</div>
						</div>

						<div class="form-group">
							<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
						</div>

						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password" id="senha" class="form-control input-sm" placeholder="Password">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="cSenha" id="cSenha" class="form-control input-sm" placeholder="Confirm Password">
								</div>
							</div>
						</div>

						<input type="submit" value="Register" id="btnCad" class="btn btn-info btn-block">
						<p class="text-center">Já possui uma conta?<a href="login.php"> clique aqui</a> para entrar</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once "templates/footer.php"?>