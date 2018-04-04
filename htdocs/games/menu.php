<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
?>
<head>
	<?php 
		include '../head.php';
	?>
	<script>
		function filterTable()
		{
			var playerNo = $( "#sel1" ).val();
			var filterType = $( "#sel2" ).val();
			var str = $( "#search" ).val();
			var check = $( "#sortCheck" ).is(':checked');
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					document.getElementById("tableContent").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "http://localhost/games/getrows.php?playerNo=" + playerNo + "&filterType=" + filterType + "&str=" + str + "&check=" + check, true);
			xmlhttp.send();
		}
		function toggleFilter()
		{
			if($('#sortCheck').is(':checked'))
			{
				$('#sel1').removeAttr('disabled');
				$('#sel2').removeAttr('disabled');
			}
			else
			{
				$('#sel1').attr('disabled', 'disabled');
				$('#sel2').attr('disabled', 'disabled');
			}
		}
	</script>
</head>
<body>
<?php 
	include '../navbar.php';
?>
<div class="container">
<?php
$table = "<div class='table-responsive col-xs-12'><table class='table table-striped'><thead><tr><th>Name</th><th style='text-align:center'>Players</th><th style='text-align:center'>Recommended Players</th><th style='text-align:center'>Best Players</th></tr></thead><tbody id='tableContent'>";

$table = $table . "</tbody></table></div>";
?>

<form class="clearfix">
	<div class="form-group col-sm-6 col-lg-6">
		<label for="search">Search:</label>
		<input type="text" class="form-control" id="search" onkeyup="filterTable();">
	</div>
	<div class="form-group col-sm-3 col-lg-2">
		<label for="sel1">Number of players:</label>
		<select class="form-control" id="sel1" onChange="filterTable();" disabled>
			<?php
				for($i = 1; $i <= 20; $i++)
				{
					echo '<option value="';
					echo $i;
					echo '"';
					if($i == 3)
					{
						echo ' selected';
					}
					echo '>';
					echo $i;
					echo '</option>';
				}
			?>
		</select>
	</div>
	<div class="form-group col-sm-3 col-lg-2">
		<label for="sel2">Filter by:</label>
		<select class="form-control" id="sel2" onChange="filterTable();" disabled>
			<option value="1" selected>Allowed</option>
			<option value="2">Recommended</option>
			<option value="3">Best</option>
		</select>
	</div> 
	<div class="form-group col-sm-12 col-lg-2">
		<div class="checkbox">
			<label><input type="checkbox" id="sortCheck" onChange="toggleFilter(); filterTable();"> Sort by player number</label>
		</div>
	</div>
</form> 
<div class='table-responsive col-xs-12'>
	<table class='table table-condensed table-striped'>
		<thead>
			<tr>
				<th>Name</th>
				<th style='text-align:center'>Players</th>
				<th style='text-align:center'>Recommended Players</th>
				<th style='text-align:center'>Best Players</th>
			</tr>
		</thead>
		<tbody id='tableContent'>
		</tbody>
	</table>
</div>
<?php
	
?>
<script>
	filterTable();
</script>
</div>
</body>