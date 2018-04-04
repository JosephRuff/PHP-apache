<?php 
	session_start();
	
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	
	$topic_id = $_GET['topic'];
?>
<html>
<head>
	<?php 
		include '../head.php';
	?>
	<style>
		a.list-group-item 
		{
		  display: flex;
		  align-items: center;
		}
		a .text 
		{
		  flex: 1;
		}
		a .badge 
		{
		  flex: 0 0 auto;
		}
		
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
		.list-group #post-item:hover{
			background-color: aliceblue;
		}
	</style>
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
				if ($conn->connect_error) 
				{
					die("Connection failed: " . $conn->connect_error);
				}
				
				//get topic subject and description
				$sql = 'SELECT topic_subject, topic_description FROM topics WHERE topic_id="' . $topic_id . '"';
				
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()) 
				{
					$topic_name = convertText($row['topic_subject']);
					$topic_description = convertText($row['topic_description']);
				}
				
				//create header
				$content = '<h1>' . $topic_name . '</h1>';
				//create sub header
				$content = $content . '<h4>' . $topic_description . '<small> - <a href="http://localhost/forum/newthread.php/?topic=' . $topic_id . '">Create new thread. </a></small></h4>';
				
				//create panel
				$content = $content . '<div class="panel panel-default">';
				
				//get threads
				$sql = 'SELECT * FROM threads WHERE thread_topic="' . $topic_id . '" ORDER BY thread_date';
				
				$result = $conn->query($sql);
				
				$threads = array();
				
				while($row = $result->fetch_assoc()) 
				{
					array_push($threads, $row);
				}
				
				if (count($threads) > 0)
				{
					$content = $content . '<ul class="list-group">';
					//for every thread
					for($i = 0; $i < count($threads); ++$i)
					{
						//get user name of thread creator
						$sql = 'SELECT user_name FROM users WHERE user_id="' . $threads[$i]['thread_by'] . '"';
						
						$result = $conn->query($sql);

						while($row = $result->fetch_assoc()) 
						{
							$user_name = convertText($row['user_name']);
						}
						
						//get number of posts in thread
						$sql = 'SELECT post_id FROM posts WHERE post_thread="' . $threads[$i]['thread_id'] . '"';
						
						$result = $conn->query($sql);
						
						$posts = array();
						
						while($row = $result->fetch_assoc()) 
						{
							array_push($posts, $row);
						}
						
						$thread_subject = convertText($threads[$i]['thread_subject']);
						
						//create thread item
						$content = $content . '<a class="list-group-item" id="post-item" href="http://localhost/forum/thread.php/?thread=' . $threads[$i]['thread_id'] . '&posts=10&page=1">';
						$content = $content . '<span class="text">';
						$content = $content . $thread_subject;
						$content = $content . '<br>';
						$content = $content . '<small>';
						$content = $content . '-' . $user_name;
						$content = $content . '</small>';
						$content = $content . '</span>';
						$content = $content . '<span class="badge">';
						$content = $content . count($posts);
						$content = $content . '</span>';
						$content = $content . '</a>';
					}
					$content = $content . '</ul>';
					//create footer
					$content = $content . '<div class="panel-footer" style="text-align: center">';
					$content = $content . 'Showing ' . count($threads) . ' of ' . count($threads) . ' threads';
					$content = $content . '</div>';
				}
				else 
				{
					$content = $content . '<ul class="list-group">';
					$content = $content . '<li class="list-group-item">';
					$content = $content . '<em>There is nothing to see here</em>';
					$content = $content . '</li>';
					$content = $content . '</ul>';
				}
				
				//close panel
				$content = $content . '</div>';
				//display content
				echo $content;
			?>
		</div>
		<br>
		<br>
		<br>
	</div>
	<div id="footer">
		<nav class="breadcrumb navbar-static-bottom">
			<li>
				<a href="http://localhost/forum/menu.php">Home</a>
			</li>
			<li class="active">
				<?php echo $topic_name; ?>
			</li>
		</nav>
	</div>
</body>
</html>