<?php
	// DATABASE
	$host 		= "localhost"; 		// Host name
	$username 	= "root"; 			// Mysql username
	$password 	= ""; 		// Mysql password
	$db_name 	= "jadwal"; 		// Mysql password
	
	
	$connection = mysql_connect($host, $username, $password) or die ("Error: Kunne ikke koble til databasen");
	mysql_select_db($db_name, $connection);

?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html lang="en" class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html lang="en" class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html lang="en" class="lt-ie9"> <![endif]-->
<!--[if IE 9]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <title>Nestable</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
	<script src="functions.js"></script>
</head>
<body>
	
	
	<?php
		
		
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
						
						
						menu_showNested($row['id']);
						
						echo "</li>\n";
					}
				echo "</ol>\n";
			}
		}
		
		
		
		
		## Show where-statements
		######################################
		$sql = "SELECT * FROM jadwal WHERE parent_id='0' ORDER BY rang";
		$result = mysql_query($sql, $connection);
		$numRows = mysql_num_rows($result);
		
		
		echo "<div style='border:1px solid #eaeaea; padding:10px; margin-top:15px;'>\n\n";
		
		
		
		
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
		
		
		
		echo "</div>\n";
		
		
		
		
		echo "<div id='sortDBfeedback' style='border:1px solid #eaeaea; padding:10px; margin:15px;'></div>\n";
	
	?>
	
	<!--
    <h1>Nestable</h1>

    <p>Drag &amp; drop hierarchical list with mouse and touch compatibility (jQuery plugin)</p>

    <p><strong><a href="https://github.com/dbushell/Nestable">Code on GitHub</a></strong></p>

    <menu id="nestable-menu">
        <button type="button" data-action="expand-all">Expand All</button>
        <button type="button" data-action="collapse-all">Collapse All</button>
    </menu>
	
	
	
	<ol class='dd-list'>

		<li class='dd-item' data-id='1'><div class='dd-handle'>Om oss</div>
			<ol class='dd-list'>

				<li class='dd-item' data-id='2'><div class='dd-handle'>Robert Andresen</div>

					<ol class='dd-list'>
						<li class='dd-item' data-id='4'><div class='dd-handle'>Roberts CV</div></li>
						<li class='dd-item' data-id='7'><div class='dd-handle'>Bilder av meg</div></li>
						<li class='dd-item' data-id='8'><div class='dd-handle'>Kontaktopplysninger</div></li>
					</ol>
				
				</li>

				<li class='dd-item' data-id='3'><div class='dd-handle'>Veronica Karlsen</div></li>
			</ol>
		</li>

		<li class='dd-item' data-id='5'><div class='dd-handle'>Gallery</div></li>
		<li class='dd-item' data-id='6'><div class='dd-handle'>Kontakt oss</div></li>
	</ol>
	-->
	
	
	<!--
    <div class="cf nestable-lists">

        <div class="dd" id="nestable">
            <ol class="dd-list">
                <li class="dd-item" data-id="1">
                    <div class="dd-handle">Item 1</div>
                </li>
                <li class="dd-item" data-id="2">
                    <div class="dd-handle">Item 2</div>
                    <ol class="dd-list">
                        <li class="dd-item" data-id="3"><div class="dd-handle">Item 3</div></li>
                        <li class="dd-item" data-id="4"><div class="dd-handle">Item 4</div></li>
                        <li class="dd-item" data-id="5">
                            <div class="dd-handle">Item 5</div>
                            <ol class="dd-list">
                                <li class="dd-item" data-id="6"><div class="dd-handle">Item 6</div></li>
                                <li class="dd-item" data-id="7"><div class="dd-handle">Item 7</div></li>
                                <li class="dd-item" data-id="8"><div class="dd-handle">Item 8</div></li>
                            </ol>
                        </li>
                        <li class="dd-item" data-id="9"><div class="dd-handle">Item 9</div></li>
                        <li class="dd-item" data-id="10"><div class="dd-handle">Item 10</div></li>
                    </ol>
                </li>
                <li class="dd-item" data-id="11">
                    <div class="dd-handle">Item 11</div>
                </li>
                <li class="dd-item" data-id="12">
                    <div class="dd-handle">Item 12</div>
                </li>
            </ol>
        </div>

        <div class="dd" id="nestable2">
            <ol class="dd-list">
                <li class="dd-item" data-id="13">
                    <div class="dd-handle">Item 13</div>
                </li>
                <li class="dd-item" data-id="14">
                    <div class="dd-handle">Item 14</div>
                </li>
                <li class="dd-item" data-id="15">
                    <div class="dd-handle">Item 15</div>
                    <ol class="dd-list">
                        <li class="dd-item" data-id="16"><div class="dd-handle">Item 16</div></li>
                        <li class="dd-item" data-id="17"><div class="dd-handle">Item 17</div></li>
                        <li class="dd-item" data-id="18"><div class="dd-handle">Item 18</div></li>
                    </ol>
                </li>
            </ol>
        </div>

    </div>

    <p><strong>Serialised Output (per list)</strong></p>

    <textarea id="nestable-output"></textarea>
    <textarea id="nestable2-output"></textarea>
	-->
    <textarea id="nestableMenu-output"></textarea>

	<!--
    <p>&nbsp;</p>

    <div class="cf nestable-lists">

    <p><strong>Draggable Handles</strong></p>

    <p>If you're clever with your CSS and markup this can be achieved without any JavaScript changes.</p>

        <div class="dd" id="nestable3">
            <ol class="dd-list">
                <li class="dd-item dd3-item" data-id="13">
                    <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 13</div>
                </li>
                <li class="dd-item dd3-item" data-id="14">
                    <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 14</div>
                </li>
                <li class="dd-item dd3-item" data-id="15">
                    <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 15</div>
                    <ol class="dd-list">
                        <li class="dd-item dd3-item" data-id="16">
                            <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 16</div>
                        </li>
                        <li class="dd-item dd3-item" data-id="17">
                            <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 17</div>
                        </li>
                        <li class="dd-item dd3-item" data-id="18">
                            <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 18</div>
                        </li>
                    </ol>
                </li>
            </ol>
        </div>

    </div>

    <p class="small">Copyright &copy; <a href="http://dbushell.com/">David Bushell</a> | Made for <a href="http://www.browserlondon.com/">Browser</a></p>
	-->
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="jquery.nestable.js"></script>
<script>

$(document).ready(function()
{

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
	
	/*
    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);
    
    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    })
    .on('change', updateOutput);
	*/
	
	
	// activate Nestable for list menu
    $('#nestableMenu').nestable({
        group: 1
    })
    .on('change', updateOutput);

	
	
    // output initial serialised data
    //updateOutput($('#nestable').data('output', $('#nestable-output')));
    //updateOutput($('#nestable2').data('output', $('#nestable2-output')));
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