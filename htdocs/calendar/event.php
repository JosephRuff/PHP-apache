<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	$event_id = $_GET['id'];
?>
<head>
	<?php 
		include '../head.php';
	?>
	<style>
		h3 a
		{
			color:black;
		}
		h3 a:hover
		{
			color:black;
			text-decoration: none;
		}
		a.list-group-item 
		{
		  display: flex;
		  align-items: center;
		}
		a.list-group-item:hover
		{
		  background-color:aliceblue;
		}
		a .text 
		{
		  flex: 1;
		}
		a .badge 
		{
		  flex: 0 0 auto;
		}
	</style>
</head>
<body>
	<?php 
		include '../navbar.php';
	?>
	<div class="container">
		<div class="container float clearfix">
			<div class="container float" style="margin-top:5;margin-bottom:5">
				<span class="col-xs-6" style="padding:0">
				<img src="http://localhost/users/profilepics/profilepic21.png" class="media-object" style="width:50px;float:right">
				</span>
				<span class="col-xs-6" style="padding:0;padding-left:5">
				<h4 style="margin-top:8.35;margin-bottom:0">
					Name
				</h4>
				<h4 style="margin-top:0;margin-bottom:8.35"><small>
					Going
				</small></h4>
				</span>
			</div>
			<div class="container float" style="margin-top:5;margin-bottom:5">
				<span class="col-xs-6" style="padding:0">
				<img src="http://localhost/users/profilepics/profilepic21.png" class="media-object" style="width:50px;float:right">
				</span>
				<span class="col-xs-6" style="padding:0;padding-left:5">
				<h4 style="margin-top:8.35;margin-bottom:0">
					Name
				</h4>
				<h4 style="margin-top:0;margin-bottom:8.35"><small>
					Going
				</small></h4>
				</span>
			</div>
			<div class="container float" style="margin-top:5;margin-bottom:5">
				<span class="col-xs-6" style="padding:0">
				<img src="http://localhost/users/profilepics/profilepic21.png" class="media-object" style="width:50px;float:right">
				</span>
				<span class="col-xs-6" style="padding:0;padding-left:5">
				<h4 style="margin-top:8.35;margin-bottom:0">
					Name
				</h4>
				<h4 style="margin-top:0;margin-bottom:8.35"><small>
					Not attending
				</small></h4>
				</span>
			</div>
		</div>
		
	</div>
	</body>