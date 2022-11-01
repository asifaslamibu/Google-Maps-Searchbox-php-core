<?php

require_once 'config.php';

// Fetch the marker info from the database 
$result = $mysqli->query("SELECT * FROM `locations` WHERE (SELECT MAX(id) FROM `locations`) ORDER BY id DESC LIMIT 0,1;");

// Fetch the info-window data from the database 
$result2 = $mysqli->query("SELECT * FROM `locations` WHERE (SELECT MAX(id) FROM `locations`) ORDER BY id DESC LIMIT 0,1;");
?>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style>
        #mapCanvas {
            width: 100%;
            height: 650px;
        }
    </style>
</head>

<body>
    
    <div id="mapCanvas"></div>
    <script>
        function initMap() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap',
                styles: [{
              elementType: "geometry",
              stylers: [{
                color: "#242f3e"
              }]
            },
            {
              elementType: "labels.text.stroke",
              stylers: [{
                color: "#242f3e"
              }]
            },
            {
              elementType: "labels.text.fill",
              stylers: [{
                color: "#746855"
              }]
            },
            {
              featureType: "administrative.locality",
              elementType: "labels.text.fill",
              stylers: [{
                color: "#d59563"
              }],
            },
            {
              featureType: "poi",
              elementType: "labels.text.fill",
              stylers: [{
                color: "#d59563"
              }],
            },
            {
              featureType: "poi.park",
              elementType: "geometry",
              stylers: [{
                color: "#263c3f"
              }],
            },
            {
              featureType: "poi.park",
              elementType: "labels.text.fill",
              stylers: [{
                color: "#6b9a76"
              }],
            },
            {
              featureType: "road",
              elementType: "geometry",
              stylers: [{
                color: "#38414e"
              }],
            },
            {
              featureType: "road",
              elementType: "geometry.stroke",
              stylers: [{
                color: "#212a37"
              }],
            },
            {
              featureType: "road",
              elementType: "labels.text.fill",
              stylers: [{
                color: "#9ca5b3"
              }],
            },
            {
              featureType: "road.highway",
              elementType: "geometry",
              stylers: [{
                color: "#746855"
              }],
            },
            {
              featureType: "road.highway",
              elementType: "geometry.stroke",
              stylers: [{
                color: "#1f2835"
              }],
            },
            {
              featureType: "road.highway",
              elementType: "labels.text.fill",
              stylers: [{
                color: "#f3d19c"
              }],
            },
            {
              featureType: "transit",
              elementType: "geometry",
              stylers: [{
                color: "#2f3948"
              }],
            },
            {
              featureType: "transit.station",
              elementType: "labels.text.fill",
              stylers: [{
                color: "#d59563"
              }],
            },
            {
              featureType: "water",
              elementType: "geometry",
              stylers: [{
                color: "#17263c"
              }],
            },
            {
              featureType: "water",
              elementType: "labels.text.fill",
              stylers: [{
                color: "#515c6d"
              }],
            },
            {
              featureType: "water",
              elementType: "labels.text.stroke",
              stylers: [{
                color: "#17263c"
              }],
            },
          ]
            };

            // Display a map on the web page
            map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
            map.setTilt(10);

            // Multiple markers location, lat, and longitude
            var markers = [
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '["' . $row['name'] . '", ' . $row['lat'] . ', ' . $row['lng'] . ', "' . $row['icon'] . '"],';
                    }
                }
                ?>
            ];

            // Info window content
            var infoWindowContent = [
                <?php if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) { ?>['<div class="info_content">' +
                            '<h3><?php echo $row['name']; ?></h3>' +
                            '<p><?php echo $row['info']; ?></p>' + '<p><?php echo $row['lat'], $row['lng']; ?></p>' + '</div>'],
                <?php }
                }
                ?>
            ];

            // Add multiple markers to map
            var infoWindow = new google.maps.InfoWindow(),
                marker, i;

            // Place each marker on the map  
            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: markers[i][3],
                    title: markers[i][0],
                    Location: markers[i][4],

                });

                // // Add info window to marker    

                var infoWindow = new google.maps.InfoWindow();
                infoWindow.setContent(markers[i][0]);
                infoWindow.open(map, marker);



                //                 google.maps.event.addListener(marker, 'click', (function(marker, i) {
                //     return function() {
                //         infoWindow.setContent(infoWindowContent[i][0]);
                //         infoWindow.open(map, marker);
                //     }
                // })(marker, i));
                // Center the map to fit all markers on the screen
                map.fitBounds(bounds);
            }

            // Set zoom level
            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(5);
                google.maps.event.removeListener(boundsListener);
            });
        }

        // Load initialize function
        // google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIwxXlGaEfq5crr2GnLzTRVUoIdR-WhEM&callback=initMap&libraries=&v=weekly" async></script>
    </div>
</body>

</html>