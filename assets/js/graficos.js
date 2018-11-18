
	$(document).ready(function(){
		$('#equipamento').hide();
		$('[data-toggle="tooltip"]').tooltip();
			var valor = $('#ss').val();
		$.ajax({
			url: "../../control/ajax/buscaEquipamentos-ajax.php",
			data:{valor:valor},
			datatype:"json",
			type:"POST"
		}).done(function(e){
			console.log(e);
			/*console.log("foi:"+e);*/
			/*$equipamentos = $.parseJSON(e)['equipamentos'];
			var options = "";
			$.each($equipamentos,function(chave,valor){
				options+= '<option value="'+ valor['id'] + '">'+valor['modelo'] +"</option>";
				$('#ss').html(options);
			});
			console.log(options);*/
		}).fail(function(){
			console.log("fail");
		});
		$("#ss").change(function(e){
				$('#ft').hide();
			var id = $(this).val();
			$.ajax({
				url:"../../control/ajax/EquipamentoSelecionado-ajax.php",
				datatype:"json",
				data: {id,id},
				type:"POST"
			}).done(function(e){
				$result = $.parseJSON(e);
				var img ="../.."+$result['src_img'];
				var modelo = $result['modelo'];
				var desc = $result['descricao'];
				$('#ft img').attr("src", img);
				$("#ft").fadeIn("slow");
				$('#mode').html(modelo);
				$('#descri').html(desc);
			}).fail(function(){
				console.log("fail");
			});
		});   
	});
