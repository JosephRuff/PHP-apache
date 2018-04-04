<?php 
	session_start();
	
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	
	$thread_id = $_GET['thread'];
	$pageNumber = $_GET['page'];
	$noOfPosts = $_GET['posts'];
	$current_user = $_SESSION['user_name'];
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
				$("#preview").html('<div class="media"><div class="media-left"><img src="http://localhost/users/profilepics/profilepic<?php echo $_SESSION['user_id']; ?>.png" class="media-object" style="width:60px"></div><div class="media-body" style="text-align: left"><h4 class="media-heading"><?php echo $current_user; ?> <small>(preview comment)</small></h4><p>' + comment + '</p><small style="float: right">' + (new Date()).getFullYear() + '-' + ((new Date()).getMonth() + 1) + '-' + (new Date()).getDate() + ' ' + (new Date()).getHours() + ':' + (new Date()).getMinutes() + ':' + (new Date()).getSeconds() + '</small></div></div><hr>');
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
	<div id="wrap">
		<?php 
			include '../navbar.php';
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
				
				$sql = 'SELECT * FROM threads WHERE thread_id="' . $thread_id . '"';
				
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()) 
				{
					$thread_subject = convertText($row['thread_subject']);
					$thread_date = $row['thread_date'];
					$thread_topic = $row['thread_topic'];
					$thread_by = $row['thread_by'];
				}
				
				$sql = 'SELECT * FROM posts WHERE post_thread="' . $thread_id . '" ORDER BY post_date';
			
				$result = $conn->query($sql);
				
				$posts = array();
				
				while($row = $result->fetch_assoc()) 
				{
					array_push($posts, $row);
				}
				//create panel
				$content = '<div class="panel panel-default"><div class="panel-body" style="text-align: center">';
				
				//header
				$content = $content . '<h4>' . $thread_subject . '</h4>';
				
				//calculate posts to display based on number of posts per page and page number
				$firstPostIndex = ($pageNumber - 1) * $noOfPosts;
				$lastPostIndex = getLowest(($noOfPosts * $pageNumber) - 1, count($posts) - 1);
				
				if(count($posts) > 0)
				{
					$content = $content . '<small>';
					$content = $content . 'Showing posts ';
					//first post number
					$content = $content . ($firstPostIndex + 1);
					$content = $content . ' to ';
					//last post number
					$content = $content . ($lastPostIndex + 1);
					$content = $content . ' out of ';
					//number of posts
					$content = $content . count($posts);
					$content = $content . '</small><hr>';
					
					for($i = $firstPostIndex; $i <= $lastPostIndex; ++$i)
					{
						$user_id = $posts[$i]['post_by'];
						$sql = 'SELECT user_name FROM users WHERE user_id="' . $user_id . '"';
						
						$result = $conn->query($sql);
						
						while($row = $result->fetch_assoc()) 
						{
							$user_name = convertText($row['user_name']);
						}
						
						//convert post_content into html
						$post_content = convertTextPost($posts[$i]['post_content']); 
						
						//
						$content = $content . '<span>';
						$content = $content . '<div class="media">';
						$content = $content . '<div class="media-left"><img src="http://localhost/users/profilepics/profilepic' . $user_id . '.png" class="media-object" style="width:60px"></div>';
						$content = $content . '<div class="media-body" style="text-align: left">';
						$content = $content . '<h4 class="media-heading"><a href="http://localhost/user.php/?user=' . $user_id . '&tab=2">' . $user_name . '</a></h4>';
						$content = $content . '<p>' . $post_content . '</p>';
						$content = $content . '<small style="float: right">' . $posts[$i]['post_date'] . '</small>';
						$content = $content . '';
						$content = $content . '</div>';
						$content = $content . '</div><hr>';
						$content = $content . '</span>';
					}
					$content = $content . '<span id="preview"><hr></span>';
				}
				else
				{
					$content = $content . 'Nothing to see here<hr>';
				}
				
				if(count($posts) > 0)
				{
					$content = $content . '<span style="display: flex; align-items: center;">';
					$content = $content . '<span class="col-sm-offset-3 col-sm-6 col-xs-6">';
					
					//add pagination
					$content = $content . '<ul class="pagination pagination-sm">';
					//for every page add a pagination button
					for ($i = 1; $i <= ceil(count($posts) / $noOfPosts); $i++)
					{
						$content = $content . '<li ';
						if ($i == $pageNumber)
						{
							$content = $content . 'class="active"';
						}
						$content = $content . '>';
						
						$content = $content . '<a href="http://localhost/forum/thread.php/?thread=' . $thread_id . '&posts=' . $noOfPosts . '&page=' . $i . '">' . $i . '</a>';
						$content = $content . '</li>';
					}
					$content = $content . '</ul>';
					$content = $content . '</span>';
					$content = $content . '<span class="col-xs-6 col-sm-3">';
					//add dropdown selector
					$content = $content . '<form class="form-inline" style="width:100%; margin:auto">';
					$content = $content . '<select class="form-control">';
					
					$options = array(5, 10, 25, 50);
					
					for ($i = 0; $i < count($options); $i++)
					{
						$optionNumber = $options[$i];
						
						$content = $content . '<option onclick="javascript:location.href=\'http://localhost/forum/thread.php/?thread=' . $thread_id . '&posts=' . $optionNumber . '&page=1\'"';
						if ($noOfPosts == $optionNumber)
						{
							$content = $content . ' selected';
						}
						$content = $content . '>';
						$content = $content . $optionNumber;
						$content = $content . ' posts per page</option>';
					}
					$content = $content . '</select></form>';
					$content = $content . '</span></span>';
				
					$content = $content . '<small>';
					$content = $content . 'Showing posts ';
					//first post number
					$content = $content . ($firstPostIndex + 1);
					$content = $content . ' to ';
					//last post number
					$content = $content . ($lastPostIndex + 1);
					$content = $content . ' out of ';
					//number of posts
					$content = $content . count($posts);
					$content = $content . '</small>';
				}
				
				
				
				//close panel
				$content = $content . '</div></div>';
				
				//post content
				echo $content;
				include 'newpost.php';
			?>
		</div>
		<br>
		<br>
		<br>
	</div>
	<div id="footer">
		<nav class="breadcrumb">
			<li>
				<a href="http://localhost/forum/menu.php">Home</a>
			</li>
			<?php
				$sql = 'SELECT topic_subject FROM topics WHERE topic_id="' . $thread_topic . '"';
			
				$result = $conn->query($sql);
				
				if(!$result)
				{
					
				}
				while($row = $result->fetch_assoc()) 
				{
					$topic_subject = convertText($row['topic_subject']);
				}
			?>
			<li>
				<a href="http://localhost/forum/topic.php/?topic=<?php echo $thread_topic; ?>"><?php echo $topic_subject; ?></a>
			</li>
			<li class="active"><?php echo $thread_subject; ?></li>
		</nav>
	</div>
</body>
</html>