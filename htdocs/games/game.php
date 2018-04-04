<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	$id = $_GET['id'];
	$tab = $_GET['tab'];
?>
<html>
<head>
	<?php 
		include '../head.php';
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
			include '../navbar.php';
		?>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="nav nav-tabs">
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
							
							$sql = 'SELECT media_id FROM boardgame_media WHERE game_id="' . $id . '"';
							
							$result = $conn->query($sql);
							
							$media_ids = array();
							
							while($row = $result->fetch_assoc()) 
							{
								$media_ids[] = $row["media_id"];
							}
							
							$sql = 'SELECT * FROM expansions WHERE game_id="' . $id . '"';
							
							$result = $conn->query($sql);
							
							$expansions = array();
							
							while($row = $result->fetch_assoc()) 
							{
								$expansions[] = $row;
							}
							
							$content = '';
							$tabNames = ['Description', 'Rules', 'Expansions', 'Media', 'Links'];
							for ($i = 1; $i <= count($tabNames); $i++)
							{
								$content = $content . '<li ';
								$content = $content . ' class="';
								if ($i == $tab)
								{
									$content = $content . 'active ';
								}
								if ($i == 3)
								{
									if (count($expansions) == 0)
									{
										$content = $content . 'hidden ';
									}
								}
								if ($i == 4)
								{
									if (count($media_ids) == 0)
									{
										$content = $content . 'hidden ';
									}
								}
								$content = $content . '"';
								$content = $content . '>';
								$content = $content . '<a href="http://localhost/games/game.php/?id=' . $id . '&tab=' . $i . '">';
								$content = $content . $tabNames[$i - 1];
								$content = $content . '</a>';
								$content = $content . '</li>';
							}
							echo $content;
						?>
					</ul>
					<?php
						$sql = 'SELECT game_name, description FROM boardgames WHERE game_id="' . $id . '"';
						
						$result = $conn->query($sql);
						
						while($row = $result->fetch_assoc()) 
						{
							$game_name = $row["game_name"];
							$description = $row["description"];
						}
						
						$content = '';
						if($tab == 1)
						{
							$content = $content . '<br><h3 style="text-align:center">';
							$content = $content . convertText($game_name);
							$content = $content . '</h3><hr>';
							$content = $content . convertTextPost($description);
						}
						else if($tab == 3)
						{
							if(count($expansions) > 0)
							{
								echo '<br>';
								echo '<ul>';
								for($i = 0; $i < count($expansions); $i++)
								{
									echo '<li><a href="http://localhost/games/expansion.php/?id=' . $expansions[$i]['expansion_id'] . '&tab=1">';
									echo $expansions[$i]['expansion_name'];
									echo '</a></li>';
								}
								echo '</ul>';
							}
						}
						else if($tab == 4)
						{
							if(count($media_ids) > 0)
							{
								for($i = 0; $i < count($media_ids); $i++)
								{
									$sql = 'SELECT media_src FROM media WHERE media_id="' . $media_ids[$i] . '"';
									
									$result = $conn->query($sql);
									
									while($row = $result->fetch_assoc()) 
									{
										$media_src = $row["media_src"];
									}
									
									if($i == 0)
									{
										echo '<span class="col-xs-12"><br></span>';
									}
									else
									{
										echo '<span class="col-xs-12"><hr></span>';
									}									
									
									echo '<span class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12"><div class="embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="';
									echo $media_src;
									echo '" frameborder="0" allowfullscreen></iframe></div></span>';
								}
							}
						}
						echo $content;
					?>
				</div>
			</div>
		</div>
	</body>
</html>