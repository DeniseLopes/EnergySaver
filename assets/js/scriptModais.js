$(document).ready(function(){
	$('#ModalEquipamento, #equip, #addEquip').click(function(){
		$('#imgIconCad').hide();
		buscaGerenciadores();
		$.ajax({
			url: "../../control/ajax/buscaTipoEquipamentos-ajax.php",
			type:"POST"
		}).done(function(e){
			$categorias = $.parseJSON(e)['a'];
			
			var options="<option value='-1' selected>Selecione</option>";
			$.each($categorias,function(chave,valor){
				options+= '<option value="'+ valor['id'] + '">'+valor['nome'] +"</input>";
				$('#tipoEquipamento').html(options);
				$('.tipo').html(options);
			});
			//console.log("opções:"+ options);
		}).fail(function(){
			console.log("erro");
		});
	});
	//Cadastrar Gerenciador//
	$('#cadGerenciador').click(function(){

		var mac = $('#mac').val();
		var ip = $('#ip').val();
		var desc = $("#desc").val();
		var ip_regex = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
		var mac_regex = /^([0-9A-F]{2}[:-]){5}[0-9A-F]{2}$/i;
		if(!ip_regex.test(ip)){
			console.log("ip invalido");
			$('#msgCadGerenciador p').html("o <b>ip</b> inserido não é um ip valido");
			$('#msgCadGerenciador').addClass("alert-warning");
			$('#msgCadGerenciador').fadeIn();
			$('#ip').focus();
		}else if(!mac_regex.test(mac)){
			console.log("mac invalido");
			$('#msgCadGerenciador p').html("o <b>endereço mac</b> inserido não é um ip valido");
			$('#msgCadGerenciador').addClass("alert-warning");
			$('#msgCadGerenciador').fadeIn();
			$('#mac').focus();
		}
		else if(desc.length<4){			
			console.log("tamanho da desc invalido");
			$('#msgCadGerenciador p').html("o campo <b>Descrição</b> deve conter mais de 4 dígitos");
			$('#msgCadGerenciador').addClass("alert-warning");
			$('#msgCadGerenciador').fadeIn();
			$('#desc').focus();
		}else{
			console.log("passou");
			$('#msgCadGerenciador').removeClass("alert-warning");
			$('#msgCadGerenciador').hide();
			cadastrarGerenciador(mac,ip,desc);
		}

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

	$(".tipo").change(function(e){
		var idEquipamento =$(this).val();
		console.log(idEquipamento);
		$.ajax({
			url: "../../control/ajax/retornarEquipamentos-ajax.php",
			data: {idEquipamento: idEquipamento },
			type:"POST",
			datatype:"json"
		}).done(function(e){
			console.log("sucesso:"+e);
		}).fail(function(){
			console.log("erro");
		});
	});
	$('#cadastrarE').click(function(e){
		e.preventDefault();
		console.log("salvando...");
		var tipo = $('#tipoEquipamento').val();
		var modelo = $('#modelo').val();
		var potencia = $('#watts').val();
		var mac = $('#macGerenciador').val();
		if(tipo==-1){
		//console.log("invalido");
		$('#mensagemE p').addClass("alert-warning");
		$('#mensagemE p').html("Escolha um tipo de equipamento");
		$('#mensagemE').fadeIn("slow");
		$('#tipoEquipamento').focus();
	}else if( modelo == ""){
		$('#mensagemE p').addClass("alert-warning");
		$('#mensagemE p').html("O campo <b> Modelo </b> não foi preenchido");
		$('#mensagemE').fadeIn("slow");
		$('#modelo').focus();
	}else if(potencia <2.2 || potencia>1000){
		$('#mensagemE p').addClass("alert-warning");
		$('#mensagemE p').html("o valor de <b>potencia</b> informado não é valido");
		$('#mensagemE').fadeIn("slow");
		$('#potencia').focus();
	}else if(mac==-1){
		$('#mensagemE p').addClass("alert-warning");
		$('#mensagemE p').html("Por favor escolha o <b>mac</b> de um dos gerenciadores abaixo");
		$('#mensagemE').fadeIn("slow");
		$('#potencia').focus();
		
	}else{
		$('#mensagemE p').removeClass("alert-warning");
		$('#mensagem'). hide();
		cadastrarEquipamento(tipo,modelo,potencia,mac);
	}

});

/*	$('#cadastrarE').click(function(){
		var tipo = $("#tipoEquipamento").val();
		var modelo = $("#modelo").val();
		var potencia = $('#watts').val();
		var mac = $('#macGerenciador').val();
		if(tipo ==-1 ){

		}

	});*/
});

function cadastrarGerenciador(mac,ip,desc){
	$.ajax({
		url:"../../control/ajax/cadastraGerenciador-ajax.php",
		data:{mac:mac,ip:ip,desc:desc},
		datatype:"json",
		type:"POST"
	}).done(function(e){
		$sucesso = $.parseJSON(e)['sucesso'];
		$mensagem = $.parseJSON(e)['mensagem'];
		if($sucesso){
			$('#msgCadGerenciador').addClass("alert-success");
			$('#mac').val("");
			$("#ip").val("");
			$('#desc').val("");
		}else
		$('#msgCadGerenciador p').addClass("alert-danger");
		
		$('#msgCadGerenciador p').html($mensagem);

	}).fail(function(){
		console.log("falha ao se conectar, contate o suporte técnico");
	}).always(function(){
		$('#msgCadGerenciador').fadeIn("slow");

	});
}
function buscaGerenciadores(){
	$.ajax({
		url:"../../control/ajax/buscaGerenciadores-ajax.php",
		type:"POST"
	}).done(function(e){
		//console.log("done:"+ e);
		$gerenciadores = $.parseJSON(e)['gerenciadores'];
		var options="<option value='-1' selected>Selecione</option>";
		$.each($gerenciadores,function(chave,valor){
			options+= '<option value="'+ valor['id'] + '">'+valor['mac_address'] +"</input>";
			$('#macGerenciador').html(options);
			
		});
		//console.log("options::"+ options);
	}).fail(function(){
		console.log("fail");
	})
}
function cadastrarEquipamento(tipo,modelo,potencia,idGerenciador){
	$.ajax({
		url: "../../control/ajax/cadEquipamento-ajax.php",
		type: "POST",
		datatype:"json",
		data:{tipo:tipo, modelo:modelo, potencia:potencia, idGerenciador:idGerenciador}
	}).done(function(e){
		console.log("done:"+e);
		$sucesso = $.parseJSON(e)['sucesso'];
		$mensagem = $.parseJSON(e)['mensagem'];
		if($sucesso){			
			$('#tipoEquipamento').val(-1);
			$('#modelo').val("");
			$('#watts').val("");
			$('#macGerenciador').val(-1);
			$('#mensagemE p').addClass("alert-success");
			

		}else{
			$('#mensagemE p').addClass("alert-danger");
		}
		$('#mensagemE p').html($mensagem);

	}).fail(function(){
		$('#mensagemE p').html($mensagem);
	}).always(function(){
		$("#mensagemE").fadeIn();
	})
}
