<?php
session_start();
$_SESSION['petitioned'] = true;

$id = "requestthanks";
$title = "Thanks for your request";
require('header.php');

//$message = "A farm was requested for " . $_POST["neighborhood"] . " by " . $_POST["email"];
// In case any of our lines are larger than 70 characters, we should use wordwrap()
//$message = wordwrap($message, 70);
// Send
//mail('nick@agrowculture.org', 'Farm request', $message);
?>
<div class="content" >

    <div class='block thankyou clearfix'>
        <div class="inset  clearfix">
            <div class="stamp thank-you">[Image: Thank you for your support]</div>
            <h2>You&rsquo;re great</h2>
            <p>
                Help future farmers understand the needs in the community, tell 'em what food you want:
            </p>
            <div id="info">
                <form id="info-form">
                    <p>
                        <span class="label">What's your name? (optional)</span>
                        <input type="text" name="name"/>
                    </p>
                    <p>
                        <span class="label">What kind of customer are you?</span>
                        <select id="custType" name="custType">
                            <option value="Individual">Individual</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="School">School</option>
                            <option value="Others">Community Center</option>
                        </select>
                        <br/>
                        <span id="custType-others" type="text" style="display:none;">Please specify: <input name="custType-others"/></span>
                    </p>
                    <p>
                        <span class="label">What kind of products are you interested in? (check all that apply)</span>
                        <input type="checkbox" name="Leafy Vegetables" value="cb Leafy Vegetables"/> Leafy Vegetables<br/>
                        <input type="checkbox" name="Vine Vegetables" value="cb Vine Vegetables"/> Vine Vegetables<br/>
                        <input type="checkbox" name="Honey" value="cb Honey"/> Honey<br/>
                        <input type="checkbox" name="Wax" value="cb Wax"/> Wax<br/>
                        <input type="checkbox" name="Fruit" value="cb Fruit"/> Fruit<br/>
                        <input type="checkbox" name="Herbs" value="cb Herbs"/> Herbs<br/>
                        <input type="checkbox" name="Spice" value="cb Spice"/> Spice<br/>
                        <input type="checkbox" name="Cheese" value="cb Cheese"/> Cheese<br/>
                        <input type="checkbox" name="Canned Goods" value="cb Canned Goods"/> Canned Goods<br/>
                        <input type="checkbox" name="Preserves" value="cb Preserves"/> Preserves<br/>
                        <input type="checkbox" name="Bread" value="cb Bread"/> Bread<br/>
                        <input type="checkbox" name="Baked Goods" value="cb Baked Goods"/> Baked Goods<br/>
                        <input type="checkbox" name="Micro-brew" value="cb Micro-brew"/> Micro-brew<br/>
                        <input type="checkbox" name="Mushrooms" value="cb Mushrooms"/> Mushrooms<br/>
                        <input type="checkbox" name="Eggs" value="cb Eggs"/> Eggs<br/>
                        <input type="checkbox" name="Juice" value="cb Juice"/> Juice<br/>
                        <input type="checkbox" name="Other" value="cb Other"/> Other<br/>
                        <input type="hidden" name="id" value="<?= $_POST['id'] ?>"/>
                        <input type="hidden" name="email" value="<?= $_SESSION['email'] ?>"/>
		    </p>
                    <a id="info-submit">Submit</a>
                </form>
            </div>
            <p>
                We appreciate your support and are working hard to get a farm in 
                <?php
                if ($_POST["address"] != "")
                    echo $_POST["address"];
                else
                    echo "your neighborhood";
                ?> 
                soon. When one arrives, we will get in touch via e-mail.
            </p>
            <p id="takealook" style="display:none;">Please <strong><a href="../start-a-farm/">take a look</a></strong> at all the petitions sent by others. And don't forget to tell your friends what we're up to and help New York City Go Local!</p>
            <ul class="social">
                <li class="left">
                    <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.agrowculture.org" data-text="I just petitioned for an urban farm in my neighborhood here. You should too!" data-count="horizontal" data-via="agrowculture">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </li>
                <li>
                    <iframe src="http://www.facebook.com/plugins/like.php?app_id=177787128957459&amp;href=http%3A%2F%2Fwww.agrowculture.org&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
                </li>

            </ul><!--/.social-->
        </div><!--/.inset-->
    </div><!-- /.thankyou -->

</div><!--/.content-->
<script>
    $('#custType').change(function(){
        if (this.value == 'Others') {
            $('#custType-others').show();
        } else {
            $('#custType-others').hide();
        }
    });
<?php if ($_POST['id']): ?>
        $('#info-submit').click(function(){
            $(this).unbind();
            var data = $('#info-form').serialize();
	    console.log(data);
            $.ajax({
                url:'../api/updatePetition.php?'+data,
                success: function(d) {
                    console.log(d);
                    if (d=='success') {
                        $('#info-submit').css({
                            'cursor':'auto',
                            'background':'url(../images/thankyou.png) 0 0 no-repeat'
                        });
                        $('#takealook').slideDown();
                        $(window.opera?'html':'html, body').animate({
                            scrollTop: $('#takealook').get(0).offsetTop
                        }, 500);
                    }
                }
            });
        });
<?php endif; ?>
</script>

<?php require('../includes/footer.php'); ?>
