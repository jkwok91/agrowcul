$().ready(function() {
	
    //init front page
    var aboveFold = true;
    $('#menu_drop').slideDown(300);
    
    var $w = $(window),
    thresh = $('#first').offset().top + $('#first').height();
    $w.scroll(function(){
        var top = $w.scrollTop();
        if (top > thresh) {
            $('#menu_drop').slideUp(300);
            aboveFold = false;
        } else {
            $('#menu_drop').slideDown(300);
            aboveFold = true;
        }
    });

    $('#nav').hover(
        function() {
            $('#menu_drop').slideDown(300);
        },
        function() {
            if (!aboveFold) {
                $('#menu_drop').slideUp(300);
            }
        }
        );
        
    $('#logo').attr('href','../');
    
    $('.goto').click(function(){
        scr(4);
    });
    
    $(".open-petition").click(function (e) {
        e.preventDefault();
        $(".black-container").fadeIn(300, function () {
            var t = (window.innerHeight - 550)/2;
            $(".envelop").css('top',(window.innerHeight+100)+'px').show().animate({
                top: t < 80 ? 80 : t
            }, 300 );
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
    
    $('#petition-submit').click(function(e){
        e.preventDefault();
        if (validateForm()) {
            setPetitionCoords(insertPetition);
        }
    });
            
    setBlocksResize();

    function setBlocksResize() {
        var h = $(window).height();
        if (h<580) h = 580;
        $('.block-cont').css('height', h+'px');
    }

    //resize handler
    $(window).resize(function() {
        setBlocksResize();
    });


    //interaction handlers
    $('#menu').hover(
        function() {
            $('#menu_list').slideToggle(300);
        },
        function() {
            $('#menu_list').slideToggle(300);
        }
        );


    $('.nav_link').click(function() {
        var id = $(this).attr("id").match(/\d+/);
        scr(id);
        return false;
    });

    $('#read').click(function() {
        scr('0');
    });

    function scr(id) {
        var h = $(window).height();
        if (h<580) h = 580;
	
        $(window.opera?'html':'html, body').animate({
            scrollTop:h*id-h
        }, 800);
    }
});

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
    var sw = new google.maps.LatLng(40.66188943992168, -74.11737442016602),
    ne = new google.maps.LatLng(40.86186213158185, -73.72615814208984),
    bounds = new google.maps.LatLngBounds(sw, ne);
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