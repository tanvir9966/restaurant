<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div id="map"></div>

</body>
</html>

<script>
    var map;
    var markers = [];
    var lat, long;

    function getMap() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            document.write("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        lat= position.coords.latitude;
        long= position.coords.longitude;

        document.getElementById("one").value= lat;
        document.getElementById("two").value= long;

        initMap();

        function initMap() {
            var haightAshbury = {lat: lat, lng: long};

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: haightAshbury,
            });

            // This event listener will call addMarker() when the map is clicked.
            map.addListener('click', function(event) {
                addMarker(event.latLng);

                lat= event.latLng.lat();
                long= event.latLng.lng();

                document.getElementById("one").value= lat;
                document.getElementById("two").value= long;
            });

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);
        }

        // Adds a marker to the map and push to the array.
        function addMarker(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            clearMarkers();
            markers = [];
            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

    }

</script>


<br><br>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&callback=getMap">
</script>


<form id="pos" action="save-map.php" method="post">
    <input type="hidden" id="one" name="one" />
    <input type="hidden" id="two" name="two" />

    <div class="form-group">
        <label for="date">Order date</label>
        <input type="date" class="form-control" name="date">
    </div>

    <div class="form-group">
        <label for="address">Time: &nbsp;</label>
        <select name="time" class="custom-select" style="font-weight: bold">

            <option disabled selected>00</option>

            <?php

            for ($i= 1; $i<=12; $i++)
            {
                ?>

                <option value= <?php echo $i ?>><?php echo $i ?></option>

                <?php
            }

            ?>

        </select>

        &nbsp; &nbsp; <select class="custom-select" name="state" style="font-weight: bold">
            <option value="am">AM</option>
            <option value="pm">PM</option>
        </select>
    </div>

    <button id="pos-sub" class="btn btn-outline-success btn-block">Confirm order</button>
</form>

<br><br>

<span id="act"></span>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $("#pos-sub").click( function() {
        $.post( $("#pos").attr("action"),
            $("#pos :input").serializeArray(),
            function(info){ $("#act").html(info);
            });
    });

    $("#pos").submit( function() {
        return false;
    });
</script>
