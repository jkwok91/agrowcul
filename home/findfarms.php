<?php
$id = "find-farms";
$title = "Find a Farm";

require('header.php');
?>

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


<div id="map-content" class="content" >

    <div id="map-block" class='block map'>
        <!-- <div class="block-title-cont">
             <h2 class="block-title">Farms near you</h2>
         </div><!--/.block-title-cont-->



        <div id="map-container" class="left">
            <div id="map"></div>
        </div>

        <div id ="farm-list-cont" class="right">
            <div class="farm-list-top clearfix">
                <h3 id="farms-in">Farms in&hellip;</h3>

                <div class="address-cont">
                    <form action="findfarms.php" method="post" class="clearfix">

                        <label for="addressbar">
                            <?php
                            if (isset($_POST["addressbar"])) {
                                echo $_POST["addressbar"];
                            } else {
                                echo "Search";
                            }
                            ?>
                        </label>
                        <input type="text" name="addressbar" class="addressbar autocomplete_location left" id="address-search" />
                        <input type="submit" value="Locate" class="submit-arrow" />
                    </form>
                </div><!--/.address-cont-->
            </div><!--/.farm-list-top-->
            <div class="bag-bottom"></div>
            <div id="nofarms" style="display: none">
                <div class="left column sorry">
                    <h2>Make your voice heard!</h2>

                    <div class="about">
                        <p>Show future urban farmers &amp; policy makers where there is demand for urban farms.</p>
                        <p>Click <a href="../start-a-farm">here</a> to see a map of all our petitions so far!</p>
                    </div><!--/.about-->

                    <a class="open-petition ribbon tall petition" href="javascript:void(0)">Request to get one soon.</a>
                </div><!--/.column.left-->
            </div>
			<div id="hasfarms" style="display:none">
            	<ul id="farm-list">
					<li><a style="font-size: 12px; font-weight: bold;" href="../start-a-farm">Go to Main Map</a></li>
            	</ul>
				<a class="open-petition ribbon tall petition" href="javascript:void(0)">Request to get one soon.</a>
			</div>
        </div><!--/.farm-list-cont-->

    </div><!--/.block-->


    <div id="farm-block" class="block farm clearfix" style="display:none;">

        <div class="column left">
            <div class="farm-details">
                <h2 id="farm-name"><?php // Call image of farm title text if available, otherwise print title as text               ?>
                    <!--Eagle Street<br />Rooftop Farm-->
                    <!--<img src="../images/farms/eagle-street-rooftop-farm.png" alt="Eagle Street Rooftop Farm"/>-->
                    21st Century Farmer
                </h2>

                <ul class="social clearfix">
                    <li><a href="#" id="contact-button" class="contact">Contact</a></li>
                    <li>
                        <a id="social-tt" href="http://twitter.com/share" class="twitter-share-button" data-url="" data-count="horizontal" data-via="agrowculture" data-related="rooftopfarmer">Tweet</a><script id="social-tt-script" type="text/javascript"></script>
                    </li>
                    <li id="social-fb" class="last">
                        <iframe src="http://www.facebook.com/plugins/like.php?app_id=177787128957459&amp;href=<?php //echo urlencode("http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);     ?>&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
                    </li>

                    <li id="social-contact">
                        <ul class="contact-info clearfix">
                            <li><a id="farm-address" class="address">203 Meserole Avenue<br />Brooklyn NY 11222</a></li>
                            <li><a id="farm-phone" class="phone">(555) 555 - 5555</a></li>
                            <li><a id="farm-email" class="email" href="mailto:">eagle@agrowculture.org</a></li>
                        </ul>
                    </li>

                </ul><!--/.social-->
            </div>
            <div class="bag-bottom"> </div>


            <div id="farm-about" class="about">

                <p>
                    A farm for the new age; the age of urban agriculture and
                    local food networks.  We grow the freshest food using the most
                    sustainable methods we know: rainwater harvesting, hydroponics, solar
                    cells and bio-reactors.  We're a group of next generation farmers,
                    leveraging social networks to reach out to the folks in our
                    neighborhood.   Our 2,000 square foot low-impact rooftop greenhouse
                    provides us with best produce year-round.
                </p>
                <p>Choose to become a CSA member, or just grab a weeks worth of
                    groceries... We're always free for a visit and would love to hear from
                    you.
                </p>
                <!--
                <p>Eagle Street Rooftop Farm is a 6,000 square foot green roof organic vegetable farm located atop a warehouse rooftop in Greenpoint, Brooklyn.</p>

                <p>During New York City's growing season, the farmers at Eagle Street Rooftop Farm supply a community supported agriculture (CSA) program, an onsite farm market, and bicycle fresh produce to area restaurants.</p>
                -->
            </div><!--/.about-->
        </div><!--/.column.left-->
        <div class="column right">
            <ul id="farm-products" class="packages">
                <?php
                /*
                  <li class="new">
                  <div class="pkg-img">
                  <img src="../images/farms/eagle-street-rooftop-farm/1.jpg" alt="Leafy Green Package" />
                  </div>
                  <h3><a>Leafy Green Bundle</a></h3>
                  <h4>$12.00 / month</h4>
                  <p>Some description of the package. It might contain a list or just text.</p>
                  <div class="add-cart">
                  <!-- PAYPAL BUTTON GOES HERE -->
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="GX567SZGRXMFC">

                  <input type="hidden" name="currency_code" value="USD">
                  <input type="submit" border="0" name="submit" class="add-cart-button">
                  </form>
                  <!--/PAYPAL BUTTON-->
                  </div>
                  </li>
                  <li class="on-sale">
                  <div class="pkg-img">
                  <img src="../images/farms/eagle-street-rooftop-farm/2.jpg" alt="Leafy Green Package" />
                  </div>
                  <h3><a>Cornacopia</a></h3>
                  <h4>$12.00 / month<span>$15.00 / month</span></h4>
                  <p>Some description of the package. It might contain a list or just text.</p>
                  <div class="add-cart">
                  <!-- PAYPAL BUTTON GOES HERE -->
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="GX567SZGRXMFC">

                  <input type="hidden" name="currency_code" value="USD">
                  <input type="submit" border="0" name="submit" class="add-cart-button">
                  </form>
                  <!--/PAYPAL BUTTON-->
                  </div>
                  </li>
                  <li class="sold-out">
                  <div class="pkg-img">
                  <img src="../images/farms/eagle-street-rooftop-farm/3.jpg" alt="Leafy Green Package" />
                  </div>
                  <h3><a>Gardener's dream</a></h3>
                  <h4>SOLD OUT <span>$12.00 / month</span></h4>
                  <p>Some description of the package. It might contain a list or just text.</p>
                  <div class="add-cart">
                  <!-- PAYPAL BUTTON GOES HERE -->
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="GX567SZGRXMFC">

                  <input type="hidden" name="currency_code" value="USD">
                  <input type="submit" border="0" name="submit" class="add-cart-button">
                  </form>
                  <!--/PAYPAL BUTTON-->
                  </div>
                  </li>
                 */
                ?>
            </ul><!--/.packages-->

        </div><!--/.column.right-->
    </div><!--/.block.farm-->


</div><!--/.content-->

<div id="back-to-top">
    <img src="../images/back-to-top.png"/>
</div>

<script src="js/map.js"></script>
<script src="js/infobox_packed.js"></script>
<script>
    initMap('<?= $_POST['addressbar'] ?>');
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
            }, 500, 'easeInOutCubic');
        });
    });
</script>
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
