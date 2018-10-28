<?php include_once "../templates/topoLogado.php";?>
<main class="page-content">
	<div class="col-md-8 col-sm-8 col-xs-12 offset-md-2">
		<!-- start Form -->
		<form class="form-container" id="formAlter">
			<div class="alert " id="mensagem"></div>
			<h1 class="text-center">Alterações</h1>
			<div id="erros" class="alert"><p></p> </div>
			<div class="form-group">
				<label for="nome">Nome </label>
				<input type="text" class="form-control" id="nome" value=" <?php echo $_SESSION['nome']?> ">

			</div>
			<div class="form-group">
				<label for="nick">Nome de usuario </label>
				<input type="text" class="form-control" id="nick" placeholder=" ex: John_sk8" value='<?php echo (isset($_SESSION['nick'])?$_SESSION['nick']: "") ?>'>
			</div>
			<div class="form-group">
				<label for="email">Email </label>
				<input type="email" class="form-control" id="emailAlter" value=" <?php echo $_SESSION['email']?>">
				<p class="alert" id="msgEmail"></p>
			</div>
			<div class="form-group">
				<label for="celular">Celular </label>
				<input type="tel" class="form-control" id="celular" value="">
			</div>
			<div class="form-group">
				<label for="cpf">CPF </label>
				<input type="text" class="form-control" id="cpf" value='<?php echo (isset($_SESSION['cpf'])?$_SESSION['cpf']: "") ?>' >
			</div>
			<div class="form-group">
				<label for="dt_nasc">Data de nascimento </label>
				<input type="date" class="form-control" id="dt_nasc" value='<?php echo (isset($_SESSION['dt_nasc'])?$_SESSION['dt_nasc']: "") ?>' >
			</div>
			<div class="form-group">
				<label for="image">adicionar imagem</label>

				<input type="file" class="form-control" id="imagem" value="" >
				<p class="alert "></p>
			</div>


			<button type="submit" id="btnAlterar" class="btn btn-info btn-block">Alterar</button>
			

			
		</form>
		<!-- end form-->

	</div>
</main>
<!-- page-content" -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous"></script>
<script type="text/javascript" src="../../assets/js/script.js"></script>
<?php include_once "../templates/footer.php";?>
