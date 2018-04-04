<?php
	$tableRows = "";
	
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
	
	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			$playerNo = $_GET['playerNo'];
			$filterType = $_GET['filterType'];
			$str = $_GET['str'];
			$check = $_GET['check'];
			if($str == "")
			{
				$str = $row["game_name"];
			}
			if(((($row["game_players_allowed_min"] <= $playerNo) && ($row["game_players_allowed_max"] >= $playerNo) && ($check == 'true') && ($filterType == 1)) || (($row["game_players_recommended_min"] <= $playerNo) && ($row["game_players_recommended_max"] >= $playerNo) && ($check == 'true') && ($filterType == 2)) || (($row["game_players_best_min"] <= $playerNo) && ($row["game_players_best_max"] >= $playerNo) && ($check == 'true') && ($filterType == 3)) || ($check == 'false')) && ((strpos(strtolower($row["game_name"]), strtolower($str)) !== false)))
			{
				$tableRows = $tableRows . "<tr>";
				$tableRows = $tableRows . "<td><a href='http://localhost/games/game.php/?id=" . $row["game_id"] . "&tab=1'>" . $row["game_name"] ."</a></td>";
				if($row["game_players_allowed_min"] != $row["game_players_allowed_max"])
				{
					$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row["game_players_allowed_min"] . "/" . $row["game_players_allowed_max"] . "</td>";
				}
				else
				{
					$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row["game_players_allowed_min"] . "</td>";
				}
				if($row["game_players_recommended_min"] != $row["game_players_recommended_max"])
				{
					$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row["game_players_recommended_min"] . "/" . $row["game_players_recommended_max"] . "</td>";
				}
				else
				{
					$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row["game_players_recommended_min"] . "</td>";
				}
				if($row["game_players_best_min"] != $row["game_players_best_max"])
				{
					$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row["game_players_best_min"] . "/" . $row["game_players_best_max"] . "</td>";
				}
				else
				{
					$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row["game_players_best_min"] . "</td>";
				}
				$tableRows = $tableRows . "</tr>";
			}
			
			
			$sql = "SELECT * FROM expansions WHERE game_id=" . $row["game_id"];
			$result2 = $conn->query($sql);
			
			if ($result2->num_rows > 0) 
			{
				// output data of each row
				while($row2 = $result2->fetch_assoc())
				{
					if(((($row2["expansion_players_allowed_min"] <= $playerNo) && ($row2["expansion_players_allowed_max"] >= $playerNo) && ($check == 'true') && ($filterType == 1)) || (($row2["expansion_players_recommended_min"] <= $playerNo) && ($row2["expansion_players_recommended_max"] >= $playerNo) && ($check == 'true') && ($filterType == 2)) || (($row2["expansion_players_best_min"] <= $playerNo) && ($row2["expansion_players_best_max"] >= $playerNo) && ($check == 'true') && ($filterType == 3)) || ($check == 'false')) && (strpos(strtolower($row2["expansion_name"]), strtolower($str)) !== false))
					{
						$tableRows = $tableRows . "<tr>";
						$tableRows = $tableRows . "<td><a href='http://localhost/games/expansion.php/?id=" . $row2["expansion_id"] . "&tab=1'>" . $row2["expansion_name"] ."</a><small> - Expansion</small></td>";
						if($row2["expansion_players_allowed_min"] != $row2["expansion_players_allowed_max"])
						{
							$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row2["expansion_players_allowed_min"] . "/" . $row2["expansion_players_allowed_max"] . "</td>";
						}
						else
						{
							$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row2["expansion_players_allowed_min"] . "</td>";
						}
						if($row2["expansion_players_recommended_min"] != $row2["expansion_players_recommended_max"])
						{
							$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row2["expansion_players_recommended_min"] . "/" . $row2["expansion_players_recommended_max"] . "</td>";
						}
						else
						{
							$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row2["expansion_players_recommended_min"] . "</td>";
						}
						if($row2["expansion_players_best_min"] != $row2["expansion_players_best_max"])
						{
							$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row2["expansion_players_best_min"] . "/" . $row2["expansion_players_best_max"] . "</td>";
						}
						else
						{
							$tableRows = $tableRows . "<td style='vertical-align: middle; text-align:center'>" . $row2["expansion_players_best_min"] . "</td>";
						}
						$tableRows = $tableRows . "</tr>";
					}
				}
			}
		}
	}
	if($tableRows == "")
	{
		$tableRows = '<tr><td style="vertical-align: middle; text-align:center">No results</td><td style="vertical-align: middle; text-align:center"> - </td><td style="vertical-align: middle; text-align:center"> - </td><td style="vertical-align: middle; text-align:center"> - </td></tr>';
	}
	echo $tableRows;
?>