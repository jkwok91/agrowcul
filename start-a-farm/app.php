<div id="title">
    <h1>The Hyper-Local Food Network is Here.</h1>
</div>
<div id="content" class="block">
    <div id="zoom">
        <a id="zoom-minus">&ndash;</a>
        <a id="zoom-plus">+</a>
    </div>
    <div id="map-wrapper">
        <div id="map">
        </div>
    </div>
    <div id="intro">
        <p>Click on a circle to explore that neighborhood</p>
    </div>
    <div id="info" style="display:none">
        <div style="margin-bottom: 25px; border-bottom: 1px solid #f0f0f0;">
            <h3 id="vis-nbhd-name">Neighborhood Data</h3>
        </div>
        <div>
            <div id="vis-petitions" class="vis-column">
                <h4 style="color:#2ba196"><img src="images/petition.png"/> Petitions<span class="vis-count" style="background-color: #15bcb0; margin-right: 15px;">0</span></h4>
                <div class="vis-content">
                    <div id="vis-petitions-types">
                        <p class="vis-subheader">Customer Types:</p>
                        <div id="vis-petitions-labels">
                            <p>Individuals</p>
                            <p>Restaurants</p>
                            <p>Schools</p>
                            <p>Others</p>
                        </div>
                        <div id="vis-petitions-bars">
                            <div class="vis-bar" id="bar-individual">
                                <span class="vis-percent">0</span>
                            </div>
                            <div class="vis-bar" id="bar-restaurant">
                                <span class="vis-percent">0</span>
                            </div>
                            <div class="vis-bar" id="bar-schools">
                                <span class="vis-percent">0</span>
                            </div>
                            <div class="vis-bar" id="bar-others">
                                <span class="vis-percent">0</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div id="vis-products">
                        <p class="vis-subheader">Products Requested:</p>
                        <p id="vis-products-list" style="font-size: 13px;"></p>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="vis-no-content" style="display:none">
                    Petition for a farm in this neighborhood!<br/>
                    <a id="petition" class="open-petition">Send one now</a>
                </div>
            </div>
            <div id="vis-farms" class="vis-column">
                <h4 style="color:#eb7c5e"><img src="images/farm.png"/> Farms<span class="vis-count" style="background-color: #f09b86; margin-right: 15px;">0</span></h4>
                <div class="vis-content">
                    <div id="vis-farms-list">

                    </div>
                    <div style="margin-top: 30px;"><a class="vis-open-petition open-petition">Send a Petition</a></div>
                </div>
                <div class="vis-no-content" style="display:none">
                    <p>We need your help getting more farms in this neighborhood.</p>
                    <br/>
                    <p>If you own a farm and would like to sell on agrowculture, click the button on the bottom left and start selling!</p>
                    <div style="margin-top: 30px;"><a class="vis-open-petition open-petition">Send a Petition</a></div>
                </div>
            </div>
            <div id="vis-projects" class="vis-column">
                <h4><img src="images/project.png"/> Projects<span class="vis-count" style="background-color: #8e8473">0</span></h4>
                <div class="vis-content">
                    content
                </div>
                <div class="vis-no-content" style="display:none">
                    <p>There are currently no ongoing farm projects in this neighborhood.</p>
                    <br/>
                    <p><a style="color: #AAA !important">Start one now</a></p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="action">
        <div id="sell-text">If you grow your own food</div>
        <div id="or">- OR -</div>
        <div id="start-text">Learn how to start</div>
        <a href="../farm/apply.php" id="sell-button"></a>
        <div id="start-button"></div>
        <img id="soon" src="../images/stamp-coming-soon.png"/>
    </div>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.6&sensor=false"></script>
    <script type="text/javascript" src="js/infobox_packed.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
