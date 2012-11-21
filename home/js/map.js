//check hash
var hash = window.location.hash.replace('#','');

//LatLng Bounds for determining Search and Petition location
//Modify to allow search in different areas
var sw = new google.maps.LatLng(40.66188943992168, -74.11737442016602),
ne = new google.maps.LatLng(40.86186213158185, -73.72615814208984),
bounds = new google.maps.LatLngBounds(sw, ne);

function initMap(address) {
    var map,
    gc = new google.maps.Geocoder(),
    options = setupOptions(),
    styles = setupStyle(),
    markerIcon = getMarker(),
    markerShadow = getShadow(),
    markerShape = getShape(),
    iboptions = setupInfoWindowOptions(),
    ib = new InfoBox(iboptions),
    currentMarker;
    
    if (hash) {
        $.ajax({
            url: '../api/getFarmById.php?id='+hash,
            success: function(farm) {
                //console.log(farm);
                var p = new google.maps.LatLng(farm.info.lat, farm.info.lng);
                options.center = p;
                buildMap();
                findFarms(p);
            }
        });
    } else {
    
        gc.geocode({
            address: address,
            bounds: bounds
        }, function(result, status){
            var p;
            if (status == google.maps.GeocoderStatus.OK) {
                p = result[0].geometry.location;
            } else {
                p = new google.maps.LatLng(40.714353, -74.005973);
            }
            options.center = p;
            buildMap();
            findFarms(p);
        });
    }
    
    function buildMap() {
        map = new google.maps.Map(document.getElementById('map'), options);
        map.mapTypes.set('agrowculture', new google.maps.StyledMapType(styles));
        map.setMapTypeId('agrowculture');
    }
    
    function findFarms(p) {
        $.ajax({
            url: '../api/getFarmsByLocation.php?lat='+p.lat()+'&lng='+p.lng(),
            success: function(data){
                if (data.error) {
                //console.log(data.error);
                } else if (data.farms.length > 1) {
					$('#hasfarms').show();
                    buildMarkers(data.farms);
                } else {
                    $('#nofarms').show();
                }
            },
            error: function(a, b, c) {
                console.log(a);
            }
        });
    }
    
    function buildMarkers(farms) {
        var list = $('#farm-list');
        var markers = [];
        for (var i=0, j=farms.length-1; i<j; i++){
            var farm = farms[i],
            a = $('<span/>').html(farm.name),
            li = $('<li/>').addClass('farm-name').append(a),
            marker = buildMarker(farm);
            list.prepend(li);
            markers[i] = marker;
            a.data('id',i);
            a.click(function(){
                var marker = markers[$(this).data('id')];
                showFarm(marker);
            });
            a.hover(function(){
                var marker = markers[$(this).data('id')];
                showBox(marker);
            }, hideBox);
            
            if (farm.id == hash) {
                showFarm(marker, true);
            }
        }
    }
    
    function buildMarker(farm) {
        var marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(farm.lat, farm.lng),
            shadow: markerShadow,
            icon: markerIcon,
            shape: markerShape
        });
        var circle = new google.maps.Circle({
            strokeColor: "#178d82",
            strokeOpacity: 0.6,
            strokeWeight: 1,
            fillColor: "#2BA196",
            fillOpacity: 0.3,
            map: map,
            center: new google.maps.LatLng(farm.lat,farm.lng),
            radius: farm.radius*1609.344
        });
        marker.data = farm;
        google.maps.event.addListener(marker, 'mouseover', function(){
            showBox(marker);
        });
        google.maps.event.addListener(marker, 'mouseout', hideBox);
        google.maps.event.addListener(marker, 'click', function(){
            showFarm(marker);
        });
        return marker;
    }
    
    function showBox(marker) {
        var html = $('<div/>').html(marker.data.name)
        .css({
            'width':'140px',
            'background':'rgba(0,0,0, 0.7)',
            'padding':'8px 12px',
            'font-size':'11px',
            'line-height':'14px',
            'letter-spacing':'1px',
            'border-radius':'4px',
            'box-shadow':'0px 0px 6px #999',
            'color':'#fff'
        });
        ib.setContent(html.get(0));
        ib.open(map, marker);
    }
    
    function hideBox(marker) {
        ib.close();
    }
    
    function showFarm(marker, noslide) {
        map.panTo(marker.getPosition());
        window.location.hash = marker.data.id;
        var $farm = $('#farm-block');
        if (currentMarker == marker.data.id) {
            slideToFarm();
            return false;
        }
        currentMarker = marker.data.id;
        var visible = $farm.is(':visible');
        if (visible) {
            $farm.fadeTo(300, 0, function(){
                buildFarm(marker.data, function(){
                    $farm.fadeTo(300, 1, function(){
                        slideToFarm();
                    });
                });
            });
        } else {
            buildFarm(marker.data, function(){
                $farm.show();
                slideToFarm();
            });
        }
        
        function slideToFarm() {
            if (!noslide) {
                //console.log($farm.offset().top-30);
                $(window.opera?'html':'html, body').animate({
                    scrollTop: $farm.offset().top-30
                }, 750, 'easeInOutCubic');
            }
        }
    }
    
}


