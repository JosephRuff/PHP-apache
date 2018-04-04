<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	$user_id = $_GET['user'];
	$tab = $_GET['tab'];
?>
<html>
<head>
	<?php 
		include 'head.php';
	?>
	<style>
		/* Sticky footer styles
		-------------------------------------------------- */

		html,
		body 
		{
			height: 100%;
			/* The html and body elements cannot have any padding or margin. */
		}

		/* Wrapper for page content to push down footer */
		#wrap 
		{
			min-height: 100%;
			height: auto !important;
			height: 100%;
			/* Negative indent footer by it's height */
			margin: 0 auto -60px;
		}

		/* Set the fixed height of the footer here */
		#push,
		#footer 
		{
			height: 60px;
		}

		/* Lastly, apply responsive CSS fixes as necessary */
		@media (max-width: 767px) 
		{
			#footer 
			{
				margin-left: -20px;
				margin-right: -20px;
				padding-left: 20px;
				padding-right: 20px;
			}
		}
		textarea { resize:vertical; }
	</style>
	<script>
		var spoilerCounter = 0;
		function spoilerIncrement()
		{
			spoilerCounter = spoilerCounter + 1;
			return spoilerCounter;
		}
		function convertColor(text, colorCode)
		{
			while (text.indexOf('[' + colorCode + ']') != -1 && text.indexOf('[/' + colorCode + ']') != -1 && text.indexOf('[/' + colorCode + ']') > text.indexOf('[' + colorCode + ']'))
			{
				text = text.replace('[' + colorCode + ']', '<span style="color:' + colorCode + '">');
				text = text.replace('[/' + colorCode + ']', '</span>');
			}
			return text;
		}
		function togglePreview()
		{
			var comment = $('#comment').val();
			comment = comment.replace(/&/g, '&amp');
			while (comment.indexOf('>') != -1)
			{
				comment = comment.replace('>', '&gt;');
			}
			while (comment.indexOf('<') != -1)
			{
				comment = comment.replace('<', '&lt;');
			}
			while (comment.indexOf('[spoiler]') != -1 && comment.indexOf('[/spoiler]') != -1 && comment.indexOf('[/spoiler]') > comment.indexOf('[spoiler]'))
			{
				comment = comment.replace('[spoiler]', '<div class="panel panel-default"><div class="panel-body"><button type="button" class="btn" data-toggle="collapse" data-target="#spoilerPreview' + spoilerIncrement() + '">Spoiler</button><div id="spoilerPreview' + spoilerCounter + '" class="collapse">');
				comment = comment.replace('[/spoiler]', '</div></div></div>');
			}
			while (comment.indexOf('[bold]') != -1 && comment.indexOf('[/bold]') != -1 && comment.indexOf('[/bold]') > comment.indexOf('[bold]'))
			{
				comment = comment.replace('[bold]', '<strong>');
				comment = comment.replace('[/bold]', '</strong>');
			}
			comment = convertColor(comment, "skyblue");
			comment = convertColor(comment, "blue");
			comment = convertColor(comment, "navy");
			comment = convertColor(comment, "aqua");
			comment = convertColor(comment, "cyan");
			comment = convertColor(comment, "turquoise");
			comment = convertColor(comment, "teal");
			comment = convertColor(comment, "limegreen");
			comment = convertColor(comment, "lime");
			comment = convertColor(comment, "green");
			comment = convertColor(comment, "olive");
			comment = convertColor(comment, "yellow");
			comment = convertColor(comment, "khaki");
			comment = convertColor(comment, "gold");
			comment = convertColor(comment, "orange");
			comment = convertColor(comment, "salmon");
			comment = convertColor(comment, "coral");
			comment = convertColor(comment, "red");
			comment = convertColor(comment, "crimson");
			comment = convertColor(comment, "maroon");
			comment = convertColor(comment, "pink");
			comment = convertColor(comment, "hotpink");
			comment = convertColor(comment, "magenta");
			comment = convertColor(comment, "thistle");
			comment = convertColor(comment, "violet");
			comment = convertColor(comment, "orchid");
			comment = convertColor(comment, "purple");
			comment = convertColor(comment, "indigo");
			comment = convertColor(comment, "silver");
			comment = convertColor(comment, "gray");
			comment = convertColor(comment, "grey");
			comment = convertColor(comment, "dimgray");
			comment = convertColor(comment, "dimgrey");
			comment = convertColor(comment, "tan");
			comment = convertColor(comment, "sienna");
			comment = convertColor(comment, "brown");
			comment = convertColor(comment, "black");
			
			comment = comment.replace(/(?:\r\n|\r|\n)/g, '<br />');
			
			if ($('#previewCheck').is(":checked"))
			{
				$("#preview").html('<div class="media"><div class="media-left"><img src="http://localhost/img_avatar1.png" class="media-object" style="width:60px"></div><div class="media-body" style="text-align: left"><h4 class="media-heading"><?php echo $current_user; ?> <small>(preview comment)</small></h4><p>' + comment + '</p><small style="float: right">' + (new Date()).getFullYear() + '-' + ((new Date()).getMonth() + 1) + '-' + (new Date()).getDate() + ' ' + (new Date()).getHours() + ':' + (new Date()).getMinutes() + ':' + (new Date()).getSeconds() + '</small></div></div><hr>');
			}
			else 
			{
				$("#preview").html("");
			}	
		}
	</script>
	<?php 
		$spoilerCount = 0;
		function spoilerIncrement()
		{
			$GLOBALS['spoilerCount'] = $GLOBALS['spoilerCount'] + 1; 
		}
		function convertColours($color, $text) 
		{
			$pos = strpos($text, '[' . $color . ']');
			$pos2 = strpos($text, '[/' . $color . ']');
			while (strpos($text, '[' . $color . ']') !== false && strpos($text, '[/' . $color . ']') !== false)
			{
				$pos = strpos($text, '[' . $color . ']');
				if ($pos !== false) 
				{
					$text = substr_replace($text, '<span style="color:' . $color . '">', $pos, strlen('[' . $color . ']'));
				}
				$pos2 = strpos($text, '[/' . $color . ']');
				if ($pos2 !== false) 
				{
					$text = substr_replace($text, '</span>', $pos2, strlen('[/' . $color . ']'));
				}
			}
			return $text;
		} 
		function convertText($text)
		{
			while (strpos($text, '<') !== false)
			{
				$pos = strpos($text, '<');
				if ($pos !== false) 
				{
					$text = substr_replace($text, '&lt;', $pos, strlen('<'));
				}
			}
			while (strpos($text, '>') !== false)
			{
				$pos = strpos($text, '>');
				if ($pos !== false) 
				{
					$text = substr_replace($text, '&gt;', $pos, strlen('>'));
				}
			}
			
			return $text;
		}
		function convertTextPost($text)
		{
			convertText($text);
			
			$pos = strpos($text, '[spoiler]');
			$pos2 = strpos($text, '[/spoiler]');
			while (strpos($text, '[spoiler]') !== false && strpos($text, '[/spoiler]') !== false)
			{
				spoilerIncrement();
				$pos = strpos($text, '[spoiler]');
				if ($pos !== false) 
				{
					$text = substr_replace($text, '<div class="panel panel-default"><div class="panel-body"><button type="button" class="btn" data-toggle="collapse" data-target="#spoiler' . $GLOBALS['spoilerCount'] . '">Spoiler</button><div id="spoiler' . $GLOBALS['spoilerCount'] . '" class="collapse">', $pos, strlen('[spoiler]'));
				}
				$pos2 = strpos($text, '[/spoiler]');
				if ($pos2 !== false) 
				{
					$text = substr_replace($text, '</div></div></div>', $pos2, strlen('[/spoiler]'));
				}
			}
			
			while (strpos($text, '[bold]') !== false && strpos($text, '[/bold]') !== false)
			{
				$pos = strpos($text, '[bold]');
				if ($pos !== false) 
				{
					$text = substr_replace($text, '<strong>', $pos, strlen('[bold]'));
				}
				$pos2 = strpos($text, '[/bold]');
				if ($pos2 !== false) 
				{
					$text = substr_replace($text, '</strong>', $pos2, strlen('[/bold]'));
				}
			}
			
			$text = convertColours('blue', $text);
			$text = convertColours('skyblue', $text);
			$text = convertColours('blue', $text);
			$text = convertColours('navy', $text);
			$text = convertColours('aqua', $text);
			$text = convertColours('cyan', $text);
			$text = convertColours('turquoise', $text);
			$text = convertColours('teal', $text);
			$text = convertColours('limegreen', $text);
			$text = convertColours('lime', $text);
			$text = convertColours('green', $text);
			$text = convertColours('olive', $text);
			$text = convertColours('yellow', $text);
			$text = convertColours('khaki', $text);
			$text = convertColours('gold', $text);
			$text = convertColours('orange', $text);
			$text = convertColours('salmon', $text);
			$text = convertColours('coral', $text);
			$text = convertColours('red', $text);
			$text = convertColours('crimson', $text);
			$text = convertColours('maroon', $text);
			$text = convertColours('pink', $text);
			$text = convertColours('hotpink', $text);
			$text = convertColours('magenta', $text);
			$text = convertColours('thistle', $text);
			$text = convertColours('violet', $text);
			$text = convertColours('orchid', $text);
			$text = convertColours('purple', $text);
			$text = convertColours('indigo', $text);
			$text = convertColours('silver', $text);
			$text = convertColours('gray', $text);
			$text = convertColours('grey', $text);
			$text = convertColours('dimgray', $text);
			$text = convertColours('dimgrey', $text);
			$text = convertColours('tan', $text);
			$text = convertColours('sienna', $text);
			$text = convertColours('brown', $text);
			$text = convertColours('black', $text);
			$text = nl2br($text);
			
			return $text;
		}
		function getLowest($a, $b)
		{
			if ($a < $b)
			{
				return $a;
			}
			else
			{
				return $b;
			}
		}
	?>
