<head>
	<?php 
		include 'head.php';
		$min = $_GET['min'];
		$max = $_GET['max'];
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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM boardgames";
$result = $conn->query($sql);




$table = "<div class='table-responsive'><table class='table table-striped'><tr><th>Name</th><th style='text-align:center'>Players</th><th style='text-align:center'>Recommended Players</th><th style='text-align:center'>Best Players</th></tr>";
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
		if(($row["game_players_allowed_min"] <= $max) && ($row["game_players_allowed_max"] >= $min))
		{
			$table = $table . "<tr>";
			$table = $table . "<td><a href='http://localhost/games/game.php/?id=" . $row["game_id"] . "&tab=1'>" . $row["game_name"] ."</a></td>";
			if($row["game_players_allowed_min"] != $row["game_players_allowed_max"])
			{
				$table = $table . "<td style='text-align:center'>" . $row["game_players_allowed_min"] . "/" . $row["game_players_allowed_max"] . "</td>";
			}
			else
			{
				$table = $table . "<td style='text-align:center'>" . $row["game_players_allowed_min"] . "</td>";
			}
			if($row["game_players_recommended_min"] != $row["game_players_recommended_max"])
			{
				$table = $table . "<td style='text-align:center'>" . $row["game_players_recommended_min"] . "/" . $row["game_players_recommended_max"] . "</td>";
			}
			else
			{
				$table = $table . "<td style='text-align:center'>" . $row["game_players_recommended_min"] . "</td>";
			}
			if($row["game_players_best_min"] != $row["game_players_best_max"])
			{
				$table = $table . "<td style='text-align:center'>" . $row["game_players_best_min"] . "/" . $row["game_players_best_max"] . "</td>";
			}
			else
			{
				$table = $table . "<td style='text-align:center'>" . $row["game_players_best_min"] . "</td>";
			}
			$table = $table . "</tr>";
		}
		
		
		$sql = "SELECT * FROM expansions WHERE game_id=" . $row["game_id"];
		$result2 = $conn->query($sql);
		
		if ($result2->num_rows > 0) 
		{
			// output data of each row
			while($row2 = $result2->fetch_assoc())
			{
				if(($row2["expansion_players_allowed_min"] >= $min) && ($row2["expansion_players_allowed_max"] <= $max))
				{
					$table = $table . "<tr>";
					$table = $table . "<td><a href='http://localhost/games/game.php/?id=" . $row["game_id"] . "&tab=1'>" . $row2["expansion_name"] ."</a><small> - Expansion</small></td>";
					if($row2["expansion_players_allowed_min"] != $row2["expansion_players_allowed_max"])
					{
						$table = $table . "<td style='text-align:center'>" . $row2["expansion_players_allowed_min"] . "/" . $row2["expansion_players_allowed_max"] . "</td>";
					}
					else
					{
						$table = $table . "<td style='text-align:center'>" . $row2["expansion_players_allowed_min"] . "</td>";
					}
					if($row2["expansion_players_recommended_min"] != $row2["expansion_players_recommended_max"])
					{
						$table = $table . "<td style='text-align:center'>" . $row2["expansion_players_recommended_min"] . "/" . $row2["expansion_players_recommended_max"] . "</td>";
					}
					else
					{
						$table = $table . "<td style='text-align:center'>" . $row2["expansion_players_recommended_min"] . "</td>";
					}
					if($row2["expansion_players_best_min"] != $row2["expansion_players_best_max"])
					{
						$table = $table . "<td style='text-align:center'>" . $row2["expansion_players_best_min"] . "/" . $row2["expansion_players_best_max"] . "</td>";
					}
					else
					{
						$table = $table . "<td style='text-align:center'>" . $row2["expansion_players_best_min"] . "</td>";
					}
					$table = $table . "</tr>";
				}
			}
		}
    }
} else {
    $table = $table + "<tr><td>0 results</td></tr>";
}
$table = $table . "</table></div>";
echo $table;
$conn->close();
?>
</div>
</body>