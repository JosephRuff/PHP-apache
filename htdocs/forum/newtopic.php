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
						echo '<form method="post" action="">';
						echo '<div class="form-group">';
						echo '<label for="topic_name">Topic Name:</label>';
						echo '<input type="text" class="form-control" id="topic_name" name="topic_name">';
						echo '</div>';
						echo '<div class="form-group">';
						echo '<label for="description">Description:</label>';
						echo '<textarea class="form-control" rows="5" id="description" name="description"></textarea>';
						echo '</div>';
						echo '<div class="form-group">';
						echo '<label for="sel1">Select list:</label>';
						echo '<select class="form-control" onChange="showCategoryForm()" id="cat_select" name="cat_select">';
						echo '<option selected="selected" value="-1" disabled hidden>Choose a Category</option>';
						
						$sql = 'SELECT * FROM categories ORDER BY cat_name';
						
						$result = $conn->query($sql);
						
						$categories = array();
						
						while($row = $result->fetch_assoc()) 
						{
							array_push($categories, $row);
						}
						
						if (count($categories) > 0)
						{
							for($i = 0; $i < count($categories); ++$i)
							{
								echo '<option value="' . $categories[$i]["cat_id"] . '">';
								echo convertText($categories[$i]["cat_name"]);
								echo '</option>';
							}
						}
						echo '<option disabled></option>';
						echo '<option value="new">New Category</option>';
						echo '</select>';
						echo '</div>';
						echo '<div id="cat_form" class="form-group" style="display: none">';
						echo '<hr>';
						echo '<label for="cat_name">Category Name:</label>';
						echo '<input type="text" class="form-control" id="cat_name" name="cat_name">';
						echo '</div>';
						echo '<hr>';
						echo '<button type="submit" class="btn btn-default">Submit</button>';
						echo '</form>';
					}
					else
					{
						$errors = array();
						
						if($_POST['topic_name'] == "")
						{
							$errors[] = 'The topic name field must not be empty.';
						}
						
						if (isset($_POST['cat_select']))
						{
							if($_POST['cat_select'] == "-1")
							{
								$errors[] = 'You must pick a category';
							}
							
							if($_POST['cat_select'] == "new")
							{
								if($_POST['cat_name'] == "")
								{
									$errors[] = 'The category name field must not be empty.';
								}
							}
						}
						else
						{
							$errors[] = 'You must pick a category';
						}
						
						if(!empty($errors)) 
						{
							echo '<form method="post" action="">';
							echo '<div class="form-group">';
							echo '<label for="topic_name">Topic Name:</label>';
							echo '<input type="text" class="form-control" id="topic_name" name="topic_name">';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<label for="description">Description:</label>';
							echo '<textarea class="form-control" rows="5" id="description" name="description"></textarea>';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<label for="sel1">Select list:</label>';
							echo '<select class="form-control" onChange="showCategoryForm()" id="cat_select" name="cat_select">';
							echo '<option selected="selected" value="-1" disabled hidden>Choose a Category</option>';
							
							$sql = 'SELECT * FROM categories ORDER BY cat_name';
							
							$result = $conn->query($sql);
							
							$categories = array();
							
							while($row = $result->fetch_assoc()) 
							{
								array_push($categories, $row);
							}
							
							if (count($categories) > 0)
							{
								for($i = 0; $i < count($categories); ++$i)
								{
									echo '<option value="' . $categories[$i]["cat_id"] . '">';
									echo convertText($categories[$i]["cat_name"]);
									echo '</option>';
								}
							}
							echo '<option disabled></option>';
							echo '<option value="new">New Category</option>';
							echo '</select>';
							echo '</div>';
							echo '<div id="cat_form" class="form-group" style="display: none">';
							echo '<hr>';
							echo '<label for="cat_name">Category Name:</label>';
							echo '<input type="text" class="form-control" id="cat_name" name="cat_name">';
							echo '</div>';
							echo '<hr>';
							echo '<button type="submit" class="btn btn-default">Submit</button>';
							echo '</form>';
							echo '<ul class="list-group">';
							foreach($errors as $key => $value) 
							{
								echo '<li class="list-group-item list-group-item-danger">' . $value . '</li>'; 
							}
							echo '</ul>';
							echo '<script>window.location.href="http://localhost/forum/menu.php#form";</script>';
						}
						else
						{
							if (($_POST['cat_select']) == "new")
							{
								$sql = "INSERT INTO categories(cat_name) VALUES('" . ($_POST['cat_name']) . "')";
								
								$result = $conn->query($sql);
								
								if(!$result)
								{
									echo '<div class="alert alert-danger"><strong>Something went wrong creating the category.</strong></div>';
								}
								else
								{
									echo '<div class="alert alert-success"><strong>Category successfully created.</strong></div>';
								}
								
								$sql = 'SELECT cat_id FROM categories WHERE cat_name="' . ($_POST['cat_name']) . '"';
								
								$result = $conn->query($sql);
								
								if(!$result)
								{
									echo '<div class="alert alert-danger"><strong>Something went wrong finding the new category.</strong></div>';
								}
								else
								{
									while($row = $result->fetch_assoc()) 
									{
										$cat_id = $row['cat_id'];
										echo '<div class="alert alert-success"><strong>New category id found.</strong></div>';
									}
								}
							}
							else 
							{
								$cat_id = ($_POST['cat_select']);
							}
							
							$sql = "INSERT INTO topics(topic_subject, topic_description, topic_cat, topic_by) VALUES('" . ($_POST['topic_name']) . "', '" . ($_POST['description']) . "', '" . $cat_id . "', '" . $user_id . "')";
							
							$result = $conn->query($sql);
							
							if(!$result)
							{
								echo '<div class="alert alert-danger"><strong>Something went wrong.</strong></div>';
							}
							else
							{
								echo '<div class="alert alert-success"><strong>Topic successfully created.</strong></div>';
								echo '<script>window.location.href="http://localhost/forum/menu.php";</script>';
							}
						}
					}
				?>