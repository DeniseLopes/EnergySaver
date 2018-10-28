	
$(document).ready(function(){
	//Cadastrar
	$('#btnCad').click(function(e){
		e.preventDefault();
		var error="";
		if(
			$('#nome').val()==''){
			error +=  "<p>Escreva um nome</p>";
		$('#nome').css('border-bottom-color','#F14B4b');
	}else{
		$('#nome').css('border-bottom-color','#d1d1d1');
	}
	if(
		$('#email').val()==''){
		error +=  "<p>Insira um email</p>";
	$('#email').css('border-bottom-color','#F14B4b');
}else{
	$('#email').css('border-bottom-color','#d1d1d1');
}
if(
	$('#senha').val()==''){
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
	var senha=$('#senha').val();
	var email =$('#email').val();
	//função ajax que vai verificar se existe no banco o usuario com o e-mail acima
	var retorno =  inserir(nome,email,senha);
}
});
	//Fim Cadastro//
// Login //
$('#btnLogin').click(function(e){
	e.preventDefault();
	var emailL = $('#emailL').val();
	var senhaL = $('#senhaL').val();
	var erro="";
	if(emailL==""){
		erro+="<p>o Campo <strong>email</strong> não pode ser vazio</p>";
	}if(senhaL==""){
		erro +="<p>o Campo <b>Senha</b> não pode ser vazio</p>";
	}else if(senhaL.length<6){
		erro +="<p>o Campo <b>Senha</b> deve ter no mínimo 6 caracteres</p>";
	}
	if(erro==''==false){
		$('#mensagem').addClass('alert-warning');
		$('#mensagem').removeClass('alert-success');
		$('#mensagem').html(erro);
		$('#mensagem').show();
	}else{
		$('#mensagem').hide();
		$('#mensagem').removeClass("alert-warning");
		$.ajax({
			type:"POST",
			datatype:"json",
			url:"../control/ajax/tryLogin-ajax.php",
			data:{emailL:emailL, senhaL:senhaL}
		}).done(function(data){
			console.log(data);
			$sucesso = $.parseJSON(data)['sucesso'];
			$mensagem = $.parseJSON(data)['mensagem'];
			if($sucesso){
				$('#mensagem').removeClass("alert-warning");
				$('#mensagem').addClass('alert-success');
				window.setTimeout("location.href='usuario/index.php'",2000);
			}else{
				$('#mensagem').addClass('alert-warning');
				$('#mensagem').removeClass('alert-success');
			}
			$('#mensagem').html("<p>"+$mensagem+"</p>");
		}).fail(function(){
			console.log("erro");

		}).always(function(){
			$('#mensagem').show();
		});
	}
});
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
			$('#msgEmail').addClass('alert-success');

			$('#btnAlterar').prop("disabled", false);
			$('#msgEmail').removeClass('alert-danger');
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
			window.setTimeout("location.href='../index.php'",2000);
		}else
		console.log("não saiu :"+ e);
		
	}).fail(function(){
		console.log("erro");
	});
});
//fim logoff //
//Upload da imagem//
$('#imagem').on("change",function(e){
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
	if(email==""){
		$('#erros p').html("O campo <b>email</b> não pode ser vazio");
		$('#erros').addClass(" alert-warning");
		$('#erros').show();

	}
	if(nome.length >3 && email!="" && nick!=""){
		$('#msgEmail').fadeOut();
		$.ajax({
			url:"../../control/ajax/atualizarUsuario-ajax.php",
			type:"POST",
			datatype:"json",
			data:{ nome:nome, email:email, nick: nick, celular:celular, dt_nasc :dt_nasc, cpf:cpf}

		}).done(function(data){
			$mensagem = $.parseJSON(data)['mensagem'];
			$('#erros').html($mensagem);
			$('#erros').addClass('alert-success');
			$('#erros').fadeIn();

		}).fail(function(data){
			console.log("erro:"+data);
		});
	}

});

});
	//inserir usuário//
	
	function inserir(nome,email,senha){
		$.ajax({
			type:"POST",
			url:"../control/ajax/ajax-cadastro.php",
			data:{nome:nome,email:email,senha:senha},
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
				console.log(e);
				$('#mensagem').addClass('alert-warning');
				$('#mensagem').html("<p>"+$mensagem+"<\p>")
				$('#mensagem').show();

			}
	/*	if($sucesso){

	}*/



}).fail(function(){
	console.log("erro");
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

