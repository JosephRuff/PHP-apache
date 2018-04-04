<?php 
    session_start();
?>
<html>
<head>
	<?php 
		include '../head.php';
	?>
</head>
<body>
	<?php 
		include '../navbar.php';
	?>
	<div class="container">
	<?php
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			echo '<form action = "" method = "POST" enctype = "multipart/form-data">
				<input type = "file" name = "image" />
				<input type = "submit"/>
			</form>';
		}
		else
		{
			$extensions= array("jpeg","jpg","png");

			if(isset($_FILES['image'])){
				$errors= array();
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_tmp = $_FILES['image']['tmp_name'];
				$file_type = $_FILES['image']['type'];
				$value = explode('.',$_FILES['image']['name']);
				$value = end($value);
				$file_ext=strtolower($value);
				
				if(in_array($file_ext,$extensions)=== false){
					$errors[]="File type not allowed";
				}
			  
				if($file_size > 2097152) {
					$errors[]='File size must be under 2 MB';
				}
			  
				if(empty($errors)==true) {
					move_uploaded_file($file_tmp, "profilepics/profilepic" . $_SESSION['user_id'] . "." . $file_ext);
					echo "Success";
					echo '<ul>
						<li>Sent file: ' . $_FILES["image"]["name"] . '
						<li>File size: ' . $_FILES["image"]["size"] . '
						<li>File type: ' . $_FILES["image"]["type"] . '
					</ul>';
				}else{
					print_r($errors);
				}
			}
		}
	?>
	</div>
</body>
</html>