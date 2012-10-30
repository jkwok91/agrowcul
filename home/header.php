<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title><?php
if ($title) {
    echo $title . ' | agrowculture.';
} else {
    echo 'agrowculture.';
}
?></title>
        <meta property="og:title" content="Agrowculture" />
        <meta property="og:type" content="company" />
        <meta property="og:url" content="http://www.agrowculture.org" />
        <meta property="og:image" content="http://www.agrowculture.org/images/logo-splash.png" />
        <meta property="og:site_name" content="Agrowculture" />
        <meta property="fb:admins" content="8703761" />
        
        <meta name="keywords" content="Agrowculture, urban farming, urban farms, new york city, urban agriculture, locavore, locovore, DIY farming, Sell my food, food next door, freshfixnyc.com,  local food, rooftop farms, locally-grown food" />
        <meta name="description" content="Agrowculture. We grow hyper-local food production and sales networks, connect consumers with local urban farmers and help you start small-scale urban farms."/>
        <meta name="author" content="Evan You"/>

        <link rel="icon" type="image/png" href="../images/favicon.png" />

        <link rel="stylesheet" media="screen" href="../css/reset.css" />
        <link rel="stylesheet" media="screen" href="../css/fonts.css" />
        <link rel="stylesheet" media="screen" href="../css/style.css" />
        <link rel="stylesheet" media="screen" href="../css/footer.css" />
         <link rel="stylesheet" media="screen" href="../css/thankyou.css" />

        <link type="text/css" href="js/lib/jquery-ui/css/ui-lightness/jquery-ui-1.8.5.custom.css" rel="stylesheet" />
        <style type="text/css">
            .ui-autocomplete { overflow-y: auto; width:300px; }
            * html .ui-autocomplete { /* IE max- */height: expression( this.scrollHeight > 320 ? "320px" : "auto" ); }
            .ui-autocomplete { max-height: 320px; }
            .ui-autocomplete li { font-size:10pt; }
        </style>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

        <!-- Google Analytics Code Start -->
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-23728804-1']);
            _gaq.push(['_trackPageview']);
	
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
	
        </script>
        <!-- Google Analytics Code End -->

        <?php
        
        if ($id == 'home') :
            include('includes/config.php'); ?> 
            <script type="text/javascript" src="js/scripts.js"></script> 
        <?php
        else:
        ?>
            <style>
               #nav { position: absolute !important; top: 0 !important;} 
            </style>
        <?php 
            if ($id == 'find-farms') include('includes/config.php');
        endif; ?>
            
            <!--<script src="../js/live.js"></script>-->

    </head>


    <body id="<?=$id?>">

        <div id="container">
            <div id="header">
                <a id="logo" href="../">
            	agrowculture. growing local food networks
                </a>
                <span class="location">NYC</span> 

                <div id="nav">
                    <a id="home_link" href="../">[Icon]</a>
                    <?php if ($id == 'home'): ?>
                    <a id="menu_handle">+</a>
                    <ul id="menu_drop">
                        <li>
                            <a href="#box1" id="link1" class="nav_link" >Home</a>
                        </li>
                        <li>
                            <a href="#box2" id="link2" class="nav_link">Grow <span class="menu-rollover">Your Food </span></a>
                        </li>
                        <li>
                            <a href="#box3" id="link3" class="nav_link">Sell <span class="menu-rollover">It Locally</span></a>
                        </li>
                        <li>
                            <a href="#box4" id="link4" class="nav_link">Build <span class="menu-rollover">Community</span></a>
                        </li>
                    </ul>
                    <?php endif;?>

                </div><!--/#nav-->
                <?php /*  Institute in later releases
                  <div id="login-panel">
                  <a id="login">Login</a>


                  <div id="login-form">
                  <form method="post" action="" >
                  <span class="login-tab"> </span>
                  <div class="input">
                  <label for="email">E-mail</label>
                  <input type="email" id="email" name="email" />
                  </div>

                  <div class="input">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" />
                  </div>
                  <span class="forgot"><a href="">Forgot your e-mail or password?</a></span>
                  <div class="checkbox-cont">
                  <div class="checkbox"><input type="checkbox" id="remember" name="remember" /><label for="remember">Remember Me</label></div>
                  </div>

                  <input type="submit" value="Go" />


                  </form>
                  </div><!--/#login-form-->
                 */ ?>
            </div> <!--/#header-->