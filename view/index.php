<?php include_once "templates/topo.php"; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class=" row">
	<div id="myCarousel" class="carousel slide col-sm-10 col-md-10 col-sm-offset-2 col-md-offset-1" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="../assets/imgs/ethernet-shield.jpg" alt="Los Angeles" >
				<div class="carousel-caption">
					<h3>Arduino</h3>
					<p>Lorem ipsum dolore quantum concatemo</p>
				</div>
			</div>

			<div class="item">
				<img src="../assets/imgs/arduino.png" alt="Chicago" >
				<div class="carousel-caption">
					<h3>Arduino</h3>
					<p>Lorem ipsum dolore quantum concatemo</p>
				</div>
			</div>

			<div class="item">
				<img src="../assets/imgs/sensor.jpg" alt="New york">
				<div class="carousel-caption">
					<h3>Arduino</h3>
					<p>Lorem ipsum dolore quantum concatemo</p>
				</div>
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>




	<style type="text/css">
	#myCarousel{
		margin-top: 50px;
	}
</style>


<?php include_once "templates/footer.php";?>