<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstarp Library -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- JQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- JQuery UI Library -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Google Javascript Library -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWAEgZTc7ku6rDgmVUWkXmpHDhw-uTg0M"></script>
    <script src='https://codepen.io/stabla/pen/PGVvJB.js'></script>
<script src='https://use.fontawesome.com/a0735bfa73.js'></script>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBwIMGpCqD2PmWykQvNMrenPPif7hi1tiI&libraries=geometry'></script>
<script src='https://raw.githubusercontent.com/nmccready/google-maps-utility-library-v3-infobox/master/dist/infobox.min.js'></script>
<script src='https://raw.githubusercontent.com/mahnunchik/markerclustererplus/master/dist/markerclusterer.min.js'></script><script  src="./script.js"></script>


    <title>Google Map</title>
</head>

<style>
    #geomap {
        width: 100%;
        height: 400px;
    }
</style>

<body>

    <!-- search input box -->
    <form>
        <div class="form-group input-group">
            <input type="text" id="search_location" class="form-control" placeholder="Search location">
            <div class="input-group-btn">
                <button class="btn btn-default get_map" type="submit">
                    Locate
                </button>
            </div>
        </div>
    </form>

    <!-- display google map -->
    <div id="geomap"></div>

    <!-- display selected location information -->
    <h4>Location Details</h4>
    <p>Address: <input type="text" class="search_addr" size="45"></p>
    <p>Latitude: <input type="text" class="search_latitude" size="30"></p>
    <p>Longitude: <input type="text" class="search_longitude" size="30"></p>
    <script>
        var geocoder;
        var map;
        var marker;

        /*
         * Google Map with marker
         */
        function initialize() {
            var initialLat = $('.search_latitude').val();
            var initialLong = $('.search_longitude').val();
            initialLat = initialLat ? initialLat : 36.169648;
            initialLong = initialLong ? initialLong : -115.141000;

            var latlng = new google.maps.LatLng(initialLat, initialLong);
            var options = {
                zoom: 16,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("geomap"), options);

            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: latlng
            });

            google.maps.event.addListener(marker, "dragend", function() {
                var point = marker.getPosition();
                map.panTo(point);
                geocoder.geocode({
                    'latLng': marker.getPosition()
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        marker.setPosition(results[0].geometry.location);
                        $('.search_addr').val(results[0].formatted_address);
                        $('.search_latitude').val(marker.getPosition().lat());
                        $('.search_longitude').val(marker.getPosition().lng());
                    }
                });
            });

        }

        $(document).ready(function() {
            //load google map
            initialize();

            /*
             * autocomplete location search
             */
            var PostCodeid = '#search_location';
            $(function() {
                $(PostCodeid).autocomplete({
                    source: function(request, response) {
                        geocoder.geocode({
                            'address': request.term
                        }, function(results, status) {
                            response($.map(results, function(item) {
                                return {
                                    label: item.formatted_address,
                                    value: item.formatted_address,
                                    lat: item.geometry.location.lat(),
                                    lon: item.geometry.location.lng()
                                };
                            }));
                        });
                    },
                    // select: function(event, ui) {
                    //     $('.search_addr').val(ui.item.value);
                    //     $('.search_latitude').val(ui.item.lat);
                    //     $('.search_longitude').val(ui.item.lon);
                    //     var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                    //     marker.setPosition(latlng);
                    //     initialize();
                    // }
                });
            });

            /*
             * Point location on google map
             */
            $('.get_map').click(function(e) {
                var address = $(PostCodeid).val();
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        marker.setPosition(results[0].geometry.location);
                        $('.search_addr').val(results[0].formatted_address);
                        $('.search_latitude').val(marker.getPosition().lat());
                        $('.search_longitude').val(marker.getPosition().lng());
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
                e.preventDefault();
            });

            //Add listener to marker for reverse geocoding
            google.maps.event.addListener(marker, 'drag', function() {
                geocoder.geocode({
                    'latLng': marker.getPosition()
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('.search_addr').val(results[0].formatted_address);
                            $('.search_latitude').val(marker.getPosition().lat());
                            $('.search_longitude').val(marker.getPosition().lng());
                        }
                    }
                });
            });

            geocoder.geocode({
                'address': request.term,
                componentRestrictions: {
                    country: "us"
                }
            })
        });
    </script>
      <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwIMGpCqD2PmWykQvNMrenPPif7hi1tiI&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
</body>

</html>