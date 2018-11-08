<?php include "templates/topo.php"?>
<div class="container-fluid bg" id="divlogin">
	<div class="row" id="webcoderskull">
		
		<div class="container" >
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3" id="">
					
					<div class="account-wall">
						<h1 class="text-center login-title">Entrar</h1>
						<img class="profile-img" id="imgPerfil" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
						alt="">
						<p class="profile-name">Bhaumik Patel</p>
						<p class="profile-email text-center">example@gmail.com</p>
						<form class="form-signin" id="formBody">
							<div id="mensagem" class="alert"></div>

							<input type="email" class="form-control" placeholder="Email" id="emailL" required >

							<input type="password" class="form-control" placeholder="Password" id="senhaL" >
							<input class="btn btn-lg btn-primary btn-block" type="submit" id="btnLogin" value="Proximo">
						
							<p><i>Não possui cadastro?<a href="cadastro.php"> clique aqui</a><span class="">  para se cadastrar</span></i></p>
						</form>
						<a href="login.php" class="text-center " id="different_account">Entre com uma conta diferente</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
#divlogin{
	margin-top: -10px;
}
</style>

<?php include "templates/footer.php";?>