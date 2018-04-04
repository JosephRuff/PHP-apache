<?php 
    session_start();
?>
<html>
<?php 
	include 'head.php';
?>
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
		
		if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
		{
			echo '<div class="alert alert-danger">You are already signed in as ' . $_SESSION['user_name'] . '.</div>';
		}
		else
		{
			if($_SERVER['REQUEST_METHOD'] != 'POST')
			{
				echo('
					<form  method="post" action="">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control" id="user" name="user" placeholder="Username">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
						</div>
						<br>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				');
			}
			else
			{
				$errors = array();
				
				if(!$_POST['user'] == "")
				{
					if(!ctype_alnum($_POST['user']))
					{
						$errors[] = 'The username can only contain letters and digits.';
					}
					if(strlen($_POST['user']) > 30)
					{
						$errors[] = 'The username cannot be longer than 30 characters.';
					}
				}
				else
				{
					$errors[] = 'The username field must not be empty.';
				}
				
				if(!$_POST['pwd'] == "")
				{

				}
				else
				{
					$errors[] = 'The password field cannot be empty.';
				}
				
				if(!empty($errors)) 
				{
					echo('
						<form  method="post" action="">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" id="user" name="user" placeholder="Username">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
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
					 $sql = "SELECT 
								user_id,
								user_name,
								user_level
							FROM
								users
							WHERE
								user_name = '" . ($_POST['user']) . "'
							AND
								user_pass = '" . sha1($_POST['pwd']) . "'";
					
					$result = $conn->query($sql);
					if(!$result)
					{
						echo '<div class="alert alert-danger"><strong>Something went wrong while signing in.</strong> Please try again later.</div>';
					}
					else
					{
						if(mysqli_num_rows($result) == 0)
						{
							echo '<div class="alert alert-danger">Username or password was incorrect. </div';
						}
						else
						{
							$_SESSION['signed_in'] = true;
							
							while($row = $result->fetch_assoc())
							{
								$_SESSION['user_id'] = $row['user_id'];
								$_SESSION['user_name'] = $row['user_name'];
								$_SESSION['user_level'] = $row['user_level'];
							}
							
							header('Location: http://localhost/forum/menu.php');
						}
					}
				}
			}
		}
	?>
	</div>
</body>
</html>