<meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link href="css/modern.css" rel="stylesheet">
    <link href="css/modern-responsive.css" rel="stylesheet">
    
    <!--dialog-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    	
		<link type="text/css" href="css/jquery-ui.css" rel="stylesheet" />	
        <script src="jquery.min.js" type="text/javascript"></script>	
    	<script src="jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/jquery-1.6.2.min.js"type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.16.custom.min.js"type="text/javascript"></script>
		<script type="text/javascript">
		    $(function () {

		        // Accordion
		        $("#accordion").accordion({ header: "h3" });

		        // Tabs
		        $('#tabs').tabs();

		        // Button
		        $("#button").button();
		        $("#button-disabled").button().addClass("ui-state-disabled").attr("disabled", true);
		        $("#radioset").buttonset();
		        
		        // Dialog			
		        $('#dialog').dialog({
		            autoOpen: false,
		            width: 600,modal:true,
		            buttons: {
		                "Ok": function () {
		                    $(this).dialog("close");
		                },
		                "Cancel": function () {
		                    $(this).dialog("close");
		                }
		            }
		        });

		        // Dialog Link
		        $('#dialog_link').click(function () {
		            $('#dialog').dialog('open');
		            return false;
		        });

		        // Autocomplete
		        $("#autocomplete").autocomplete({
		            source: ["c++", "java", "php", "coldfusion", "javascript", "asp", "ruby", "python", "c", "scala", "groovy", "haskell", "perl"]
		        });

		        // Datepicker
		        $('#datepicker').datepicker({
		            inline: true
		        });

		        // Slider
		        $('#slider').slider({
		            range: true,
		            values: [17, 67]
		        });
		        var values = [50, 80, 20, 40, 70];
		        $("#verticalSliders > div").each(function (i, item) {
		            $(item).slider({ orientation: "vertical", range: "min", min: 0, max: 100, value: values[i] });
		        });

		        // Progressbar
		        $("#progressbar").progressbar({
		            value: 20
		        });

		        //hover states on the static widgets
		        $('#dialog_link, ul#icons li').hover(
					function () { $(this).addClass('ui-state-hover'); },
					function () { $(this).removeClass('ui-state-hover'); }
				);

		    });
		</script>
		<style type="text/css">
			body{ font-family:"Segoe UI", Helvetica, Verdana;font-size: 11px;}
			#wrapper{width:700px;}
			h1{font-weight:normal;}
			.header { margin-top: 2em;font-weight:normal; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			#verticalSliders{height:140px;padding-top:20px;}
            #verticalSliders > div{float:left;margin:20px;}
		</style>
<!---->

    
    <link href="css/site.css" rel="stylesheet" type="text/css">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="js/assets/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="js/assets/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="js/assets/moment.js"></script>
    <script type="text/javascript" src="js/assets/moment_langs.js"></script>

    <script type="text/javascript" src="js/modern/dropdown.js"></script>
    <script type="text/javascript" src="js/modern/accordion.js"></script>
    <script type="text/javascript" src="js/modern/buttonset.js"></script>
    <script type="text/javascript" src="js/modern/carousel.js"></script>
    <script type="text/javascript" src="js/modern/input-control.js"></script>
    <script type="text/javascript" src="js/modern/pagecontrol.js"></script>
    <script type="text/javascript" src="js/modern/rating.js"></script>
    <script type="text/javascript" src="js/modern/slider.js"></script>
    <script type="text/javascript" src="js/modern/tile-slider.js"></script>
    <script type="text/javascript" src="js/modern/tile-drag.js"></script>
    <script type="text/javascript" src="js/modern/calendar.js"></script>



<div style="height:550px;width:auto;border:solid 4px orange;overflow:scroll;
overflow-y:scroll;overflow-x:scroll;">
<p style="width:1400px;">

<!---------------------------------------------------->

</br>
<table border="1" class="span2">
                    <thead class="bg-color-red">
                        <tr class="info">
                            <th colspan="2"></th>
                            <!--th></th-->
                            <th class="right" colspan="4">abc</th>
                            <th class="right" colspan="4">def</th>
                            <th class="right" colspan="4">ghi</th>
                            <th class="right" colspan="4">jkl</th>
                            <th class="right" colspan="4">mno</th>
                            <th class="right" colspan="5">5</th>
                            <th class="right" colspan="5">5</th>
                        </tr>
                    </thead>

                    <tbody>
                    <tr class="info">
                            <td>snn</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr> 
                         <tr class="info">
                            <td>snn</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>  
                         <tr class="info">
                            <td>snn</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="selected-row">
                            <td>sls</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="selected-row">
                            <td>sls</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="selected-row">
                            <td>sls</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr> 
                         <tr class="info">
                            <td>rb</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>  
                         <tr class="info">
                            <td>rb</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="info">
                            <td>rb</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="selected-row">
                            <td>kms</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="selected-row">
                            <td>kms</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr> 
                         <tr class="selected-row">
                            <td>kms</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>  
                         <tr class="info">
                            <td>jmt</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="info">
                            <td>jmt</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         <tr class="info">
                            <td>jmt</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td>
                            <td class="right">1</td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                         </tr>
                         
                        
                        
                        </tbody>

                    <tfoot></tfoot>
                </table>
<!---------------------------------------------------->
</div>
