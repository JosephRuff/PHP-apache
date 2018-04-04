<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
?>
<html>
<head>
	<?php 
		include '../head.php';
	?>
	<style>
		.list-group #post-item:hover{
			background-color: aliceblue;
		}
		textarea { resize:vertical; }
	</style>
	<script>
		function showCategoryForm()
		{
			if ($('#cat_select').val() == "new")
			{
				$("#cat_form").show();
			}
			else
			{
				$("#cat_form").hide();
			}
		}
	</script>
	<?php 
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
	?>
</head>
<body>
	<?php 
		include '../navbar.php';
	?>
	<div class="container">
		<h1>
			Forum
		</h1>
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
			$sql = "SELECT * FROM categories ORDER BY cat_name";

			$result = $conn->query($sql);
			
			$categories = array();
			
			while($row = $result->fetch_assoc()) 
			{
				array_push($categories, $row);
			}
			
			$content = '<div class="panel panel-default">';
			$content = $content . '<div class="panel-body">';
			
			if (count($categories) > 0) 
			{
				for($i = 0; $i < count($categories); ++$i)
				{
					$cat_name = $categories[$i]['cat_name'];
					
					$content = $content . '<h4>' . $cat_name . '</h4>';
					
					$sql = 'SELECT * FROM topics WHERE topic_cat="' . $categories[$i]['cat_id'] . '" ORDER BY topic_subject';
					
					$result = $conn->query($sql);
					
					$topics = array();
					
					while($row = $result->fetch_assoc()) 
					{
						array_push($topics, $row);
					}
					
					if (count($topics) > 0)
					{
						for($j = 0; $j < count($topics); ++$j)
						{
							$sql = 'SELECT * FROM threads WHERE thread_topic="' . $topics[$j]['topic_id'] . '" ORDER BY thread_date';
							
							$result = $conn->query($sql);
							
							$threads = array();
							
							while($row = $result->fetch_assoc()) 
							{
								array_push($threads, $row);
							}
							
							$topic_subject = $topics[$j]['topic_subject'];
							
							$content = $content . '<div class="panel panel-default">';
							$content = $content . '<div class="panel-heading">';
							$content = $content . $topic_subject;
							$content = $content . ' <a href="http://localhost/forum/topic.php/?topic=' . $topics[$j]['topic_id'] . '">';
							$content = $content . '<span class="label label-default">';
							$content = $content . count($threads) . ' thread';
							if (count($threads) != 1)
							{
								$content = $content . 's';
							}
							$content = $content . '</span>';
							$content = $content . '</a>';
							$content = $content . '</div>';
							
							
							$content = $content . '<ul class="list-group">';
							if(count($threads) > 0)
							{
								for($k = 0; $k < count($threads); ++$k)
								{
									$sql = 'SELECT user_name FROM users WHERE user_id="' . $threads[$k]['thread_by'] . '"';
									
									$result = $conn->query($sql);
									
									while($row = $result->fetch_assoc()) 
									{
										$user_name = $row['user_name'];
									}
									
									$sql = 'SELECT post_id FROM posts WHERE post_thread="' . $threads[$k]['thread_id'] . '"';
									
									$result = $conn->query($sql);
									
									$posts = array();
									while($row = $result->fetch_assoc()) 
									{
										array_push($posts, $row);
									}
									
									$thread_subject = $threads[$k]['thread_subject'];
									
									$content = $content . '<a class="list-group-item" id="post-item" href="http://localhost/forum/thread.php/?thread=' . $threads[$k]['thread_id'] . '&posts=10&page=1">';
									$content = $content . $thread_subject;
									$content = $content . '<small> - ' . $user_name . '</small>';
									$content = $content . '<span class="badge">' . count($posts) . '</span>';
									$content = $content . '</a>';
								}
							}
							else
							{
								$content = $content . '<li class="list-group-item">';
								$content = $content . '<em>There is nothing here</em> - <small><a href="http://localhost/forum/newthread.php/?topic=' . $topics[$j]['topic_id'] . '">Create new thread. </a></small>';
								$content = $content . '</li>';
							}
							
							
							$content = $content . '</ul>';
							$content = $content . '</div>';
						}
					}
				}
			}
			
			$content = $content . '</div>';
			$content = $content . '</div>';
			
			echo($content);
			
			
			
			$conn->close();
		?>
		<?php
			if($_SESSION['user_level'] > 0)
			{
				echo '<a name="form"></a>';
				echo '<div class="panel panel-primary">';
				echo '<div class="panel-heading">';
				echo 'Create new topic: ';
				echo '<button class="btn btn-default btn-xs" style="float: right" data-toggle="collapse" data-target="#newTopic">Show</button>';
				echo '</div>';
				echo '<div id="newTopic" class="panel-body collapse">';
				include 'newtopic.php';
				echo '</div>';
				echo '</div>';
			}
		?>
	</div>
</body>
</html>