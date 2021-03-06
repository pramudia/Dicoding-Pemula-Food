
<!DOCTYPE html>
<html xmlns="#">
<head>
    <meta charset="utf-8">
    

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="modern-responsive.css" rel="stylesheet">
<!--responsive-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="modern-responsive.css" rel="stylesheet">
    <style type="text/css">
<!--
	     /* Large desktop */
    @media (min-width: 1200px) { ... }
     
    /* Portrait tablet to landscape and desktop */
    @media (min-width: 768px) and (max-width: 979px) { ... }
     
    /* Landscape phone to portrait tablet */
    @media (max-width: 767px) { ... }
     
    /* Landscape phones and down */
    @media (max-width: 480px) { ... }
-->
</style>

<!--dialog-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
		<link type="text/css" href="css/jquery-ui.css" rel="stylesheet" />	
        <script src="js/jquery.min.js" type="text/javascript"></script>	
    	<script src="js/jquery-ui.min.js" type="text/javascript"></script>
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
			body{ font-family:"Segoe UI", Helvetica, Verdana;font-size: 11px; margin: 50px;}
			#wrapper{width:700px;}
			h1{font-weight:normal;}
			
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			#verticalSliders{height:140px;padding-top:20px;}
            #verticalSliders > div{float:left;margin:20px;}
		</style>
<!---->
  
    <link href="css/modern.css" rel="stylesheet">
    <link href="css/modern-responsive.css" rel="stylesheet">
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

    <title>SISTEM PENJADWALAN AKADEMIK </title>
</head>
<body class="metrouicss" onload="prettyPrint()">

<?php include("navigation.php")?>
<p>&nbsp;
</p>
<p>
<div class="page">
                    
  <?php
ini_set("display_errors","Off");
  include("koneksi.php");?>
  
<form name="in_matkul" action="/ms/V_Matakuliah.php" method="POST">
Cari Berdasarkan Nama atau Kode : <input type="text" name="nama" maxlength="30" /></button>
                   <input type="submit" value="Cari" />
  
</p>
<div class="bg-color-redLight fg-color-white padding20">
  <h3 class="fg-color-white">Data Matakuliah.</h3>
                    </div>
                   <table width="1207" height="98">
                    <tbody>
                     </tbody>
                    <thead>
                      <tr class="info">
                        <th width="8%">No</th>
                            <th width="23%" class="center">Kode Matakuliah</th>
                            <th width="24%" class="center">Nama Matakuliah</th>
                            <th width="8%" class="center">SKS</th>
                            <th width="12%" class="center">Semester</th>
                            <th width="25%" class="center">Jumlah Pengambil</th>
                      </tr>
                    </thead>
                    <tbody>
                   
  <?php
  $nama=$_POST['nama'];
    $query = mysql_query ("SELECT * FROM matkul where kd_matkul LIKE '%$nama%' or nm_matkul like '%$nama%'");
    $no  = 1;
	//$result = mysql_query($query) or die (“gagal”);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_matkul']; 
    ?>
    <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['kd_matkul'] ?></td>
            <td><?php echo $data['nm_matkul'] ?></td>
            <td><?php echo $data['sks'] ?></td>
            <td><?php echo $data['semester'] ?></td>
            <td><?php echo $data['jml_pngambil'] ?></td>
                    </tr>
       <?PHP
$no++;
}
?>
                                              
                       <tr bgcolor="#B91D47" class="bg-color-redLight">
                        <td height="30" colspan="6"></td>
                       
                      </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
                
                 
</div>
</div>
</div> 
    <div class="page">
        <div class="nav-bar">
            <div class="nav-bar-inner padding10">
                <span class="element">
                    &copy Copyright 2017
                </span>
            </div>
        </div>
</div>
<!--
    
--->
<script type="text/javascript" src="js/assets/github.info.js"></script>
<script type="text/javascript" src="js/assets/google-analytics.js"></script>
<script type="text/javascript" src="js/google-code-prettify/prettify.js"></script>
<script src="js/sharrre/jquery.sharrre-1.3.4.min.js"></script>

<script>
        $('#shareme').sharrre({
            share: {
                googlePlus: true
                ,facebook: true
                ,twitter: true
                ,delicious: true
            },
            urlCurl: "js/sharrre/sharrre.php",
            buttons: {
                googlePlus: {size: 'tall'},
                facebook: {layout: 'box_count'},
                twitter: {count: 'vertical'},
                delicious: {size: 'tall'}
            },
            hover: function(api, options){
                $(api.element).find('.buttons').show();
            }
        });
    </script>

</body>
</html>
