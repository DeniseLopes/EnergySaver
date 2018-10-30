<?php include "templates/topo.php"?>
<div class="container-fluid bg">
	<div class="row">
		<div class="row text-center " id="c">
			<div class="col-md-6 offset-md-3 col-sm-offset-3 col-md-offset-3">
				<div class="card">
					<div class="card-body">
						<div class="login-img">
							<img src="../assets/imgs/perfilDefault.jpg" id="imgPerfil" class="img-rounded ">
						</div>
						<div class="login-title">
							<h4>Log In</h4>
						</div>
						<div class="login-form mt-4">
							<form>
								<div class="alert " id="mensagem"></div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<input id="emailL" name="Full Name" placeholder="Email Address" class="form-control" type="text">
									</div>
									<div class="form-group col-md-12">
										<input type="password" class="form-control" id="senhaL" placeholder="Password">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group">															
										<label class="form-check-label" for="updatecheck1">
											<small>Não possui cadastro? <a href="cadastro.php">clique aqui </a> para se cadastrar</small>
										</label>										
									</div>
								</div>    
								<button type="button" class="btn btn-info btn-block" id="btnLogin">Entrar</button>	
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$('#emailL').blur(function(){
		var emailL = $('#emailL').val();
		$.ajax({
			url:"../control/ajax/verificaUser-ajax.php",
			data:{emailL:emailL},
			type:"POST",
			datatype:"json"
		}).done(function(e){
			console.log(e);
			if(e!==null){
			$('#imgPerfil').attr('src',e);
			$('#imgPerfil').fadeIn();
			}else{
				$('#imgPerfil').fadeOut();
			}

		}).fail(function(){
			console.log("erro");
		})
	});
</script>
<?php include "templates/footer.php";?>