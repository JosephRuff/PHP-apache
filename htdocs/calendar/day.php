<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	$displayYear = $_GET['year'];
	$displayMonth = $_GET['month'];
	$displayDay = $_GET['day'];
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
	<h3 style="text-align:center">
		<a style="font-size:20px" href="
			<?php
				
			?>
		">
			<span class="glyphicon glyphicon-arrow-left"></span>
		</a>
		<?php 
			echo $displayDay;
			if ($displayDay == 1 || $displayDay == 21 || $displayDay == 31)
			{
				echo 'st';
			}
			else if ($displayDay == 2 || $displayDay == 22)
			{
				echo 'nd';
			}
			else if ($displayDay == 3 || $displayDay == 23)
			{
				echo 'rd';
			}
			else
			{
				echo 'th';
			}
			echo ' of ';
			$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			echo $months[$displayMonth - 1];
			echo ' ';
			echo $displayYear;
		?>
		<a style="font-size:20px" href="
			<?php
				
			?>
		">
			<span class="glyphicon glyphicon-arrow-right"></span>
		</a>
	</h3>
	<div class="panel panel-default">
		<ul class="list-group">
			<a class="list-group-item" id="post-item" href="http://localhost/calendar/event.php/?id=1">
				<span class="text">
					Test Event
					<br>
					<small>
						-Ruffmaestro
					</small>
				</span>
				<span class="badge">
					01:00
				</span>
			</a>
			<a class="list-group-item" id="post-item" href="http://localhost/calendar/event.php/?id=1">
				<span class="text">
					Test Event
					<br>
					<small>
						-Ruffmaestro
					</small>
				</span>
				<span class="badge">
					12:30
				</span>
			</a>
			<a class="list-group-item" id="post-item" href="http://localhost/calendar/event.php/?id=1">
				<span class="text">
					Test Event
					<br>
					<small>
						-Ruffmaestro
					</small>
				</span>
				<span class="badge">
					14:00
				</span>
			</a>
			<a class="list-group-item" id="post-item" href="http://localhost/calendar/event.php/?id=1">
				<span class="text">
					Test Event
					<br>
					<small>
						-Ruffmaestro
					</small>
				</span>
				<span class="badge">
					22:30
				</span>
			</a>
		</ul>
		<div class="panel-footer" style="text-align: center">
			Total of 4 events on 
			<?php 
			echo $displayDay;
			echo '/';
			echo $displayMonth;
			echo '/';
			echo $displayYear;
		?>
		</div>
	</div>
</div>
</body>