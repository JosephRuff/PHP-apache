<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
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
		<div class="container">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Menu 1</a></li>
				<li><a href="#">Menu 2</a></li>
				<li><a href="#">Menu 3</a></li>
			</ul>
			<div class="media">
				<div class="media-left">
					<img src="img_avatar1.png" class="media-object" style="width:60px">
				</div>
				<div class="media-body">
					<h4 class="media-heading">John Doe</h4>
					<p>Lorem ipsum...</p>
				</div>
			</div>
			<hr>

		</div>
	</body>
</html>