function setupOptions() {
    return {
        zoom: 13,
        center: null,
        zoomControl: false,
        scaleControl: false,
        mapTypeControl: false,
        streetViewControl: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        panControl: false,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    }
}
    
function setupStyle() {
    return [
    {
        featureType: 'water',
        elementType: 'all',
        stylers: [
        {
            lightness: 40
        }
        ]
    },
    {
        featureType: 'poi',
        elementType: 'all',
        stylers: [
        {
            visibility: 'off'
        }
        ]
    },
    {
        featureType: 'water',
        elementType: 'all',
        stylers: [
        {
            visibility: 'simplified'
        }
        ]
    },
    {
        featureType: "transit",
        elementType: "all",
        stylers: [
        {
            visibility: "off"
        }
        ]
    },
    {
        featureType: "road",
        elementType: "geometry",
        stylers: [
        {
            visibility: "simplified"
        },

        {
            hue: "#dfc697"
        },

        {
            saturation: -55
        },

        {
            lightness: 40
        }
        ]
    },
    {
        featureType: "road",
        elementType: "labels",
        stylers: [
        {
            visibility: "off"
        }
        ]
    },
    {
        featureType: "road.local",
        elementType: "geometry",
        stylers: [
        {
            visibility: "off"
        }
        ]
    },
    {
        featureType: "road.arterial",
        elementType: "geometry",
        stylers: [
        {
            visibility: "simplified"
        }
        ]
    },
    {
        featureType: "landscape",
        elementType: "geometry",
        stylers: [
        {
            hue: '#f4f4f4'
        },

        {
            saturation: -100
        },

        {
            lightness: 50
        }
        ]
    },
    {
        featureType: "administrative",
        elementType: "all",
        stylers: [
        {
            visibility: 'off'
        }
        ]
    },
    {
        featureType: "administrative.locality",
        elementType: "labels",
        stylers: [
        {
            visibility: 'on'
        }
        ]
    },
    {
        featureType: "administrative.neighborhood",
        elementType: "labels",
        stylers: [
        {
            visibility: 'on'
        }
        ]
    }
    ];
}

function getMarker() {
    return new google.maps.MarkerImage(
        '../images/marker.png',
        new google.maps.Size(29, 27),
        new google.maps.Point(0,0),
        new google.maps.Point(8, 25)
        );
}

function getShadow() {
    return new google.maps.MarkerImage(
        '../images/shadow.png',
        new google.maps.Size(29, 27),
        new google.maps.Point(0,0),
        new google.maps.Point(6, 25)
        );
}

function getShape() {
    return {
        coord: [11, 0, 23, 11, 11, 39, 0 , 11],
        type: 'poly'
    };
}

function setupInfoWindowOptions() {
    return {
        maxWidth: 0,
        content : '',
        pixelOffset : new google.maps.Size(20, -30),
        pane: 'floatPane',
        enableEventPropagation: false,
        disableAutoPan: true,
        closeBoxURL:''
    };
}

function slideToggle(el, bShow){
    var $el = $(el), height = $el.data("originalHeight"), visible = $el.is(":visible");
    if( arguments.length == 1 ) bShow = !visible;
    if( bShow == visible ) return false;
    if( !height ){
        height = $el.show().height();
        $el.data("originalHeight", height);
        if( !visible ) $el.hide().css({
            height: 0
        });
    }
    if( bShow ){
        $el.show().animate({
            height: height
        }, {
            duration: 350
        });
    } else {
        $el.animate({
            height: 0
        }, {
            duration: 350, 
            complete:function (){
                $el.hide();
            }
        });
    }
}

function buildFarm(farm, callback) {
    //TODO paypal integration
    $.ajax({
        url: '../api/getFarmById.php?id='+farm.id,
        success: function(farm) {
            //console.log(farm);
            updateInfo(farm.info);
            updateProducts(farm.products);
            callback();
        }
    });
}

function updateInfo(info) {
    $('#farm-name').html(info.name);
    $('#farm-address').html(info.address);
    $('#farm-phone').html(info.phone);
    $('#farm-email').html(info.email).attr('href','mailto:'+info.email);
    $('#farm-about').html(info.description);
    $('#social-tt').attr({
        'data-url': encodeURI(window.location.href),
        'data-text':'Check out '+info.name+ ' on Agrowculture!'
    });
    $('#social-tt-script').attr('src','http://platform.twitter.com/widgets.js');
}

