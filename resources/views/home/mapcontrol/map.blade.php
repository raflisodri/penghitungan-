@extends('template.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Map</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div id="map"></div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([-2.5, 118], 5); 

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var southWest = L.latLng(-11, 94),
                northEast = L.latLng(6, 141);
            var bounds = L.latLngBounds(southWest, northEast);

            map.setMaxBounds(bounds);
            map.on('drag', function() {
                map.panInsideBounds(bounds, { animate: false });
            });

            $.ajax({
                url: '{{route('location')}}',
                method: 'GET',
                success: function (data) {
                    data.forEach(function (location) {
                        var marker = L.marker([location.lat, location.lng]).addTo(map)
                            .bindPopup(location.popup);

                        marker.on('click', function() {
                            map.setView([location.lat, location.lng], 12); 
                            marker.openPopup();
                        });
                    });
                },
                error: function (error) {
                    console.log("Error loading data:", error);
                }
            });
        });
    </script>
</body>
</html>

@endsection