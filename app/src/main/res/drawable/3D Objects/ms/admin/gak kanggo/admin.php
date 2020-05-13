<?php
ini_set("display_errors","Off");
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
?>
<!DOCTYPE html>
<html xmlns="#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link href="css/modern.css" rel="stylesheet">
    <link href="css/modern-responsive.css" rel="stylesheet">
    
    <!--dialog-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

    <title>SISTEM PENJADWALAN AKADEMIK </title>

</head>
<body class="metrouicss" onload="prettyPrint()">

<div class="page">
<div class="nav-bar">
    <div class="nav-bar-inner padding10">
        <span class="pull-menu"></span>

        <a href="/ms/admin"><span class="element brand">
            <img class="place-left" src="gambar/logo32.png" style="height: 30px"/>
            WEB BASED<small></small>
        </span></a>

        <div class="divider"></div>

        <ul class="menu">
            <li><a href="admin.php">Home</a></li>
            

            <li><a href="admin.php?p=logout">Logout</a></li>
        </ul>

    </div>
</div>
</div>




    <div class="page secondary with-sidebar">
        <div class="page-header">
            <div class="page-header-content">
                <h1>Admin Panel <small>Sistem Penjadwalan Akademik</small></h1>
                <a href="" class="back-button big page-back"></a>
            </div>
    </div>
    <div class="page-sidebar">
            <ul>
                
                </li>
                <li class="sticker sticker-color-yellow dropdown active" data-role="dropdown">
                    <a><i class="icon-list"></i> Lihat & Edit Data</a>
                    <ul class="sub-menu light sidebar-dropdown-menu open">
                        
                        <li><a href="admin.php?p=L_Matakuliah">Data Matakuliah</a></li>
                        <li><a href="admin.php?p=L_Ruang">Data Ruang</a></li>
                        <li><a href="admin.php?p=L_Jadwal">Data Jadwal</a></li>
                        <li><a href="admin.php?p=L_Dosen">Data Dosen</a></li>
                        <li><a href="admin.php?p=L_User">Data User</a></li>
                    </ul>
                </li>
                <li class="sticker sticker-color-red dropdown active" data-role="dropdown">
                    <a><i class="icon-list"></i> Input Data</a>
                    <ul class="sub-menu light sidebar-dropdown-menu opened">
                        <li><a href="admin.php?p=ADD_Dosen">Data Dosen</a></li>
                        <li><a href="admin.php?p=ADD_Matakuliah">Data Matakuliah</a></li>
                        <li><a href="admin.php?p=ADD_Jadwal">Data Jadwal</a></li>
                        <li><a href="admin.php?p=ADD_Ruang">Data Ruang</a></li>
                    </ul>
                </li>
                <li class="sticker sticker-color-orange dropdown active" data-role="dropdown">
                    <a><i class="icon-list"></i> Cari</a>
                    <ul class="sub-menu light sidebar-dropdown-menu opened">
                        <li><a href="admin.php?p=C_Jadwal">Cari Data Jadwal</a></li>
                        
                    </ul>
                </li>
                <li class="sticker sticker-color-green dropdown active" data-role="dropdown">
                    <a><i class="icon-list"></i> Generate Jadwal</a>
                    <ul class="sub-menu light sidebar-dropdown-menu opened"> <!--- keep-opened--->
                        <li><a href="admin.php?p=g_jadwal">Lihat Rincian</a></li>
                        <li><a href="admin.php?p=develop">Tentang</a></li>
                        <li><a href="admin.php?p=logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
<!------------------------------------------------------------------------->

 <?php
        $ambilhalaman = 'pages';
        if(!empty($_GET['p'])){
            $pages = scandir($ambilhalaman, 0);
            unset($pages[0], $pages[1]);
 
            $p = $_GET['p'];
            if(in_array($p.'.php', $pages)){
                include($ambilhalaman.'/'.$p.'.php');
            } else {
                echo 'Halaman tidak ditemukan! :( Kembali Ke Halaman Awal';
            }
        } else {
            include($ambilhalaman.'/home.php');
        }
        ?>
        
<!-------------------------------------------------------------------------->

            
            <!--------------------->
        </div>
            
        
   

<div class="page">
        <div class="nav-bar">
            <div class="nav-bar-inner padding10">
                <span class="element">
                    2013-2014|TEMPLATE METRO |Deisgn&copy; by <a class="fg-color-white" href="mailto:kzaack@gmail.com">KELOMPOK 1</a>
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