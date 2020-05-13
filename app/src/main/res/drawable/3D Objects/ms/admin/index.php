<!-- <?php
ini_set("display_errors","Off");
	session_start();
	ob_start();
?> -->
<!DOCTYPE html>
<html xmlns="#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
 
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

<div class="page">
<div class="nav-bar">
    <div class="nav-bar-inner padding10">
        <span class="pull-menu"></span>

        <a href="/ms"><span class="element brand">
            <img class="place-left" src="gambar/logo32.png" 
            style="height: 30px"/>WEB BASED<small><?php  include("version.phtml") ?>
            </small>
        </span></a>

        <div class="divider"></div>

        <ul class="menu">
            <li><a href="/ms/">Home</a></li>
            

        </ul>

    </div>
</div>
</div>

<div class="page secondary with-sidebar">
        <div class="page-header">
            <div class="page-header-content">
                <h1>HELLO! <small>Selamat Datang di Sistem Penjadwalan Akademik</small></h1>
                <a href="/ms" class="back-button big page-back"></a>
            </div>
        </div>
</div>

<div class="page" id="page-index">
    <div class="page-region">
        <div class="page-region-content">
            <div class="grid">
                <div class="row">
                    <div class="span8">
                        <div class="hero-unit">
                            <div id="carousel1" class="carousel" data-role="carousel" data-param-duration="300">
                                <div class="slides">

                                    <div class="slide" id="slide1">
                                        <h2> INFO !</h2>
                                        <p class="bg-color-blueDark padding20 fg-color-white">Hubungi Administrator jika mendapati kesulitan.</p>
                                        </p>
                                    </div>

                                    <div class="slide" id="slide2">
                                        <h2 class="fg-color-darken"> INFO !</h2>
                                        <p class="bg-color-pink padding20 fg-color-white">Login sebagai publisher dan atur jadwal :).</p>

                                    </div>

                                </div>

                                <span class="control left"><i class="icon-arrow-left-3"></i></span>
                                <span class="control right"><i class="icon-arrow-right-3"></i></span>

                            </div>
                        </div>
                    </div>
                    
<!-------------------------------------------------->

<div class="span4">

        <div class="span4 padding30 text-center place-left bg-color-blueLight" id="sponsorBlock">
         
                  <div class="bg-color-orange fg-color-white padding15" >
                        <h3 class="fg-color-white">LOGIN.</h3>
                  </div>
                      <div >.
                     <form action="cek_login.php" method="POST" name="login">
                            <table class="hovered" >
                                    <tbody>
                                        <tr>
                                        <td class="">Username</td><td >:</td><td class="right"><div class="input-control text"><input type="phone" name="user_id" maxlength="255" max="20"/><button class="btn-clear"></button></div></td></tr>
                                        <tr><td class="">Password</td><td >:</td><td class="right"><div class="input-control text"><input type="password" name="pass" maxlength="255" max="20"/><button class="btn-clear"></button></div></td></tr>
                                        <tr><td></td></tr>
                                        <tr class="warning" ><td colspan="4" class="right">
                                        <!--jquery ajax success button
<script>
function myFunction()
{
alert("Selamat , Anda Berhasil Login sebagai Admin");
}
</script>-->

                                        <input name="submit" type="submit" value="Log in"  onclick="myFunction()" value="Show alert box"/></td>
                                        </tr>
                                    </tbody>
            
                                    <tfoot></tfoot>
                            </table>          
                            </form>     
                      </div>
            
        </div>
    </div>
    
<!-------------------------------------------------->
                </div>
            </div>
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