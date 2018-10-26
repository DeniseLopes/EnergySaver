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
				<input type="text" class="form-control" id="nick" placeholder=" ex: John_sk8">
			</div>
			<div class="form-group">
				<label for="email">Email </label>
				<input type="email" class="form-control" id="email" value=" <?php echo $_SESSION['email']?>">
			</div>
			<div class="form-group">
				<label for="celular">Celular </label>
				<input type="tel" class="form-control" id="celular">
			</div>
			<div class="form-group">
				<label for="cpf">CPF </label>
				<input type="text" class="form-control" id="cpf" >
			</div>
			<div class="form-group">
				<label for="dt_nasc">Data de nascimento </label>
				<input type="date" class="form-control" id="dt_nasc" >
			</div>
			<form enctype="multipart/form-data" method="POST">
				<div class="form-group">
					<label for="image">adicionar imagem</label>

					<input type="file" class="form-control" id="imagem" value="" >
				</div>

				<button type="submit" id="btnAlterar" class="btn btn-info btn-block">Alterar</button>
			</form>

			
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
<script type="text/javascript">
	
		$('#btnAlterar').click(function(e){
			var nome = $('#nome').val();
			var nick = $('#nick').val();
			var email = $('#email').val();
			var dt_nasc = $('#dt_nasc').val();
			var	celular = $('#celular').val();	
			var cpf= $('#cpf');
			if(nome== ""){
				$('#erros p').html("O campo nome não pode ser vazio");
				$('#erros').addClass(" alert-warning");
				$('#erros').show();
			}else if(nome.length <3){
				$('#erros p').html("O campo <b>nome</b> deve possuir mais de 3 caracteres");
				$('#erros').addClass(" alert-warning");
				$('#erros').show();
			}
			if(nick==""){
				$('#erros p').html("O campo <b>nick</b> não pode ser vazio");
				$('#erros').addClass(" alert-warning");
				$('#erros').show();


			}if(email==""){
				$('#erros p').html("O campo <b>email</b> não pode ser vazio");
				$('#erros').addClass(" alert-warning");
				$('#erros').show();

			}
			if(nome.length >3 && email!="" && nick!=""){
				console.log("form ok");
					$.ajax({
					url:"../../control/ajax/atualizarUsuario-ajax.php",
					type:"POST",
					dataType:"json",
					data: { nome:nome, email: email, nick:nick, cpf:cpf, dt_nasc: dt_nasc}
				}).done(function(data){
					console.log(data);

				}).fail(function(data){
						console.log("erro:"+data);
				});
			}

		});

</script>