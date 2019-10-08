<?php
require('services.php');
session_start();
getSystemData($db,'gateway');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gateway Login</title>
    <link rel="stylesheet" href="login/login.css">
</head>
<body>
    <div class="wrapper" style="overflow: auto;">

        <div class="container" style="padding: 0vh 0;">
            <form class="form">
                <button type="submit" style="width: 130px;margin: 3px;" id="save-button">Gateway</button>
                <button type="submit" style="width: 130px;margin: 3px;" id="save-button">Stations</button>
                <button type="submit" style="width: 130px;margin: 3px;" id="save-button">Datasources</button>
                <button type="submit" style="width: 130px;margin: 3px;" id="save-button">Sensors</button>
            </form>
            <h1 id="loader">Add your first Gateway </h1>
            <form class="form" id="gateway-form">

                <input type="text" id="label" name="name" placeholder="Name">
                <select id="protocol" name="protocol" type="text">
                    <option value="tcp/ip" selected>TCP/IP</option>
                    <option value="mqtt">MQTT</option>
                    <option value="lorawan">LoRaWAN</option>
                </select>
                <input type="text" id="ip" name="ip" placeholder="ip">
                <input type="text" id="port" name="port" placeholder="port">
                <input type="text" id="coordination" name="coordination" placeholder="Longitude | Latitude">
                <input type="text" id="address" name="address" placeholder="address">
                <input type="text" id="live_date" name="live_date" placeholder="live_date" hidden>
                <button type="submit" id="save-gateway">Save</button>

                <div id="error"></div>
                <br>
            </form>
        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//rawgit.com/carlo/jquery-base64/master/jquery.base64.min.js"></script>
    <!-- <script src="login.js"></script> -->
    <script src="https://unpkg.com/dexie@latest/dist/dexie.js"></script>
    <script>

        $("#save-gateway").click(function(event){
            event.preventDefault();
            var formData = new FormData(document.querySelector('#gateway-form'))

            console.log(formData);
        });

    </script>
    <script>
        $("#coordination").click(function(event){
            event.preventDefault();
            getLocation();
        });
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            console.log("Latitude: " + position.coords.latitude +"<br>Longitude: " + position.coords.longitude);
            $("#coordination").val(position.coords.latitude+" , "+position.coords.longitude);
        }
    </script>
</body>
</html>