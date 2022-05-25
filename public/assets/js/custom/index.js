$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    toggleDisabled();

    var locationFrom = new google.maps.places.Autocomplete((document.getElementById('location-from')), {
        types: ['geocode'],
    });

    google.maps.event.addListener(locationFrom, 'place_changed', function () {
        var near_place = locationFrom.getPlace();
        $('#location-from-lat').val(locationFrom.getPlace().geometry.location.lat());
        $('#location-from-lng').val(locationFrom.getPlace().geometry.location.lng());
    });

    var locationTo = new google.maps.places.Autocomplete((document.getElementById('location-to')), {
        types: ['geocode'],
    });

    google.maps.event.addListener(locationTo, 'place_changed', function () {
        var near_place = locationTo.getPlace();
        $('#location-to-lat').val(locationTo.getPlace().geometry.location.lat());
        $('#location-to-lng').val(locationTo.getPlace().geometry.location.lng());
    });

    $('#current-location').on('click', function (e) {
        e.preventDefault();

        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function (pos) {
                let geocoder = new google.maps.Geocoder();

                $('#location-from-lat').val(pos.coords.latitude);
                $('#location-from-lng').val(pos.coords.longitude);

                var location = {lat: pos.coords.latitude, lng: pos.coords.longitude}
                geocoder.geocode({'location': location}, function (response) {

                    $('#location-from').val(response[0].formatted_address);

                })

            });

        } else {
            alert('current location not support by this browser');
        }

    });

    $('#current-location').on('click', function (e) {
        e.preventDefault();

        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function (pos) {
                let geocoder = new google.maps.Geocoder();

                $('#location-from-lat').val(pos.coords.latitude);
                $('#location-from-lng').val(pos.coords.longitude);

                var location = {lat: pos.coords.latitude, lng: pos.coords.longitude}
                geocoder.geocode({'location': location}, function (response) {

                    $('#location-from').val(response[0].formatted_address);

                })

            });

        } else {
            alert('current location not support by this browser');
        }

    });

});//end of document ready

function toggleDisabled() {

    $('form div').each(function () {
        if ($(this).is(':hidden')) {
            $(this).children().find('input').attr('disabled', true)
        } else {
            $(this).children().find('input').attr('disabled', false)
        }

    });


}//end of checkInput
