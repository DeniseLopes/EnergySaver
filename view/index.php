<?php include_once "templates/topo.php"; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class=" row">
	<div class="slide_content col-sm-12  container" >
	
			<iframe src="templates/slide.php"></iframe>
	</div>
</div>
<style type="text/css">
	.slide_content{
		position:absolute;
	
		   height:438px;
		     
		    overflow-y:hidden;
	
	}
	iframe{
		width: 100%;
		height:470px;
		overflow-x: hidden;
		overflow-y: hidden;
		overflow: hidden;

	}
</style>

<?php include_once "templates/footer.php";?>