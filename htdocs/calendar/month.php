<?php 
	session_start();
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
	{
		
	}
	else
	{
		header('Location: http://localhost');
	}
	$displayYear = $_GET['year'];
	$displayMonth = $_GET['month'];
?>
<head>
	<?php 
		include '../head.php';
	?>
	<style>
		td a
		{
			color:inherit;
		}
		td a:hover
		{
			color:inherit;
			text-decoration: none;
		}
		td:hover
		{
			background-color: #D3D3D3;
		}
		td.currentDay:hover
		{
			background-color: #6DABC0;
		}
		td.currentDay
		{
			background-color: #ADD8E6;
		}
	</style>
</head>
<body>
<?php 
	include '../navbar.php';
?>
<div class="container">
<?php
	$currentDay = date('d'); 
	$currentMonth = date('m'); 
	$currentYear = date('Y'); 
	$i = 1;
	for($year = 2000; $year <= $currentYear + 10; $year++)
	{
		for($month = 1; $month <= 12; $month++)
		{
			if (($displayYear == $year) && ($displayMonth == $month))
			{
				echo '<div class="container.float" style="min-width:730px">';
				echo '<div class="container.float col-xs-12">';
				echo '<div class="container.float col-xs-4">';
				echo '<ul style="margin-bottom:10px" class="pager" ';
				if($displayMonth == 1 && $displayYear == 2010)
				{
					echo 'hidden';
				}
				echo '>';
				echo '<li class="previous">';
				echo '<a href="';
				if ($displayMonth == 1)
				{
					echo 'http://localhost/calendar/month.php/?year=' . ($displayYear - 1) . '&amp;month=' . 12;
				}
				else
				{
					echo 'http://localhost/calendar/month.php/?year=' . $displayYear . '&amp;month=' . ($displayMonth - 1);
				}
				echo '">';
				echo 'Previous';
				echo '</a>';
				echo '</li>';
				echo '</ul>';
				echo '</div>';
				echo '<div style="text-align:center;" class="container.float col-xs-4">';
				echo '<h4 style="margin-top:20px; margin-bottom:10px; padding-top:5.1px; padding-bottom:5.1px; ">';
				$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				echo $months[$month - 1];
				echo ' - ';
				echo $year;
				echo '</h4>';
				echo '</div>';
				echo '<div class="container.float col-xs-4">';
				echo '<ul style="margin-bottom:10px" class="pager" ';
				if($displayMonth == 12 && $displayYear == ($currentYear + 10))
				{
					echo 'hidden';
				}
				echo '>';
				echo '<li class="next">';
				echo '<a href="';
				if ($displayMonth == 12)
				{
					echo 'http://localhost/calendar/month.php/?year=' . ($displayYear + 1) . '&amp;month=' . 1;
				}
				else
				{
					echo 'http://localhost/calendar/month.php/?year=' . $displayYear . '&amp;month=' . ($displayMonth + 1);
				}
				echo '">';
				echo 'Next';
				echo '</a>';
				echo '</li>';
				echo '</ul>';
				echo '</div>';
				echo '</div>';
				echo '<table class="table table-bordered table-striped">';
				echo '<thead>
						<tr>
							<th class="col-xs-1" style="text-align:center">Mon</th>
							<th class="col-xs-1" style="text-align:center">Tue</th>
							<th class="col-xs-1" style="text-align:center">Wed</th>
							<th class="col-xs-1" style="text-align:center">Thur</th>
							<th class="col-xs-1" style="text-align:center">Fri</th>
							<th class="col-xs-1" style="text-align:center">Sat</th>
							<th class="col-xs-1" style="text-align:center">Sun</th>
						</tr>
					</thead>';
					echo '<tbody>';
			}
			if($month == 1)
			{
				$monthLength = 31;
			}
			else if($month == 2)
			{
				$monthLength = 28;
				
				if($year %4 != 0)
				{
					$monthLength = 28;
				}
				else if($year %100 != 0)
				{
					$monthLength = 29;
				}
				else if($year %400 != 0)
				{
					$monthLength = 28;
				}
				else
				{
					$monthLength = 29;
				}
			}
			else if($month == 3)
			{
				$monthLength = 31;
			}
			else if($month == 4)
			{
				$monthLength = 30;
			}
			else if($month == 5)
			{
				$monthLength = 31;
			}
			else if($month == 6)
			{
				$monthLength = 30;
			}
			else if($month == 7)
			{
				$monthLength = 31;
			}
			else if($month == 8)
			{
				$monthLength = 31;
			}
			else if($month == 9)
			{
				$monthLength = 30;
			}
			else if($month == 10)
			{
				$monthLength = 31;
			}
			else if($month == 11)
			{
				$monthLength = 30;
			}
			else if($month == 12)
			{
				$monthLength = 31;
			}
			echo '<tr>'; 
			$monthFlag = true; 
			for($day = 1; $day <= $monthLength; $day++)
			{
				if(($year == 2000) && ($month == 1) && ($day == 1))
				{
					$i = 5;
				}
				if($i > 7)
				{
					$i = 1;
				}
				if (($displayYear == $year) && ($displayMonth == $month))
				{
					if ($monthFlag)
					{
						for ($j = 1; $j < $i; $j++)
						{
							echo '<td></td>'; 
						}
						$monthFlag = false; 
					}
					echo '<td style="vertical-align:middle; padding:0;"'; 
					if (($currentDay == $day) && ($currentMonth == $month) && ($currentYear == $year))
					{
						echo ' class="currentDay"'; 
					}
					echo '>'; 
					echo '<a style="display:block; padding:8px;" href="http://localhost/calendar/day.php/?year=' . $year . '&month=' . $month . '&day=' . $day . '">'; 
					echo '<strong>'; 
					echo $day;
					echo '</strong>'; 
					echo '<span style="float:right; margin:2.425" class="badge">0</span>'; 
					echo '</a>'; 
					echo '</td>'; 
					if ($i == 7)
					{
						echo '</tr>'; 
						echo '<tr>'; 
					}
					if ($day == $monthLength)
					{
						if ($i != 7)
						{
							for ($j = $i; $i < 7; $i++)
							{
								echo '<td></td>';
							}
						}
					}
				}
				$i++;
			}
			if (($displayYear == $year) && ($displayMonth == $month))
			{
				echo '</tr>'; 
				echo '</tbody>';
				echo '</table>';
				echo '<div class="text-center">';
				echo '<ul style="margin-top:0" class="pagination">';
				if (($displayYear - 1) >= 2010)
				{
					echo '<li><a href="http://localhost/calendar/month.php/?year=' . ($displayYear - 1) . '&month=' . $displayMonth . '">' . ($displayYear - 1) . '</a></li>';
				}
				for ($j = 1; $j <= 12; $j++)
				{
					echo '<li '; 
					if($j == $displayMonth)
					{
						echo 'class="active"';
					}
					$months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
					echo '><a href="http://localhost/calendar/month.php/?year=' . $displayYear . '&month=' . $j . '">' . $months[$j - 1] . '</a></li>';
				}
				if (($displayYear + 1) <= ($currentYear + 10))
				{
					echo '<li><a href="http://localhost/calendar/month.php/?year=' . ($displayYear + 1) . '&month=' . $displayMonth . '">' . ($displayYear + 1) . '</a></li>';
				}
				echo '</ul>';
				echo '</div>';
				echo '</div>';
			}
		}
	}
?>
</div>
</body>