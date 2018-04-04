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
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
?>
<html>
<head>
	<?php 
		include '../head.php';
	?>
	<style>
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
				comment = comment.replace('[spoiler]', '<div class="panel panel-default"><div class="panel-body"><button type="button" class="btn" data-toggle="collapse" data-target="#spoiler' + spoilerIncrement() + '">Spoiler</button><div id="spoiler' + spoilerCounter + '" class="collapse">');
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
				$("#preview").html('<li class="list-group-item"><div class="media"><div class="media-left"><img src="http://localhost/img_avatar1.png" class="media-object" style="width:60px"></div><div class="media-body"><h4 class="media-heading"><?php echo $user_name; ?></h4><p>' + comment + '</p><small style="float: right">' + (new Date()).getFullYear() + '-' + ((new Date()).getMonth() + 1) + '-' + (new Date()).getDate() + ' ' + (new Date()).getHours() + ':' + (new Date()).getMinutes() + ':' + (new Date()).getSeconds() + '</small></div></div></li>');
			}
			else 
			{
				$("#preview").html("");
			}	
		}
	</script>
</head>
<body>
	<div class="container">
		<div class="panel panel-default">
			<ul id="preview" class="list-group">
			</ul>
			<div class="panel-body">
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
							<form method="post" action="">
								<div class="form-group">
									<label for="subject">Thread subject:</label>
									<input type="text" class="form-control" id="subject" name="subject">
								</div>
								<div class="form-group">
									<label for="comment">Comment:</label>
									<textarea oninput="togglePreview()" class="form-control" rows="5" id="comment" name="comment"></textarea>
								</div> 
								<div class="checkbox">
									<label><input id="previewCheck" type="checkbox" onChange="togglePreview()">Generate preview</label>
								</div>
								<button type="submit" class="btn btn-default">Submit</button>
							</form> 
						');
					}
					else
					{
						$errors = array();
						
						if($_POST['comment'] == "")
						{
							$errors[] = 'The comment field must not be empty.';
						}
						
						if($_POST['subject'] == "")
						{
							$errors[] = 'The subject field must not be empty.';
						}
						
						if(!empty($errors)) 
						{
							echo('
								<form method="post" action="">
									<div class="form-group">
										<label for="subject">Thread subject:</label>
										<input type="text" class="form-control" id="subject" name="subject">
									</div>
									<div class="form-group">
										<label for="comment">Comment:</label>
										<textarea oninput="togglePreview()" class="form-control" rows="5" id="comment" name="comment"></textarea>
									</div> 
									<div class="checkbox">
										<label><input id="previewCheck" type="checkbox" onChange="togglePreview()">Generate preview</label>
									</div>
									<button type="submit" class="btn btn-default">Submit</button>
								</form>
							');
							echo '<ul class="list-group">';
							foreach($errors as $key => $value) 
							{
								echo '<li class="list-group-item list-group-item-danger">' . $value . '</li>'; 
							}
							echo '</ul>';
						}
						else
						{
							$sql = "INSERT INTO threads(thread_subject, thread_date, thread_topic, thread_by) VALUES('" . ($_POST['subject']) . "', NOW(), '" . $topic_id . "', '" . $user_id . "')";
							
							$result = $conn->query($sql);
							
							if(!$result)
							{
								echo '<div class="alert alert-danger">';
								echo '<strong>';
								echo 'Something went wrong.';
								echo '</strong>';
								echo '</div>';
							}
							else
							{
								echo '<div class="alert alert-success">';
								echo '<strong>Successfully posted!</strong>';
								echo '</div>';
								
								$sql = 'SELECT thread_id FROM threads WHERE thread_subject="' . ($_POST['subject']) . '"';
								
								$result2 = $conn->query($sql);
								
								while($row = $result2->fetch_assoc()) 
								{
									$thread_id = $row['thread_id'];
								}
								
								$sql = "INSERT INTO posts(post_content, post_date, post_thread ,post_by) VALUES('" . ($_POST['comment']) . "', NOW(), '" . $thread_id . "', '" . $user_id . "')";
								
								$result2 = $conn->query($sql);
								
								if(!$result2)
								{
									echo '<div class="alert alert-danger">';
									echo '<strong>';
									echo 'Something went wrong.';
									echo '</strong>';
									echo '<a href="http://localhost/newpost.php/?thread=' . $thread_id . '">';
									echo 'Go to thread';
									echo '</a>';
									echo '</div>';
								}
								else
								{
									echo '<div class="alert alert-success">';
									echo '<strong>';
									echo 'Successfully posted!';
									echo '</strong>';
									echo ' <a href="http://localhost/forum/thread.php/?thread=' . $thread_id . '&posts=10&page=1">';
									echo 'Go to thread';
									echo '</a>';
									echo '</div>';
								}
							}
						}
					}
				?>
			
				<div class="panel panel-default">
					<div class="panel-heading">
						Tag Key Guide 
						<button class="btn btn-default btn-xs" style="float: right" data-toggle="collapse" data-target="#help">Show</button>
					</div>
					<div id="help" class="panel-body collapse">
						<div class="container.float col-md-6 col-lg-6">
							[spoiler]Content goes here[/spoiler]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<div class="panel panel-default">
								<div class="panel-body">
									<button type="button" class="btn collapsed" data-toggle="collapse" data-target="#spoiler3" aria-expanded="false">
										Spoiler
									</button>
									<div id="spoiler3" class="collapse" aria-expanded="false" style="height: 0px;">
										Content goes here
									</div>
								</div>
							</div>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[bold]Content goes here[/bold] 
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<strong>Content goes here</strong> 
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[skyblue]skyblue[/skyblue] - [blue]blue[/blue] - [navy]navy[/navy]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:skyblue">skyblue</span> - <span style="color:blue">blue</span> - <span style="color:navy">navy</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[aqua]aqua[/aqua] - [cyan]cyan[/cyan] - [turquoise]turquoise[/turquoise]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:aqua">aqua</span> - <span style="color:cyan">cyan</span> - <span style="color:turquoise">turquoise</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[teal]teal[/teal]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:teal">teal</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[lime]lime[/lime] - [limegreen]limegreen[/limegreen] - [green]green[/green]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:lime">lime</span> - <span style="color:limegreen">limegreen</span> - <span style="color:green">green</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[olive]olive[/olive]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:olive">olive</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[yellow]yellow[/yellow] - [khaki]khaki[/khaki] - [gold]gold[/gold]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:yellow">yellow</span> - <span style="color:khaki">khaki</span> - <span style="color:gold">gold</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[orange]orange[/orange] - [salmon]salmon[/salmon] - [coral]coral[/coral]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:orange">orange</span> - <span style="color:salmon">salmon</span> - <span style="color:coral">coral</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[red]red[/red] - [crimson]crimson[/crimson] - [maroon]maroon[/maroon]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:red">red</span> - <span style="color:crimson">crimson</span> - <span style="color:maroon">maroon</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[pink]pink[/pink] - [hotpink]hotpink[/hotpink]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:pink">pink</span> - <span style="color:hotpink">hotpink</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[magenta]magenta[/magenta]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:magenta">magenta</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[thistle]thistle[/thistle] - [violet]violet[/violet] - [orchid]orchid[/orchid] - [purple]purple[/purple] - [indigo]indigo[/indigo]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:thistle">thistle</span> - <span style="color:violet">violet</span> - <span style="color:orchid">orchid</span> - <span style="color:purple">purple</span> - <span style="color:indigo">indigo</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[silver]silver[/silver] - [gray]gray[/gray] - [grey]grey[/grey] - [dimgray]dimgray[/dimgray] - [dimgrey]dimgray[/dimgrey] 
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:silver">silver</span> - <span style="color:gray">gray</span> - <span style="color:grey">grey</span> - <span style="color:dimgray">dimgray</span> - <span style="color:dimgrey">dimgray</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[tan]tan[/tan] - [sienna]sienna[/sienna] - [brown]brown[/brown]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:tan">tan</span> - <span style="color:sienna">sienna</span> - <span style="color:brown">brown</span>
						</div>
						<hr class="col-md-12 col-lg-12">
						<div class="container.float col-md-6 col-lg-6">
							[red]#####[black]black[/black]#####[/red]
						</div>
						<div class="container.float col-md-6 col-lg-6">
							<span style="color:red">#####<span style="color:black">black</span>#####</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>togglePreview();</script>
</body>
</html>