function updateProducts(products) {
    var $c = $('#farm-products').html('');
    if (products.length < 1) {
        $c.html('<li style="color: #fff; margin-left: 20px; background: none;">No product found for this farm.</li>');
    } else {
        for (var i=0, j=products.length; i<j; i++) {
            var p = products[i];
            $c.append(buildProduct(p));
        }
    }
}

function buildProduct(p) {
    var $li = $('<li/>'),
    path = '../images/farms/'+p.farm_id+'/';
    if (p.soldout == 1) {
        $li.addClass('sold-out');
    } else if (p.onsale == 1) {
        $li.addClass('on-sale');
    }
    else if (p.isnew == 1) $li.addClass('new');
    $('<div/>').addClass('pkg-img').append($('<img/>').attr('src',path+p.image).attr('alt',p.name)).appendTo($li);
    $('<h3/>').append($('<a/>').html(p.name)).appendTo($li);
    if (p.soldout == 1) {
        $('<h4/>').html('SOLD OUT').append($('<span/>').html('$'+p.price+' / month')).appendTo($li);
    } else if (p.onsale == 1) {
        $('<h4/>').html('$'+p.saleprice+' / month').append($('<span/>').html('$'+p.price+' / month')).appendTo($li);
    } else {
        $('<h4/>').html('$'+p.price+' / month').appendTo($li);
    }
    $('<p/>').html(p.description).appendTo($li);
    $li.append(buildPaypalButton());
    return $li;
}

function buildPaypalButton() {
    var $b = $('<div/>').addClass('add-cart');
    $('<input/>').attr({
        'type':'submit',
        'name':'submit',
        'border':'0'
    }).addClass('add-cart-button').appendTo($b);
    return $b;
}

//User Interactions Handling ------------------------------------------------------

$(function(){
    $("#address-search").inlineComplete({
	    terms: "../../nbhds.json"
    }); 
    $(".open-petition").click(function (e) {
        e.preventDefault();
        $(".black-container").fadeIn(300, function () {
            var t = (window.innerHeight - 550)/2;
            $(".envelop").css('top',(window.innerHeight+100)+'px').show().animate({
                top: t < 80 ? 80 : t
            }, 300 );
        });
	 //$("#petition-address").val(hood);
	 $("#petition-address").inlineComplete({
		terms: "../../nbhds.json"
	 });
    });

    $("#close-petition").click(function (e) {
        e.preventDefault();
        $(".envelop").animate({
            top: window.innerHeight+100
        }, 300, function () {
            $(".black-container").fadeOut(300, function(){
                $('.envelop').hide();
            });
        });
    });
    
    $('#contact-button').click(function(e){
        e.preventDefault();
        slideToggle($('#social-contact').get(0));
    })
    
    $('#petition-submit').click(function(e){
        e.preventDefault();
        if (validateForm()) {
            setPetitionCoords(insertPetition);
        }
    })
    
});

function insertPetition(lat, lng) {
    $.ajax({
        url: '../api/getNeighborhoodByLatLng.php?lat='+lat+'&lng='+lng,
        success: function(nbhd) {
            var petitionData = $('#petition-form').serialize();
            $.ajax({
                url:'../api/insertPetition.php?'+petitionData+'&neighborhood='+nbhd,
                success: function(data) {
                    //console.log(data);
                    $('#thanks-address').val(data.address);
                    $('#thanks-id').val(data.id);
                    $('#thanks-form').submit();
                }
            });
        }
    });
}

function validateForm() {
    var n = $('#petition-address').val();
    var email = $('#email').val();
    if (n == '' || email == '') {
        alert("Please fill in all fields.");
        return false;
    } else if (!validateEmail(email)) {
        alert("Please enter a valid e-mail address.")
        return false;
    }
    return true;
}

function validateEmail(email) 
{ 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return email.match(re) 
}

function setPetitionCoords(submit) {
    var gc = new google.maps.Geocoder();
    gc.geocode({
        address: $('#petition-address').val(),
        bounds: bounds
    }, function(result, status){
        if (status == google.maps.GeocoderStatus.OK) {
            var p = result[0].geometry.location;
            $('#petition-lat').val(p.lat());
            $('#petition-lng').val(p.lng());
            submit(p.lat(), p.lng());
			//console.log(p.lat() + ' ' +p.lng());
        } else {
            alert('Uh-oh... we cannot locate the neighborhood.')
        }
    });
}

jQuery.extend( jQuery.easing,
{
    easeInOutCubic: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t + b;
        return c/2*((t-=2)*t*t + 2) + b;
    }
});
