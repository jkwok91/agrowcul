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

                <div class="address-cont">

                    <span class="go-local">
                        Go local
                    </span>
                    <form action="findfarms.php" method="post" class="clearfix">

                        <label for="addressbar">Enter your neighborhood</label>
                        <input type="text" name="addressbar" class="addressbar autocomplete_location left" />

                        <input type="submit" value="Locate" />

                    </form>
                </div>
                <span class="or serif">or</span>
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
            <img src="../images/what.png" width="366" height="329" id="what-diagram" align="right" />
            <h4>Spend more time growing and less time selling.</h4>

            <p>We provide a <strong>convenient payment system</strong> that allows new customers to purchase food and share their new purchases with friends.</p>      
          	<p class="philosphy">Learn more by reading <a href="../philosophy">our philosophy</a>.</p>
        </div><!--/.block-->
        <a href="#box3" class="nav_link pull-tab" id="pull3">Read on &darr;</a>
    </div><!--/.block-cont-->






    <div class="block-cont">

        <div class="block clearfix" id="who">
            <div class="block-title-cont">
                <h2 class="block-title">Know More</h2>
            </div><!--/.block-title-cont-->
            <img src="../images/who-illustration.png" class="who-diagram" alt="Image of shaking hands and a crossed pitchfork and dinner fork." align="left">

            <h4>
                Know what food to sell and who to sell it to.
            </h4>
            <p>We give you <strong>real-time market insights</strong> so you can keep up to date on what other farmers are growing.</p>
            <p>You can track your inventory, manage your sales, and connect directly with your customers</p>
            <p class="emphasis"><strong>Join the  local food movement today.<a href="#subscription-note">*</a></strong>
                <a style="cursor:pointer" class="goto">Locate and subscribe to</a> a farm in your area, or <a style="cursor:pointer" class="goto">petition</a> for one to arrive soon.</p>

            <a name="subscription-note" class="footnote">* Subscriptions are currently limited to farms in NYC.</a>



        </div><!--/.block-->
        <a href="#box4" class="pull-tab nav_link" id="pull4">Read on &darr;</a>
    </div><!--/.block-cont-->









    <div class="block-last"> 
        <div class="block" id="why">
            <div class="block-title-cont">
                <h2 class="block-title">Grow Faster</h2>
            </div><!--/.block-title-cont-->
            <h4>Growing food is hard work!</h4> 
            <p>Get the support you need to expand your operation. Swing by a <strong>class or workshop</strong> to hone your skills and meet fellow growers.
            <p>Come next growing season, you'll be able to find new <strong> urban farming technology </strong> to get more food from your windowsill, balcony, backyard or rooftop.</p>

            <div class="get-started clearfix">
                <h4 class="question">What are you waiting for?</h4>
                <div class="address-cont">

                    <span class="go-local">
                        The local food movement is in your hands.
                    </span>
                    <form action="findfarms.php" method="post" class="clearfix">

                        <label for="addressbar">Apply to be a Provider</label>
                        <input type="text" name="addressbar" class="addressbar autocomplete_location left" />

                        <input type="submit" value="Locate" />

                    </form></div>
                <span class="or serif">or</span>
                <a style="cursor:pointer" class="open-petition ribbon tall petition">Petition for a farm &rarr;</a>
            </div><!--/.get-started-->

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
    </script>


    <?php require('../includes/footer.php'); ?>
</div>
</body>
</html>