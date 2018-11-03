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
	})
})