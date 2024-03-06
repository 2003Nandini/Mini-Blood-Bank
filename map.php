<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearest Hospitals</title>
    <style>
        #map {
            height: 60vh;
            width: 100%;
        }
    </style>
</head>
<body>

    <h2>Find Nearest Hospitals</h2>

    <div id="map"></div>

    <script>
        function initMap() {
            // Check if Geolocation is supported
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var userLatLng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: userLatLng,
                        zoom: 13
                    });

                    // Add a marker for the user's location
                    var userMarker = new google.maps.Marker({
                        position: userLatLng,
                        map: map,
                        title: 'Your Location'
                    });

                    // Simulated data source of hospital locations
                    var hospitals = [
                        { name: 'Hospital A', lat: 37.7750, lng: -122.4300 },
                        { name: 'Hospital B', lat: 37.7800, lng: -122.4100 },
                        { name: 'Hospital C', lat: 37.7700, lng: -122.4200 },
                        // Add more hospitals as needed
                    ];

                    // Calculate and display nearest hospitals
                    hospitals.forEach(function (hospital) {
                        var hospitalLatLng = { lat: hospital.lat, lng: hospital.lng };
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, hospitalLatLng);

                        // Add a marker for the hospital
                        var hospitalMarker = new google.maps.Marker({
                            position: hospitalLatLng,
                            map: map,
                            title: hospital.name + ' - Distance: ' + (distance / 1000).toFixed(2) + ' km'
                        });
                    });

                }, function () {
                    handleLocationError(true);
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false);
            }

            function handleLocationError(browserHasGeolocation) {
                var errorMessage = browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.';
                console.error(errorMessage);
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: 37.7749, lng: -122.4194 }, // Default to San Francisco, CA
                    zoom: 13
                });
            }
        }
    </script>

    <!-- Load the Google Maps JavaScript API with your API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8_FoR8fDCxED1EM5NQ4CZ9R40Mcssokw&callback=initMap" async defer></script>

</body>
</html>
