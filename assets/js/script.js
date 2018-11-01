	
$(document).ready(function(){
	$('#cpf').mask('000.000.000-00');
	$('#celular').mask('(00) 00000-0000');
	$('#mac').mask("00:00:00:00:00:00");
	$('#ip').mask("000.000.000.000");


	
	$('#imgIconCad').hide();
	//Cadastrar
	$('#btnCad').click(function(e){
		e.preventDefault();
		var error="";
		if($('#nome').val()==''){
			error +=  "<p>Escreva um nome</p>";
			$('#nome').css('border-bottom-color','#F14B4b');
		}else{
			$('#nome').css('border-bottom-color','#d1d1d1');
		}
		if($('#sobrenome').val()==''){
			error +=  "<p>Escreva um sobrenome</p>";
			$('#sobrenome').css('border-bottom-color','#F14B4b');
		}else{
			$('#sobrenome').css('border-bottom-color','#d1d1d1');
		}
		if($('#email').val()==''){
			error +=  "<p>Insira um email</p>";
			$('#email').css('border-bottom-color','#F14B4b');
		}else{
			$('#email').css('border-bottom-color','#d1d1d1');
		}
		if($('#senha').val()==''){
			error +=  "<p>Insira uma senha</p>"
			$('#senha').css('border-bottom-color','#F14B4b');;
		}else{
			if($('#senha').val().length <6){
				error+="<p>a senha deve conter mais de 5 digitos</p>";
				$('#senha').css('border-bottom-color','#F14B4b');
			}else if($('#cSenha').val()==''){
				$('#senha').css('border-bottom-color','#d1d1d1');
				error+="<p>É necessário confirmar a senha</p>";
				$('#cSenha').css('border-bottom-color','#F14B4b');
			}else if($('#senha').val() !=$('#cSenha').val()){
				error+="<p>as senhas devem ser iguais</p>";
				$('#cSenha').css('border-bottom-color','#F14B4b');
			}else{
				$('#cSenha').css('border-bottom-color','#d1d1d1');

			}
		}
		if(error==''==false){
			$('#mensagem').addClass('alert-warning');
			$('#mensagem').html(error);
			$('#mensagem').show();
		}else{
			console.log("validação ok")
			var nome = $('#nome').val();
			var sobrenome = $('#sobrenome').val();
			var senha=$('#senha').val();
			var email =$('#email').val();
	//função ajax que vai verificar se existe no banco o usuario com o e-mail acima
	var retorno =  inserir(nome,sobrenome,email,senha);
}
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
$('#ModalEquipamento, #equip ').click(function(){
	$('#imgIconCad').hide();
	$.ajax({
		url: "../../control/ajax/buscaTipoEquipamentos-ajax.php",
		type:"POST"
	}).done(function(e){
		$categorias = $.parseJSON(e)['a'];
		
		var options="<option value='-1' selected>Selecione</option>";
		$.each($categorias,function(chave,valor){
			options+= '<option value="'+ valor['id'] + '">'+valor['nome'] +"</input>";
			$('#tipoEquipamento').html(options);
		});
		console.log(options);
	}).fail(function(){
		console.log("erro");
	});
});
});
	$('#tipoEquipamento').change(function(e){

		var opcao = $(this).val();
		switch(opcao){
			case "1":
			$('#imgIconCad img').attr("src", "../../assets/imgs/computador-icon.png");	
			$('#imgIconCad').fadeIn("slow");
			break;
			case "2" :
			$('#imgIconCad img').attr("src", "../../assets/imgs/impressora-icon.png");
			$('#imgIconCad').fadeIn("slow");
			break;
			case "3" :
			$('#imgIconCad img').attr("src", "../../assets/imgs/geladeira-icon.png");
			$('#imgIconCad').fadeIn("slow");
			break;
			case "4" :
			$('#imgIconCad img').attr("src", "../../assets/imgs/transformador-icon.png");
			$('#imgIconCad').fadeIn("slow");
			break;
			case "5" :
			$('#imgIconCad img').attr("src", "../../assets/imgs/ar-condicionado-icon.png");
			$('#imgIconCad').fadeIn("slow");
			break;
			case "6" :
			$('#imgIconCad img').attr("src", "../../assets/imgs/tv-icon.png");
			$('#imgIconCad').fadeIn("slow");
			break;
			case "7" :
			$('#imgIconCad img').attr("src", "../../assets/imgs/radio	-icon.png");
			$('#imgIconCad').fadeIn("slow");
			break;
			case "-1":
			$('#imgIconCad').hide();
		}
	});
	//inserir usuário//
	
	function inserir(nome,sobrenome, email,senha){
		$.ajax({
			type:"POST",
			url:"../control/ajax/ajax-cadastro.php",
			data:{nome:nome,sobrenome:sobrenome,email:email,senha:senha},
			datatype:"json"
		}).done(function(e){

			$mensagem = $.parseJSON(e)['mensagem'];
			$sucesso= $.parseJSON(e)['sucesso'];
			if($sucesso){
				console.log("foi: "+e);
				$('#mensagem').removeClass('alert-warning');
				$('#mensagem').addClass('alert-success');
				$('#mensagem').html("<p>"+$mensagem+"<\p>")
				$('#mensagem').show();
				$('#nome').val('');
				$('#email').val('');
				$('#senha').val('');
				$('#cSenha').val('');
				window.setTimeout("location.href='login.php'",1000);
			}else{
				console.log("foi não :"+ e);
				$('#mensagem').addClass('alert-warning');
				$('#mensagem').html("<p>"+$mensagem+"<\p>")
				$('#mensagem').show();

			}
	/*	if($sucesso){

	}*/



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


