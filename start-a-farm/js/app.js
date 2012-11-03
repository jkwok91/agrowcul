var map,
ib = new InfoBox(setupIBOptions()),
mapOptions = setupOptions(),
mapStyles = setupStyles(),
neighborhoods = [],
zoomMin = 11,
zoomMax = 14,
currentMarker,
activityMax,
sizeMax = 50;

init();

function init() {
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    map.mapTypes.set('agrowculture', new google.maps.StyledMapType(mapStyles));
    map.setMapTypeId('agrowculture');
    
    setupInteractions();
    buildMarkers();
}

function setupInteractions() {
    $('#zoom-plus').click(function(){
        var z = map.getZoom();
        if (z < zoomMax) map.setZoom(z+1);
    });
    
    $('#zoom-minus').click(function(){
        var z = map.getZoom();
        if (z > zoomMin) map.setZoom(z-1);
    });
}

function buildMarkers() {
    $.ajax({
        url: '../api/getNeighborhoods.php',
        success: function(data) {
            var n = data.neighborhoods;
            activityMax = getMax(n);
            for (var i=0, j=n.length; i<j; i++) {
                buildMarker(n[i]);
            }
        }
    })
}

function getMax(n) {
    var max = 0;
    for (var i=0, j=n.length; i<j; i++) {
        var a = n[i];
        a.total = parseInt(a.num_petitions, 10) + parseInt(a.num_farms,10) + parseInt(a.num_projects,10);
        if (a.total > max) max = a.total;
    }
    return max;
}

function buildMarker(n) {
	
	if (! n.total) {
		return false;
	}
	
    var size = n.total/activityMax*sizeMax;
    var icon = getMarkerIcon(size);
    var marker = new google.maps.Marker({
        icon: icon,
        shape: {
            coords:[size, size, size],
            type:"circle"
        },
        map: map,
        position: new google.maps.LatLng(n.lat, n.lng)
    });
    marker.data = n;
    marker.size = size;
    marker.hover = getMarkerHover(size);
    marker.normal = icon;
    neighborhoods.push(marker);
    
    google.maps.event.addListener(marker, 'mouseover', onMarkerOver);
    google.maps.event.addListener(marker, 'mouseout', onMarkerOut);
    google.maps.event.addListener(marker, "click", onMarkerClick);
}

function getMarkerIcon(size) {
    return new google.maps.MarkerImage("images/icon.png", new google.maps.Size(100,100), null, new google.maps.Point(size/2,size/2), new google.maps.Size(size,size));
}

function getMarkerHover(size) {
    return new google.maps.MarkerImage("images/icon_hover.png", new google.maps.Size(100,100), null, new google.maps.Point(size/2,size/2), new google.maps.Size(size,size));
}

function onMarkerOver() {
    this.setIcon(this.hover);
    showInfoBox(this);
}

function onMarkerOut() {
    if (currentMarker !== this) {
        this.setIcon(this.normal);
        hideInfoBox();
    }
}

function onMarkerClick() {
    if (currentMarker !== this) {
        map.setZoom(13);
        map.panTo(this.getPosition());
        if (currentMarker) currentMarker.setIcon(currentMarker.normal);
        currentMarker = this;
        this.setIcon(this.hover);
        visualize(this.data);
    }
}

function showInfoBox(marker) {
    var html = $('<div/>')
        .addClass('infobox')
        .html('<h4>'+marker.data.name+'</h4><ul><li>Petitions<span class="info-num">'+marker.data.num_petitions+'</span></li><li>Farms<span class="info-num">'+marker.data.num_farms+'</span></li><li>Projects<span class="info-num">'+marker.data.num_projects+'</span></li></ul>');
    ib.setContent(html.get(0));
    ib.open(map, marker);
}

function hideInfoBox() {
    ib.close();
}

function visualize(nbhd) {
    $.ajax({
       url: '../api/getNeighborhoodDetailsById.php?id='+nbhd.id,
       success: function(data) {
           $('#vis-nbhd-name').html(nbhd.name);
           $('#vis-petitions .vis-count').html(nbhd.num_petitions);
           $('#vis-farms .vis-count').html(nbhd.num_farms);
           $('#vis-projects .vis-count').html(nbhd.num_projects);
           showPetitions(data.petitions);
           showFarms(data.farms);
           showProjects(data.projects);
           if (!$('#info').is(':visible')) {
               $('#intro').slideUp(function(){
                   $('#info').slideDown();
               });
           }
       }
    });
}

function showPetitions(petitions) {
    if (petitions.length == 0) {
        $('#vis-petitions .vis-content').hide();
        $('#vis-petitions .vis-no-content').show();
    } else {
        $('#vis-petitions .vis-content').show();
        $('#vis-petitions .vis-no-content').hide();
        showTypes(petitions);
        showProducts(petitions);
    }
}

