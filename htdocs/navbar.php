<nav class="navbar navbar-default navbar-static-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="http://localhost">localhost</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		<?php
		if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
		{
			$pagename = basename($_SERVER['PHP_SELF']);
			echo '<ul class="nav navbar-nav">';
			echo '<li><a href="http://localhost/forum/menu.php">Forum</a></li>';
			echo '<li><a href="http://localhost/games/menu.php">Games</a></li>';
			echo '<li><a href="http://localhost/calendar/month.php/?year=' . date('Y') . '&month=' . date('m')  . '">Calendar</a></li>';
			echo '<li><a href="http://localhost/software_developer_resume.pdf">CV</a></li>';
			echo '</ul>';
			
			
		}
		?>
			<ul class="nav navbar-nav navbar-right">
			<?php
			if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
			{
				echo '<li><a href="http://localhost/user.php/?user=' . $_SESSION['user_id'] . '&tab=1"><span class="glyphicon glyphicon-user"></span> ' . $_SESSION['user_name'] . '</li><li><a href="http://localhost/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
			}
			else
			{
				echo '<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
				echo '<li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
			}
			?>
			</ul>
		</div>
	</div>
</nav>