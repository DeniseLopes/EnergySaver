<?php include_once "../templates/topoLogado.php";?>
<main class="page-content">
	<div class="col-md-8 col-sm-8 col-xs-12 offset-md-2 offset-xm-2 offset-sm-2">

		<form id="formAlter">
			<div id="erros" class="alert"><p></p> </div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nome">Nome</label>
					<input type="email" class="form-control" id="nome" placeholder="Nome" value="<?php echo trim($_SESSION['nome'])?> ">
				</div>
				<div class="form-group col-md-6">
					<label for="nome">Sobrenome</label>
					<input type="text" class="form-control" id="sobrenome" placeholder="Nome" value="<?php echo trim($_SESSION['sobrenome'])?> ">
				</div>
				<div class="form-group col-md-6">
					<label for="emailAlter">Email</label>
					<input type="text" class="form-control" id="emailAlter" value=" <?php echo $_SESSION['email']?>">
				</div>
				<div class="form-group col-md-6">
					<label for="nick">Nome de usuário</label>
					<input type="text" class="form-control" id="nick"  value='<?php echo (isset($_SESSION['nick'])?$_SESSION['nick']: "") ?>'>
				</div>
			
		
			<div class="form-group col-md-6">
				<label for="dt_nasc">Data de nascimento: </label>
				<input type="date" class="form-control" id="dt_nasc" placeholder="" value='<?php echo (isset($_SESSION['dt_nasc'])?$_SESSION['dt_nasc']: "") ?>'>
			</div>

			<div class="form-group col-md-6">
				<label for="cpf">CPF</label>
				<input type="text" class="form-control" id="cpf" value='<?php echo (isset($_SESSION['cpf'])?$_SESSION['cpf']: "") ?>'>
			</div>
			<div class="form-group col-md-6">
				<label for="celular">Celular:</label>
				<input type="text" class="form-control" id="celular" name="">
			</div>
				<div class="form-group col-md-6">
					<label for="imagem">imagem de perfil:</label>
					<input type="file" class="form-control" id="imagem" placeholder="1234 Main St">
			</div>
			<button type="submit" id="btnAlterar" class="btn btn-info btn-block">Alterar</button>
			</div>
		</form>
		<!-- end form-->

	</div>
</main>
<!-- page-content" -->
</div>
<script type="text/javascript">
	$(document).ready(function(){
		 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#img').attr('src', e.target.result);
            };
            $('#img').fadeIn("slow");
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imagem").change(function() {
    	$('#img').hide();
        readURL(this);
    });
		
	});
</script>


<?php include_once "../templates/footerLogado.php";?>
