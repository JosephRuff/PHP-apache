<?php 
	$thread_id = $_GET['thread'];
	$user_id = $_SESSION['user_id'];
?>
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
			<a name="form"></a>
			 <form method="post" action="">
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
		if(!empty($errors)) 
		{
			echo('
				<a name="form"></a>
				<form method="post" action="">
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
			echo '<script>window.location.href="http://localhost/forum/thread.php/?thread=' . $thread_id . '&posts=' . $noOfPosts . '&page=' . $pageNumber . '#form";</script>';
		}
		else
		{
			$sql = "INSERT INTO posts(post_content, post_date, post_thread ,post_by) VALUES('" . ($_POST['comment']) . "', NOW(), '" . $thread_id . "', '" . $user_id . "')";
			
			$result = $conn->query($sql);
			
			if(!$result)
			{
				echo '<div class="alert alert-danger">';
				echo '<strong>';
				echo 'Something went wrong.';
				echo '</strong>';
				echo '<a href="http://localhost/newpost.php/?thread=' . $thread_id . '">';
				echo 'Return to thread';
				echo '</a>';
				echo '</div>';
			}
			else
			{
				echo '<div class="alert alert-success">';
				echo '<strong>';
				echo 'Successfully posted!';
				echo '</strong>';
				echo '</div>';
				echo '<script>window.location.href="http://localhost/forum/thread.php/?thread=' . $thread_id . '&posts=' . $noOfPosts . '&page=' . $pageNumber . '";</script>';
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
	<script>togglePreview();</script>