function showTypes(petitions) {
    //console.log(petitions);
    var total = petitions.length,
    ind = 0,
    re = 0,
    sc = 0,
    ot = 0;
    for (var i=0; i<total; i++) {
        var p = petitions[i];
        switch (p.type) {
            case "individual":
                ind++;
                break;
            case "restaurant":
                re++;
                break;
            case "school":
                sc++;
                break;
            default:
                ot++;
                break;
        }
    }
    var max = ind;
    if (re > max) max = re;
    if (sc > max) max = sc;
    if (ot > max) max = ot;
    //if (na > max) max = na;
    $('#bar-individual').width(getWidth(ind)).find('.vis-percent').html(ind).css('color', ind==0 ? '#8e8473':'#fff');
    $('#bar-restaurant').width(getWidth(re)).find('.vis-percent').html(re).css('color', re==0 ? '#8e8473':'#fff');;
    $('#bar-schools').width(getWidth(sc)).find('.vis-percent').html(sc).css('color', sc==0 ? '#8e8473':'#fff');;
    $('#bar-others').width(getWidth(ot)).find('.vis-percent').html(ot).css('color', ot==0 ? '#8e8473':'#fff');;
    
    function getWidth(n) {
        return n/max*168;
    }
}

function showProducts(petitions) {
    var demands = {};
    for (var i=0, j=petitions.length; i<j; i++) {
        var p = petitions[i].demands || [];
        for (var k=0; k<p.length; k++) {
            var n = p[k].name;
            if (!demands[n]) {
                demands[n]=1;
            } else {
                demands[n]++;
            }
        }
    }
    var elm = $('#vis-products-list').html('');
    var count = 0;
    var max = 0;
    var min = 9999;
    for (var product in demands) {
        var num = demands[product];
        if (num > max) max = num;
        if (num < min) min = num;
    }
    var span = max - min;
    for (var product in demands) {
        count++;
        var num = demands[product];
        var pct = span == 0 ? 0.2 : (num - min)/span;
        var bgcolor = 'rgba(248,113,80,'+(0.4+pct*0.6)+')';
        var fontsize = Math.round(10 + pct * 10);
        elm.append('<span class="vis-product" style="background-color:'+bgcolor+'; font-size:'+fontsize+'px;">'+product+'</span>')
    }
    if (count == 0) elm.html('No specific product demand found.');
}

function showFarms(farms) {
    if (farms.length == 0) {
        $('#vis-farms .vis-content').hide();
        $('#vis-farms .vis-no-content').show();
    } else {
        $('#vis-farms .vis-content').show();
        $('#vis-farms .vis-no-content').hide();
        for (var i=0, j=farms.length; i<j; i++) {
            buildFarm(farms[i]);
        }
    }
}

function buildFarm(farm) {
    var icon;
    if (farm.icon == '') {
        icon = 'images/farm_default.png';
    } else {
        icon = '../images/farms/'+farm.id+'/icon.'+farm.icon;
        //console.log(icon);
    }
    url = '../home/findfarms.php#'+farm.id,
    elm = $('<div/>').addClass('vis-farm');
    elm.append('<div class="vis-farm-icon"><img src="'+icon+'"/></div>');
    elm.append('<div class="vis-farm-info"><p class="vis-farm-name">'+farm.name+'</p><p><a class="vis-farm-link" href="'+url+'">Learn More</a></p></div>');
    elm.append('<div class="clear"></div>');
    $('#vis-farms-list').html('').append(elm);
}

function showProjects(projects) {
    if (projects.length == 0) {
        $('#vis-projects .vis-content').hide();
        $('#vis-projects .vis-no-content').show();
    } else {
        $('#vis-projects .vis-content').show();
        $('#vis-projects .vis-no-content').hide();
    }
}

//Options ===============

function setupOptions() {
    return {
        zoom: 11,
        center: new google.maps.LatLng(40.739973, -73.962020),
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

function setupIBOptions() {
    return {
        maxWidth: 0,
        content : '',
        pixelOffset : new google.maps.Size(20, -46),
        pane: 'floatPane',
        enableEventPropagation: false,
        disableAutoPan: true,
        closeBoxURL:''
    };
}

function setupStyles() {
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
            saturation: -60
        },

        {
            lightness: 65
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
    }
    /*,
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
    }*/
    ];
}

/* popup petition */

//LatLng Bounds for determining Search and Petition location
//Modify to allow search in different areas
var sw = new google.maps.LatLng(40.66188943992168, -74.11737442016602),
ne = new google.maps.LatLng(40.86186213158185, -73.72615814208984),
bounds = new google.maps.LatLngBounds(sw, ne);

$(function(){
    
    $(".open-petition").click(function (e) {
        e.preventDefault();
        $(".black-container").fadeIn(300, function () {
            var t = (window.innerHeight - 550)/2;
            $(".envelop").css('top',(window.innerHeight+100)+'px').show().animate({
                top: t < 80 ? 80 : t
            }, 300 );
        });
	 $("#petition-address").val(currentMarker.data.name);
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
    
    $('#petition-submit').click(function(e){
        e.preventDefault();
        if (validateForm()) {
            setPetitionCoords(insertPetition);
        }
    });
    
    $('.pledge input').change(function(){
        if ($(this).val()=='') {
            $(this).removeClass('non-empty');
        } else {
            $(this).addClass('non-empty');
        }
    });
});

function insertPetition(lat, lng) {
    $.ajax({
        url: '../api/getNeighborhoodByLatLng.php?lat='+lat+'&lng='+lng,
        success: function(nbhd) {
            var petitionData = $('#petition-form').serialize();
	     //alert(petitionData);
            $.ajax({
                url:'../api/insertPetition.php?'+petitionData+'&neighborhood='+nbhd,
                success: function(data) {
		      //console.log(data);
                    $('#thanks-address').val(data.address);
                    $('#thanks-id').val(data.id);
                    $('#thanks-form').submit();
                },
				error: function(a,b,c) {
					if (console) console.log(c);
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