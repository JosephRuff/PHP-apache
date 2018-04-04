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
<head>
	<?php 
		include 'head.php';
	?>
	<style>
		td a
		{
			color:inherit;
		}
		td a:hover
		{
			color:inherit;
			text-decoration: none;
		}
		td:hover
		{
			background-color: #D3D3D3;
		}
		td.currentDay:hover
		{
			background-color: #6DABC0;
		}
		td.currentDay
		{
			background-color: #ADD8E6;
		}
	</style>
</head>
<body>
<?php 
	include 'navbar.php';
?>
<div class="container">
<?php 
	include 'upload.php';
?>
</div>
</body>