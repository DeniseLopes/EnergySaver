s<?php include"../templates/topoLogado.php";
require_once "../../control/EquipamentoController.class.php";
require_once "../../control/Traffic.class.php";
$equipamentos = new EquipamentoController();
new Traffic();
$arr=$equipamentos->getAll();
$objeto = json_decode($arr);


if(isset($_SESSION['logado'])!="sim"){
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php' >";
}else{?>

	<!-- sidebar-wrapper  -->
	<script type="text/javascript" src="../../assets/js/Chart.min.js"></script>
	<main class="page-content">
		
		<div class="container jumbotron">
			<h1 class="text-center">Painel de controle</h1>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<canvas id="pizza" class=""></canvas>
				</div>
				<div class="col-md-6 col-sm-12">
					<canvas id="bar" class=""></canvas>
				</div>

			</div>
			<hr>
			<div class="row">
				<div class="col-sm-10 col-md-10 col-md-offset-1 col-sm-offset-1"><canvas id="line"></canvas></div>
			</div>
			
		</div>


	</div>
</main>
<script type="text/javascript">
	var ctx = $('#pizza');
	var mychart = new Chart(ctx,{
		type:"pie",
		data:{
			labels:['Computador',"impressora","Transformador","TV", "ar-condicionado"],
			datasets:[{
				data:[5,1,3,4,2],
				backgroundColor:[
				'#2ecc71',
				'#3498db',
				'#95a5a6',
				'#f1c40f',
				'#e74c3c'
				]
			}]
		},
		options:{
			title:{
				display:true,
				fontSize:20,
				text:"Equipamentos Cadastrados",
			}
		}

	});
	var ctx2 = $('#bar');
	var mychar2 = new Chart(ctx2,{
		type:"bar",
		data: {
			labels: ["A","B","C","D","E"],
			datasets: [{
				label: "Watts consumido hoje",
				backgroundColor: 'rgb(69, 99, 132,0.6)',
				borderColor: 'rgb(0, 0, 0)',
				data: [ 10, 5,  20, 30, 45],
			}]
		},
		options:{
			title:{
				display:true,
				fontSize:20,
				text:"Consumo diário de equipamentos",
			}
		}

		


	});
	var ctx3 = $("#line");
	var mychar3 = new Chart(ctx3,{
		type:"line",
		data:{
			labels:["00:00", "04:00", "08:00", "12:00", "16:00", "20:00", "22:00","23:59"],
			datasets:[{
				label:"A",
				data:[15,3,7,15,12,6,9,12],
				backgroundColor:"rgba(26,179,102,0.2)",
				borderColor :"#3cba9f",
				fill:false,
			},{
				label: "B",
				data:[7,3,9,7,12,20,5,5],
				backgroundColor:"rgba(242,242,0,0.2)",
				borderColor :"rgba(255,255,0,1)",
				fill:false,
			},{
			label: "C",
				data:[17,13,9,12,11,10,5,15],
				backgroundColor:"rgba(4,4,255,0.2)",
				borderColor :"rgba(0,0,255,1)",
				fill:false,
				},{
			label: "D",
				data:[7,3,19,12,10,13,15,15],
				backgroundColor:"rgba(192,192,192,0.2)",
				borderColor :"rgba(131,131,131,1)",
				fill:false,
				},
				{
			label: "E",
				data:[17,13,9,12,1,11,5,13],
				backgroundColor:"rgba(255,0,0,0.2)",
				borderColor :"rgba(255,0,0,1)",
				fill:false,
				}
			]

		},
		options:{
			title:{
				display:true,
				fontSize:20,
				text:"Consumo por hora dos equipamentos",
			}
		}
	})
	
</script>


<?php  }
include_once "../templates/footerLogado.php";
?>