</head>
	<body>
		<?php 
			include 'navbar.php';
		?>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<?php
							$content = '';
							$tabNames = ['Home', 'Post history', 'Games list'];
							for ($id = 1; $id <= count($tabNames); $id++)
							{
								$content = $content . '<li ';
								if ($id == $tab)
								{
									$content = $content . ' class="active"';
								}
								$content = $content . '>';
								$content = $content . '<a href="http://localhost/user.php/?user=' . $user_id . '&tab=' . $id . '">';
								$content = $content . $tabNames[$id - 1];
								$content = $content . '</a>';
								$content = $content . '</li>';
							}
							echo $content;
						?>
					</ul>
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
						
						$sql = 'SELECT user_name FROM users WHERE user_id="' . $user_id . '"';
						
						$result = $conn->query($sql);
						
						while($row = $result->fetch_assoc()) 
						{
							$user_name = $row["user_name"];
						}
						
						
						$content = '';
						if ($tab == 1)
						{
							$content = $content . '<div class="container">';
							$content = $content . '<br><h4 style="text-align:center">';
							$content = $content . $user_name;
							$content = $content . '</h4><hr>';
							
							
							
							
							$content = $content . '</div>';
						}
						else if ($tab == 2)
						{
							$sql = 'SELECT * FROM posts WHERE post_by="' . $user_id . '" ORDER BY post_date DESC';
						
							$result = $conn->query($sql);
							
							$posts = array();
							
							while($row = $result->fetch_assoc()) 
							{
								array_push($posts, $row);
							}
							$content = $content . '<br><h4 style="text-align:center">Showing all ' . count($posts) . ' posts by ' . $user_name . '</h4>';
							if(count($posts) > 0)
							{
								for($i = 0; $i < count($posts); ++$i)
								{
									$sql = 'SELECT user_name FROM users WHERE user_id="' . $posts[$i]['post_by'] . '"';
									
									$result = $conn->query($sql);
									
									while($row = $result->fetch_assoc()) 
									{
										$user_name_post = convertText($row['user_name']);
									}
									
									$sql = 'SELECT * FROM threads WHERE thread_id="' . $posts[$i]['post_thread'] . '"';
									
									$result = $conn->query($sql);
									
									while($row = $result->fetch_assoc()) 
									{
										$thread_id = convertText($row['thread_id']);
										$thread_subject = convertText($row['thread_subject']);
									}
									
									//convert post_content into html
									$post_content = convertTextPost($posts[$i]['post_content']); 
									
									//
									$content = $content . '<span>';
									$content = $content . '<hr><div class="media">';
									$content = $content . '<div class="media-left"><img src="http://localhost/users/profilepics/profilepic' . $user_id . '.png" class="media-object" style="width:60px"></div>';
									$content = $content . '<div class="media-body" style="text-align: left">';
									$content = $content . '<h4 class="media-heading">' . $user_name_post . '</h4>';
									$content = $content . '<p>' . $post_content . '</p>';
									$content = $content . '<small style="float: right">Posted in <a href="http://localhost/forum/thread.php/?thread=' . $thread_id . '&posts=10&page=1">' . $thread_subject . '</a> at ' . $posts[$i]['post_date'] . '</small>';
									$content = $content . '';
									$content = $content . '</div>';
									$content = $content . '</div>';
									$content = $content . '</span>';
								}
							}
							else
							{
								$content = $content . 'Nothing to see here<hr>';
							}
							
						}
						else if ($tab == 3)
						{
							$content = $content . '<br><h4 style="text-align:center">Showing all games owned by ' . $user_name . '</h4><hr>';
							
							$sql = 'SELECT game_id, game_name FROM boardgames';
		
							$result = $conn->query($sql);
							
							$games = array();
							
							while($row = $result->fetch_assoc()) 
							{
								array_push($games, $row);
							}
							
							if(count($games) > 0)
							{
								$flag = false;
								for($i = 0; $i < count($games); $i++)
								{
									$game_name = $games[$i]["game_name"];
									$game_id = $games[$i]["game_id"];
									
									$sql = 'SELECT COUNT(*) AS total FROM user_boardgame WHERE user_id="' . $user_id . '" AND game_id="' . $game_id . '"';
									
									$result = $conn->query($sql);
									
									while($row = $result->fetch_assoc()) 
									{
										$total = $row['total'];
									}
									
									if ($total > 0)
									{
										$content = $content . '<li><a href="http://localhost/games/game.php/?id=' . $game_id . '&tab=1">';
										$content = $content . $game_name;
										$content = $content . '</a></li>';
										$flag = true;
									}
									
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
											
											$sql = 'SELECT COUNT(*) AS total FROM user_expansion WHERE user_id="' . $user_id . '" AND expansion_id="' . $expansion_id . '"';
											
											$result = $conn->query($sql);
											
											while($row = $result->fetch_assoc()) 
											{
												$total = $row['total'];
											}
											
											if ($total > 0)
											{
												$content = $content . '<li><a href="http://localhost/games/expansion.php/?id=' . $expansion_id . '&tab=1">';
												$content = $content .  $expansion_name;
												$content = $content . '</a></li>';
												$flag = true;
											}
										}
									}
								}
								if($flag != true)
								{
									$content = $content . '<div class="container.float" style="text-align:center"><em>Nothing to see here. </em></div>';
								}
							}
						}
						//post content
						echo $content;
					?>
				</div>
			</div>
			<?php
				if ($tab == 3 && $user_id == $_SESSION['user_id'])
				{
					echo '<div class="panel panel-primary">';
					echo '<div class="panel-heading">';
					echo 'Add / Remove Games';
					echo '<button class="btn btn-default btn-xs" style="float: right" data-toggle="collapse" data-target="#gamesEdit">Show</button>';
					echo '</div>';
					echo '<div id="gamesEdit" class="panel-body collapse">';
					include 'addgames.php';
					include 'removegames.php';
					echo '</div>';
					echo '</div>';
				}
			?>
		</div>
	</body>
</html>