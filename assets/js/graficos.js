	var ctx = $("#myChart");
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["00:00", "02:00", "04:00","06:00", "08:00","10:00", "12:00","14:00", "16:00","18:00", "20:00","22:00", "23:59"],
			datasets: [{
				label: 'Registro do dia 07/11/2018',
				data: [0, 6, 15,12, 3,5, 18,14, 10,19, 11,5,10],
				backgroundColor: [
				'rgba(69, 69, 69, 0.2)'
				
				],
				borderColor: [
				'rgba(0,0,0,1)'
				
				],
				borderWidth: 1
			},{
				label: 'Registro do dia 09/11/2018',
				data: [0, 3, 12,2, 13,5, 8,14, 15,10, 16,15,0],
				backgroundColor: [
				'rgba(90, 1173, 173, 0.2)'
				
				],
				borderColor: [
				'rgba(64, 128, 128, 1)'
				
				],
				borderWidth: 1

			},
			]
		},
		options:{
			title:{
				display:true,
				fontSize:20,
				text: "Grafico de consumo "
			},
			labels:{
				fontStyle:"bold"
			}
			
		}

		
	});
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
			var valor = $('#ss').val();
		$.ajax({
			url: "../../control/ajax/buscaEquipamentos-ajax.php",
			data:{valor:valor},
			datatype:"json",
			type:"POST"
		}).done(function(e){
			/*console.log("foi:"+e);*/
			$equipamentos = $.parseJSON(e)['equipamentos'];
			var options = "";
			$.each($equipamentos,function(chave,valor){
				options+= '<option value="'+ valor['id'] + '">'+valor['modelo'] +"</option>";
				$('#ss').html(options);
			});
	/*		console.log(options);*/
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
