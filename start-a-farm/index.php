<!DOCTYPE html>
<html>
    <head>
        <title>agrowculture. | Food Demand</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta property="og:title" content="Agrowculture" />
        <meta property="og:type" content="company" />
        <meta property="og:url" content="http://www.agrowculture.org" />
        <meta property="og:image" content="http://www.agrowculture.org/images/logo-splash.png" />
        <meta property="og:site_name" content="Agrowculture" />
        <meta property="fb:admins" content="8703761" />

        <meta name="keywords" content="Agrowculture, urban farming, urban farms, local food, rooftop farms, locally-grown food" />
        <meta name="description" content="Agrowculture. We grow hyper-local food production and sales networks, connect consumers with local urban farmers and help you start small-scale urban farms."/>
        <meta name="author" content="Evan You"/>

        <link rel="stylesheet" media="screen" href="../css/reset.css" />
        <link rel="stylesheet" media="screen" href="css/style.css" />
        <link rel="stylesheet" media="screen" href="../css/footer.css" />
        <link rel="icon" type="image/png" href="../images/favicon2.png" />
        <link rel="stylesheet" media="screen" href="../css/fonts.css" />

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

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/jquery.inlineComplete-master/jquery.inlinecomplete.js"></script>
    </head>
    <body>
        <div id="container">

            <!-- HEADER -->
            <div id="header">
                <a id="logo" href="../">
                    agrowculture. growing local food networks
                </a>
                <span class="location">NYC</span> 

                <div id="nav">
                    <a id="home_link" href="../">[Icon]</a>
                </div><!--/#nav-->
            </div> <!--/#header-->

            <!-- CONTENT -->
            <div id="app-wrapper">
                <?php include('app.php'); ?>
            </div>

        </div> <!--/#container -->

        <!-- FOOTER -->
        <?php require_once '../includes/footer.php';?>

        <div class="black-container" style="display: none">
            <div class="envelop">
                <div class="envelop-bg">

                </div>
                <div class="form-card">
                    <a id="close-petition">X</a>
                    <div class="form-inset clearfix">
                        <h2>Urban Farm Petition</h2>
                        <h3>New York City</h3>
                        <i class="request-stamp">Local Farm Request</i>

                        <form id="petition-form" class="pledge">
                            <img src="../images/request-text1.gif" alt="I request that" width="97" height="18" /><div class="input left"><input type="text" class="pledge-text" id="petition-address" name="address" autocomplete="off" value=""/></div><img src="../images/request-text2.gif" width="75" height="18" alt=", New York" /><img src="../images/request-text3.gif" width="345" height="36" alt="become a part of a grow culture, and hereby pledge my support for an urban farm." class="linebreak" />

                            <img src="../images/request-text4.gif" width="185" height="18" alt="Please keep me updated at" />  <div class="input left"><label for="email">i.e. john@example.com</label><input type="text" class="pledge-text" id="email" name="email" value=""/></div> <img src="../images/request-text5.gif" width="9" height="18" alt="." />
                            <input id="petition-lat" name="lat" type="hidden" value=""/>
                            <input id="petition-lng" name="lng" type="hidden" value=""/>
                            <input id="petition-submit" type="submit" class="pledge-submit" value="Pledge my support &rarr;" />

                        </form><!--/.pledge-->
                        <form id="thanks-form" action="../home/thanks.php" method="POST">
                            <input id="thanks-address" name="address" type="hidden" value=""/>
                            <input id="thanks-id" name="id" type="hidden" value=""/>
                        </form>
                    </div><!--/.form-inset-->
                </div><!--/.form-card-->
                <div class="envelop-top">
                </div><!--/.envelop-top-->
            </div><!--/.envelop-->
        </div>
        
    </body>
</html>
