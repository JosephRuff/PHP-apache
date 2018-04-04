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
	<div class="container">
	<?php
		$servername = "localhost";
		$username = "mysqladmin";
		$password = "admin1234";
		$dbname = "mydb";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		} 
		
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo('
				<form  method="post" action="">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="user" name="user" placeholder="Enter username">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="pwd-check" name="pwd-check" placeholder="Confirm password">
					</div>
					<br>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			');
		}
		else
		{
			$errors = array();
			
			if(!$_POST['email'] == "")
			{
				
			}
			else
			{
				$errors[] = 'The <strong>email</strong> field must not be empty.';
			}
			
			if(!$_POST['user'] == "")
			{
				if(!ctype_alnum($_POST['user']))
				{
					$errors[] = 'The <strong>username</strong> can only contain letters and digits.';
				}
				if(strlen($_POST['user']) > 30)
				{
					$errors[] = 'The <strong>username</strong> cannot be longer than 30 characters.';
				}
			}
			else
			{
				$errors[] = 'The <strong>username</strong> field must not be empty.';
			}
			
			if(!$_POST['pwd'] == "")
			{
				if($_POST['pwd'] != $_POST['pwd-check'])
				{
					$errors[] = 'The two <strong>passwords</strong> did not match.';
				}
			}
			else
			{
				$errors[] = 'The <strong>password</strong> field cannot be empty.';
			}
			
			if(!empty($errors)) 
			{
				echo('
					<form  method="post" action="">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="user" name="user" placeholder="Enter username">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="pwd-check" name="pwd-check" placeholder="Confirm password">
					</div>
					<br>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
				');
				echo '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>One or more things were entered incorrectly</h4><ul>';
				foreach($errors as $key => $value) 
				{
					echo '<li>' . $value . '</li>'; 
				}
				echo '</ul></div>';
			}
			else
			{
				$sql = "INSERT INTO
							users(user_name, user_pass, user_email ,user_date, user_level)
						VALUES('" . ($_POST['user']) . "',
							   '" . sha1($_POST['pwd']) . "',
							   '" . ($_POST['email']) . "',
								NOW(),
								0)";
				$result = $conn->query($sql);
				if(!$result)
				{
					echo '<div class="alert alert-danger"><strong>Something went wrong.</strong> Please try again later.</div>';
				}
				else
				{
					echo '<div class="alert alert-success"><strong>Successfully registered!</strong> You can now <a href="signin.php">sign in</a> and start posting!</div>';
				}
			}
		}
	?>
	</div>
</body>
</html>