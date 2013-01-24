<?php
$id = "home";
require('header.php');
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="content">

    <div id="back-to-top">
        <img src="../images/back-to-top.png"/>
    </div>

    <div class="block-cont first">
        <h1 class="heading">Hyper-local, healthy produce at your doorstep</h1>
        <div class="steps" id="first">
            <ol class="clearfix">
                <li class="current" id="locate">
                    <span class="hidden">1. Locate</span>
                    <p>Find a farm in your neighborhood or petition for a new one!</p>
                </li>

                <li id="subscribe">
                    <span class="hidden">2. Subscribe</span>
                    <p>Support your neighborhood farmer with a seasonal or weekly subscription</p>
                </li>
                <li class="last" id="delivered">
                    <span class="hidden">3. Delivered</span>
                    <p>Get your food delivered when you want it</p>
                </li>

            </ol>


            <div class="get-started clearfix">
		<a href="/start-a-farm" class="mappp"><img src="../images/locate2.png" width=150/>See a map of demand</a>
                <a href="#box2" id="goto2" class="nav_link learn-more">Learn More</a>
            </div><!--/.get-started-->
        </div><!--/.steps-->

    </div><!--/.block-cont-->











    <div class="block-cont">
        <div id="about" style="position: absolute; top: -100px;"></div>
        <div class="block" id="what">
            <div class="block-title-cont">
                <h2 class="block-title">Sell Better</h2>
            </div><!--/.block-title-cont-->
            <h4>Spend more time growing and less time selling.</h4>
	    <img src="../images/Newsletters-Icon.png" />
            <div id="newsL">
		<h6>Newsletters</h6>
		<p>Find out what other farms in your neighborhood are growing and what food your community wants.</p>
	    </div>
            <img src="../images/Pitch-Fork-Icon.png" id="fork"/>
	    <div id="oStore">
		<h6>Online Store</h6>
          	<p>Get the tech and tools you need to grow in your windowsills, balconies, and rooftops.</p>
	    </div>
		<img id="soon" src="../images/stamp-coming-soon.png">
	<div style="clear:both;"></div><!--/.block-->
	</div>
        <a href="#box3" class="nav_link pull-tab" id="pull3">Read on &darr;</a>
    </div><!--/.block-cont-->






    <div class="block-cont">

        <div class="block clearfix" id="who">
            <div class="block-title-cont">
                <h2 class="block-title">Know More</h2>
            </div><!--/.block-title-cont-->
   	    <div id="salesInv">
                 <img id="inv-icon" src="../images/Inventory-Mgmt-Icon.png" />
		 <p>Keep track of your sales and inventory with a simple content management system.</p>
	    </div>
	    <div id="fProfile">
		 <p>Sell your food directly to your neighbors with a Farmer Profile where you can list your products and</p>
	    </div>
	    <img src="../images/Mock-Profile.png" id="mockProfile"/>
        </div><!--/.block-->
        <a href="#box4" class="pull-tab nav_link" id="pull4">Read on &darr;</a>
    </div><!--/.block-cont-->









    <div class="block-last"> 
        <div class="block" id="why">
            <div class="block-title-cont">
                <h2 class="block-title">Grow Faster</h2>
            </div><!--/.block-title-cont-->
	    <img src="../images/who.png" id="hShake" width=110/>
            <div id="classRes">
		<h6>Classes and Resources</h6>
		<p>Take classes from fellow food enthusiasts in your neighborhood!</p>
		<p>Learn how to keep bees, grow mushrooms, or keep chickens right here in NYC.</p>
	    </div>
	    <img src="../images/Social-Network-Icon.png" id="networks" width=125/>
	    <div id="socialNet">
		<h6>Social Networking</h6>
		<p>Connect your profile to your facebook page, twitter feed, or blog.</p>
		<p>Let your community be a part of your process.</p>
	    </div>
	    <div style="clear:both;"></div>
        </div><!--/.block-->

    </div><!--/.block-cont-->

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
                        <img src="../images/request-text1.gif" alt="I request that" width="97" height="18" /><div class="input left"><label for="address">i.e. Brooklyn Heights</label><input type="text" class="pledge-text" id="petition-address" name="address" value=""/></div><img src="../images/request-text2.gif" width="75" height="18" alt=", New York" /><img src="../images/request-text3.gif" width="345" height="36" alt="become a part of a grow culture, and hereby pledge my support for an urban farm." class="linebreak" />

                        <img src="../images/request-text4.gif" width="185" height="18" alt="Please keep me updated at" />  <div class="input left"><label for="email">i.e. john@example.com</label><input type="text" class="pledge-text" id="email" name="email" value=""/></div> <img src="../images/request-text5.gif" width="9" height="18" alt="." />
                        <input id="petition-lat" name="lat" type="hidden" value=""/>
                        <input id="petition-lng" name="lng" type="hidden" value=""/>
                        <input id="petition-submit" type="submit" class="pledge-submit" value="Pledge my support &rarr;" />

                    </form><!--/.pledge-->
                    <form id="thanks-form" action="thanks.php" method="POST">
                        <input id="thanks-address" name="address" type="hidden" value=""/>
                        <input id="thanks-id" name="id" type="hidden" value=""/>
                    </form>
                </div><!--/.form-inset-->
            </div><!--/.form-card-->
            <div class="envelop-top">
            </div><!--/.envelop-top-->
        </div><!--/.envelop-->
    </div>

    <script type="text/javascript">
        (function () {
            var nonEmpty = "non-empty";
            var inputs = jQuery('input[type=text], input[type=password]');
            var setLabelStyle = function setLabelStyle () {
                var label = jQuery(this);
                if (label.val().length) {
                    label.addClass(nonEmpty);
                } else {
                    label.removeClass(nonEmpty);
                }
            };
            inputs.focus(function () { jQuery(this).addClass(nonEmpty); });
            inputs.blur(setLabelStyle);
            inputs.each(setLabelStyle);
        }());
        var topshown = false;
        $(function(){
            var $w = $(window);
            $w.scroll(function(){
                if ($w.scrollTop()>=585) {
                    if (!topshown) {
                        $('#back-to-top').stop().fadeIn();
                        topshown = true;
                    }
                } else {
                    if (topshown) {
                       $('#back-to-top').stop().fadeOut();
                       topshown = false;
                    }
                }
            });
            $('#back-to-top').click(function(){
                $(window.opera?'html':'html, body').animate({
                    scrollTop: 0
                }, 500, function(){});
            });
        });
    </script>


    <?php require('../includes/footer.php'); ?>
</div>
</body>
</html>
