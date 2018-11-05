	
$(document).ready(function(){
	//Mascaras
	$('#cpf').mask('000.000.000-00');
	$('#celular').mask('(00) 00000-0000');
	
	//$('#ip').mask("000.000.000.000");
	$('#mac').mask('AA:AA:AA:AA:AA:AA');
	


	//Cadastrar Gerenciador

	


	
	$('#imgIconCad').hide();


	//Cadastrar usuário
	$('#btnCad').click(function(e){
		e.preventDefault();		
		var nome = $('#nome').val();
		var sobrenome = $('#sobrenome').val();
		var senha=$('#senha').val();
		var email =$('#email').val();
		var mensagem ="";
		var regex_email = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

		if(nome==""){
			mensagem +="<p>O campo <b>nome</b> não pode estar vazio</p>";
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#nome').focus();
		}else if(nome.length<4){
			mensagem +="<p>O campo <b>nome</b> deve possuir no mínimo 4 digitos</p>";
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#sobrenome').focus();
		}else if(sobrenome==""){
			mensagem+="<p>O campo <b>sobrenome</b> não pode estar vazio</p>"
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#sobrenome').focus();
		}else if(sobrenome.length<4){
			mensagem+="<p>O campo <b>sobrenome</b> deve possuir no mínimo 4 digitos</p>";
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#sobrenome').focus();
		}else if(!regex_email.test(email)){
			mensagem+="<p>O  <b>email</b> inserido não é valido</p>";
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#email').focus();	
		}else if(senha==""){
			mensagem+="<p>O campo <b>senha</b> não pode ser vazio</p>";
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#senha').focus();

		}else if (senha.length < 6){
			mensagem+="<p>O campo <b>senha</b> deve possuir no mínimo 4 digitos</p>";
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#senha').focus();

		}else if(senha != $('#cSenha').val()){
			mensagem+="<p>Os campos <b>senhas e confirmar senha</b> são diferentes</p>";
			$('#mensagem').addClass("alert-warning");
			$('#mensagem').html(mensagem);
			$('#mensagem').fadeIn("slow");
			$('#cSenha').focus();
		}else {
			$('#mensagem').removeClass("alert-warning");
			inserir(nome, sobrenome, email, senha);
			
		}


	//função ajax que vai verificar se existe no banco o usuario com o e-mail acima
	// inserir(nome,sobrenome,email,senha);

});
	//Fim Cadastro//
// Login //
	//Login //
	var emailL;
	$('#btnLogin').click(function(e){
		e.preventDefault();
		emailL = $('#emailL').val();
		if($('#btnLogin').val()=="Proximo"){

			if (emailL!=""){
				if(emailL.length>3){
					$('#mensagem').fadeOut();
					$.ajax({
						url:"../control/ajax/verificaUser-ajax.php",
						data:{emailL:emailL},
						type:"POST",
						datatype:"json"
					}).done(function(e){						
						$sucesso = $.parseJSON(e)['sucesso'];
						$mensagem = $.parseJSON(e)['mensagem'];
						if($sucesso){
							$id = $.parseJSON(e)['id'];
							$email = $.parseJSON(e)['email'];
							$nome =$.parseJSON(e)['nome'];
							$('.profile-name').html($nome);
							$('.profile-email').html($email);
							$('.profile-name').fadeIn();
							$('.profile-email').fadeIn();
							var caminho = "../uf/"+$id+ "/"+ $id+"_perfil.jpg";
							$('#imgPerfil').attr('src',caminho);
							$('#imgPerfil').fadeIn();
							$('#emailL').fadeOut();
							$('#senhaL').fadeIn();
							$('#btnLogin').val("Entrar");
							$('#different_account').fadeIn("slow");
						}else{
							var caminhoDefault = "https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120";
							$('#mensagem').addClass("alert-danger")
							$('#mensagem').html($mensagem);
							$('#mensagem').fadeIn();
							$('#imgPerfil').attr("src",caminhoDefault);
							$('#imgPerfil').fadeIn("slow");
							$('#different_account').fadeOut("slow");
						}
					}).fail(function(){
						console.log("erro");
					});
				}else{
					$('#mensagem').html("O campo <b>email</b> deve possuir mais de 3 digitos");
					$('#mensagem').addClass("alert-warning");
					$('#mensagem').fadeIn();

					$('#emailL').focus();
					$('#emailL').css("border", "1px solid #F00");
				}
			}else{
				$('#mensagem').html("O campo <b>email</b> não pode ser vazio");
				$('#mensagem').addClass("alert-warning");
				$('#mensagem').fadeIn();
				$('#emailL').focus();
				$('#emailL').css("border", "1px solid #F00");
			}
		}else if($("btnLogin").val("Entrar")){
			var senhaL = $("#senhaL").val();
			if(senhaL!=""){
				if(senhaL.length>3){
					$.ajax({
						url:"../control/ajax/tryLogin-ajax.php",
						type: "POST",
						datatype: "json",
						data:{emailL:emailL, senhaL:senhaL}
					}).done(function(e){
						$sucesso = $.parseJSON(e)['sucesso'];
						if($sucesso){
							$('#mensagem').fadeOut();
							$('#senhaL').css('border',"none");
							window.setTimeout("location.href='usuario/index.php'",1500);

						}else{
							$('#mensagem').html("Email ou senha incorreta");
							$('#mensagem').addClass("alert-warning");
							$('#mensagem').fadeIn();
							$('#senhaL').focus();
							$('#senhaL').css('border',"1px solid #F00");
						}
					}).fail(function(){
						console.log("falha");
					});
				}
			}
		}

	});
 // Fim Login;;
//Fim login //
//Verifica email //
$('#emailAlter').blur(function(){
	var email = $('#emailAlter').val();
	$.ajax({
		type:"POST",
		url:"../../control/ajax/verificaEmail-ajax.php",
		data:{email:email},
		datatype:"json"
	}).done(function(data){
		$sucesso = $.parseJSON(data)['sucesso'];
		$mensagem = $.parseJSON(data)['mensagem'];
		if($sucesso){
			$('#msgEmail').removeClass('alert-danger');
			$('#msgEmail').addClass('alert-success');
			$('#btnAlterar').prop("disabled", false);
			
		}else{
			$('#msgEmail').addClass('alert-danger');
			$('#btnAlterar').prop("disabled", true);
			$('#msgEmail').removeClass('alert-success');
		}
		$('#msgEmail').html($mensagem);
	}).fail(function(){
		console.log("erro");
	}).always(function(){
		$('#msgEmail').fadeIn();
	});
});
// fim verifica email
//Lofoff//
$('#logoff').click(function(){
	$.ajax({
		type:"POST",
		url: "../../control/ajax/sair-ajax.php",		
	}).done(function(e){
		if(e=="saiu"){	
			console.log("saiu");
			window.setTimeout("location.href='../index.php'",1000);
		}else
		console.log("não saiu :"+ e);
		
	}).fail(function(){
		console.log("erro");
	});
});
//fim logoff //
//Upload da imagem//
$('#imagem').blur(function(e){
	if(e.target.files!=null && e.target.files.length!=0 ){
		var arquivoSelecionado =e.target.files[0];
		var formData = new FormData();
		formData.append("foto", arquivoSelecionado);
		var xmlHttp = new XMLHttpRequest();
		$.ajax({
			data:formData,
			datatype:"json",
			type:"POST",
			url: "../../control/ajax/uploadFoto-ajax.php",
			processData: false,  
			contentType: false
		}).done(function(data){
			console.log("foi:"+data);
			$('#img').attr('src',data);
		}).fail(function(){
			console.log("erro");
		});
	}
});
//alterar dados de usuário
$('#btnAlterar').click(function(e){
	e.preventDefault();
	var nome = $('#nome').val();
	var sobrenome = $('#sobrenome').val();
	var nick = $('#nick').val();
	var email = $('#emailAlter').val();
	var dt_nasc = $('#dt_nasc').val();
	var	celular = $('#celular').val();	
	var cpf= $('#cpf').val();
	if(nome== ""){
		$('#erros p').html("O campo nome não pode ser vazio");
		$('#erros').addClass(" alert-warning");
		$('#erros').show();
	}else if(nome.length <3){
		$('#erros p').html("O campo <b>nome</b> deve possuir mais de 3 caracteres");
		$('#erros').addClass(" alert-warning");
		$('#erros').show();
	}
	if(sobrenome== ""){
		$('#erros p').html("O campo sobrenome não pode ser vazio");
		$('#erros').addClass(" alert-warning");
		$('#erros').show();
	}else if(sobrenome.length <3){
		$('#erros p').html("O campo <b>sobrenome</b> deve possuir mais de 3 caracteres");
		$('#erros').addClass(" alert-warning");
		$('#erros').show();
	}
	if(email==""){
		$('#erros p').html("O campo <b>email</b> não pode ser vazio");
		$('#erros').addClass(" alert-warning");
		$('#erros').fadeIn();

	}
	if(nome.length >3 && email!="" && nick!=""){
		$('#msgEmail').fadeOut();
		$.ajax({
			url:"../../control/ajax/atualizarUsuario-ajax.php",
			type:"POST",
			datatype:"json",
			data:{ nome:nome,sobrenome:sobrenome, email:email, nick: nick, celular:celular, dt_nasc :dt_nasc, cpf:cpf}

		}).done(function(data){
			$mensagem = $.parseJSON(data)['mensagem'];
			$('#erros').html($mensagem);
			$('#erros').removeClass("alert-warning");
			$('#erros').addClass('alert-success');
			$('#erros').fadeIn();
			window.setTimeout("location.href='index.php'",2000);

		}).fail(function(data){
			console.log("erro:"+data);
		});
	}
});
//Fim alterar usuário//
});
	
	//inserir usuário//
	
	function inserir(nome,sobrenome, email,senha){
		$.ajax({
			type:"POST",
			url:"../control/ajax/ajax-cadastro.php",
			data:{nome:nome,sobrenome:sobrenome,email:email,senha:senha},
			datatype:"json"
		}).done(function(e){
			$sucesso = $.parseJSON(e)['sucesso'];
			$mensagem = $.parseJSON(e)['mensagem'];
			if($sucesso){
				$('#mensagem').addClass("alert-success");
				$('#mensagem').html($mensagem);
				$('#mensagem').fadeIn();
				window.setTimeout("location.href='login.php'",1500);
			}else{
				$('#mensagem').addClass("alert-danger");
				$('#mensagem').html($mensagem);
				$('#mensagem').fadeIn();
			}

		}).fail(function(){
			console.log("erro");
		}).always(function(e){
			console.log("alert");
		});
	}

// Fixed Nav
jQuery(function ($) {

	$(".sidebar-dropdown > a").click(function() {
		$(".sidebar-submenu").slideUp(200);
		if (
			$(this)
			.parent()
			.hasClass("active")
			) {
			$(".sidebar-dropdown").removeClass("active");
		$(this)
		.parent()
		.removeClass("active");
	} else {
		$(".sidebar-dropdown").removeClass("active");
		$(this)
		.next(".sidebar-submenu")
		.slideDown(200);
		$(this)
		.parent()
		.addClass("active");
	}
});

	$("#close-sidebar").click(function() {
		$(".page-wrapper").removeClass("toggled");
	});
	$("#show-sidebar").click(function() {
		$(".page-wrapper").addClass("toggled");
	});
});


