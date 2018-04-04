<?php
	$servername = "localhost";
	$username = "mysqladmin";
	$password = "admin1234";
	$dbname = "mydb";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		$sql = 'SELECT game_id, game_name FROM boardgames';
		
		$result = $conn->query($sql);
		
		$games = array();
		
		while($row = $result->fetch_assoc()) 
		{
			array_push($games, $row);
		}
		echo '<form class="col-md-6" method="post" action="">';
		echo '<div class="form-group">';
		echo '<label for="sel1">';
		echo 'Add games: ';
		echo '</label>';
		echo '<select style="height:50%" onChange="updateList1()" multiple class="form-control" id="sel1" name="select1[]">';
		
		if(count($games) > 0)
		{
			for($i = 0; $i < count($games); $i++)
			{
				$game_name = $games[$i]["game_name"];
				$game_id = $games[$i]["game_id"];
				
				echo '<option id="' . $i . '" value="game-' . $game_id . '">';
				echo $game_name;
				echo '</option>';
				
				$sql = 'SELECT expansion_id, expansion_name FROM expansions WHERE game_id="' . $game_id . '"';
				
				$result = $conn->query($sql);
				
				$expansions = array();
				
				while($row = $result->fetch_assoc()) 
				{
					array_push($expansions, $row);
				}
				
				if(count($expansions) > 0)
				{
					for($j = 0; $j < count($expansions); $j++)
					{
						$expansion_name = $expansions[$j]["expansion_name"];
						$expansion_id = $expansions[$j]["expansion_id"];
						echo '<option id="' . $i . '.' . $j . '" value="xpac-' . $expansion_id . '">';
						echo $expansion_name;
						echo '</option>';
					}
				}
			}
		}
		
		echo '</select>';
		echo '</div>';
		echo '<div class="form-group" style="text-align:center">';
		echo '<button type="submit" class="btn btn-default">';
		echo 'Add';
		echo '</button>';
		echo '</div>';
		echo '</form>';
	}
	else
	{
		$selection = array();
		if (isset($_POST['select1']))
		{
			$selection = $_POST['select1'];
		}
		
		if (count($selection) > 0)
		{
			for($i = 0; $i < count($selection); $i++)
			{				
				$item = explode("-", $selection[$i]);
				
				$id = array_pop($item);
				
				$type = array_pop($item);
				
				if ($type == 'xpac')
				{
					$sql = 'SELECT COUNT(*) AS total FROM user_expansion WHERE user_id="' . $user_id . '" AND expansion_id="' . intval($id) . '"';
					$result = $conn->query($sql);
					
					while($row = $result->fetch_assoc()) 
					{
						$total = $row['total'];
					}
					
					if ($total == 0)
					{
						$sql = 'INSERT INTO user_expansion(user_id, expansion_id) VALUES(' . $user_id . ', ' . intval($id) . ')';
					}
				}
				else
				{
					$sql = 'SELECT COUNT(*) AS total FROM user_boardgame WHERE user_id="' . $user_id . '" AND game_id="' . intval($id) . '"';
					$result = $conn->query($sql);
					
					while($row = $result->fetch_assoc()) 
					{
						$total = $row['total'];
					}
					
					if ($total == 0)
					{
						$sql = 'INSERT INTO user_boardgame(user_id, game_id) VALUES(' . $user_id . ', ' . intval($id) . ')';
					}
				}
				
				$result = $conn->query($sql);
				
				if(!$result)
				{
					echo '<div class="alert alert-danger">';
					echo '<strong>';
					echo 'Something went wrong. ';
					echo $sql;
					echo '</strong>';
					echo '</div>';
				}
				else
				{
					echo '<script>window.location.href="http://localhost/user.php/?user=' . $user_id . '&tab=3";</script>';
				}
			}
		}
		else
		{
			echo '<script>window.location.href="http://localhost/user.php/?user=' . $user_id . '&tab=3";</script>';
		}
	}
?>