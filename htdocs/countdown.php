<?php 
	session_start();
?>
<html>
<head>
	<?php 
		include 'head.php';
	?>
</head>
<body>
	<?php 
		include 'navbar.php';
	?>
	<div class="container col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4">
		<form>
			<label class="col-xs-12">Enter starting numbers:</label>
			<div class="form-group col-xs-6 col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">1</span>
					<input id="email" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group col-xs-6 col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">2</span>
					<input id="email" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group col-xs-6 col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">3</span>
					<input id="email" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group col-xs-6 col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">4</span>
					<input id="email" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group col-xs-6 col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">5</span>
					<input id="email" type="text" class="form-control">
				</div>
			</div>
			<div class="form-group col-xs-6 col-sm-4">
				<div class="input-group">
					<span class="input-group-addon">6</span>
					<input id="email" type="text" class="form-control">
				</div>
			</div>
			<label class="col-xs-12 col-sm-offset-3 col-sm-6">Enter target number:</label>
			<div class="form-group col-xs-12 col-sm-offset-3 col-sm-6">
				<input id="email" type="text" class="form-control">
			</div>
			<div class="form-group col-xs-12 text-center">
				<button type="submit" class="btn btn-default col-center-block">Submit</button>
			</div>
		</form> 
	</div>
</body>
</html>