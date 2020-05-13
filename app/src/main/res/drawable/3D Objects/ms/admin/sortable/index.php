<?php
	// Connect to DB
	include("dbconnect.inc.php");
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Nestable</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
	<script src="functions.js"></script>
</head>
<body>
	
	
	<?php
		
		/* Function menu_showNested
		 * @desc Create inifinity loop for nested list from database
		 * @return echo string
		*/
		function menu_showNested($parentID) {
			global $connection;
			
			$sql = "SELECT * FROM jadwal WHERE parent_id='$parentID' ORDER BY rang";
			$result = mysql_query($sql, $connection);
			$numRows = mysql_num_rows($result);
			
			if ($numRows > 0) {
				echo "\n";
				echo "<ol class='dd-list'>\n";
					while($row = mysql_fetch_array($result)) {
						echo "\n";
						
						echo "<li class='dd-item' data-id='{$row['id']}'>\n";
							echo "<div class='dd-handle'>{$row['id']}: {$row['kd_matkul']}</div>\n";
						
							// Run this function again (it would stop running when the mysql_num_result is 0
							menu_showNested($row['id']);
						
						echo "</li>\n";
					}
				echo "</ol>\n";
			}
		}
		
		
		
		
		## Show the top parent elements from DB
		######################################
		$sql = "SELECT * FROM jadwal WHERE parent_id='0' ORDER BY rang";
		$result = mysql_query($sql, $connection);
		$numRows = mysql_num_rows($result);
		
		
		echo "<div class='cf nestable-lists'>\n";
			echo "<div class='dd' id='nestableMenu'>\n\n";
				echo "<ol class='dd-list'>\n";
				
					while($row = mysql_fetch_array($result)) {
						echo "\n";
						
						echo "<li class='dd-item' data-id='{$row['id']}'>";
							echo "<div class='dd-handle'>{$row['id']}: {$row['kd_matkul']}</div>";
						
						
						menu_showNested($row['id']);
						
						echo "</li>\n";
					}
					
				echo "</ol>\n\n";
			echo "</div>\n";
		echo "</div>\n\n";
		
		
		// Feedback div for update hierarchy to DB
		// IMPORTANT: This needs to be here! But you can remove the style
		echo "<div id='sortDBfeedback' style='border:1px solid #eaeaea; padding:10px; margin:15px;'></div>\n";
		
		
		// Script output for debuug
		//echo "<textarea id='nestableMenu-output'></textarea>";
		
	?>
	
    

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="jquery.nestable.js"></script>
	<script>

	$(document).ready(function()
	{
		
		/* The output is ment to update the nestableMenu-output textarea
		 * So this could probably be rewritten a bit to only run the menu_updatesort function onchange
		*/
		
		var updateOutput = function(e)
		{
			var list   = e.length ? e : $(e.target),
				output = list.data('output');
			if (window.JSON) {
				output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
				menu_updatesort(window.JSON.stringify(list.nestable('serialize')));
			} else {
				output.val('JSON browser support required for this demo.');
			}
		};
		
		// activate Nestable for list menu
		$('#nestableMenu').nestable({
			group: 1
		})
		.on('change', updateOutput);

		
		
		// output initial serialised data
		updateOutput($('#nestableMenu').data('output', $('#nestableMenu-output')));

		$('#nestable-menu').on('click', function(e)
		{
			var target = $(e.target),
				action = target.data('action');
			if (action === 'expand-all') {
				$('.dd').nestable('expandAll');
			}
			if (action === 'collapse-all') {
				$('.dd').nestable('collapseAll');
			}
		});

		$('#nestable3').nestable();

	});
	</script>
</body>
</html>