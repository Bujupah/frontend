<?php
require('services.php');
session_start();
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
    <div class="wrapper">

        <div class="container" style="padding: 0vh 0;">
            <form class="form">
                <button type="button" style="width: 130px;margin: 3px;" onclick="switchTabs(0)" id="gateway" >Gateway (<?php echo sizeof(getSystemData($db,'gateway')); ?>) </button>
                <button type="button" style="width: 130px;margin: 3px;" onclick="switchTabs(1)" id="station" <?php if(sizeof(getSystemData($db,'gateway')) == 0) echo "disabled"; ?>>Stations (<?php echo sizeof(getSystemData($db,'station')); ?>)</button>
                <button type="button" style="width: 170px;margin: 3px;" onclick="switchTabs(2)" id="datasource" <?php if(sizeof(getSystemData($db,'station')) == 0) echo "disabled"; ?>>Datasources (<?php echo sizeof(getSystemData($db,'datasource')); ?>)</button>
                <button type="button" style="width: 130px;margin: 3px;" onclick="switchTabs(3)" id="sensor" <?php if(sizeof(getSystemData($db,'datasource')) == 0) echo "disabled"; ?>>Sensors (<?php echo sizeof(getSystemData($db,'sensor')); ?>)</button>
            </form>
            <div id="gateway-section">
            <?php require('forms/gateway.php'); ?>
            </div>
            <div id="station-section">
            <?php require('forms/station.php'); ?>
            </div>
            <div id="datasource-section">
            <?php require('forms/datasource.php'); ?>
            </div>
            <div id="sensor-section">
            <?php require('forms/sensor.php'); ?>
            </div>
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
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
    <script src="index.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        })
        $("#save-gateway").click(function(event){
            event.preventDefault();
            var $form = $("#gateway-form");
            var data = getFormData($form);
            $.ajax({
                type: "GET",
                url: "post/gateway.php",
                data: data
            }).then(function(data){
                Toast.fire({
                    type: 'success',
                    title: 'Saved successfully'
                })
            });
        });

        $("#save-station").click(function(event){
            console.log("clicked");
            event.preventDefault();
            var $form = $("#station-form");
            var data = getFormData($form);
            $.ajax({
                type: "GET",
                url: "post/station.php",
                data: data
            }).then(function(data){
                Toast.fire({
                    type: 'success',
                    title: 'Saved successfully'
                })
            });
        });
        $("#save-datasource").click(function(event){
            console.log("clicked");
            event.preventDefault();
            var $form = $("#datasource-form");
            var data = getFormData($form);
            $.ajax({
                type: "GET",
                url: "post/datasource.php",
                data: data
            }).then(function(data){
                Toast.fire({
                    type: 'success',
                    title: 'Saved successfully'
                })
            });
        });

        $("#save-sensor").click(function(event){
            console.log("clicked");
            event.preventDefault();
            var $form = $("#sensor-form");
            var data = getFormData($form);
            $.ajax({
                type: "GET",
                url: "post/sensor.php",
                data: data
            }).then(function(data){
                Toast.fire({
                    type: 'success',
                    title: 'Saved successfully'
                })
            });
        });

    </script>
    <script>
        $("#coordination").click(function(event){
            event.preventDefault();
            getLocation();
        });
        $("#live_date").click(function(event){
            event.preventDefault();
            $("#live_date").val(moment().format());
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            $("#coordination").val(position.coords.latitude+","+position.coords.longitude);
        }
    </script>
    <script>
        init()
        function init(){
            $("#station-section").hide();
            $("#datasource-section").hide();
            $("#sensor-section").hide();
            $("#gateway-section").fadeIn(500);
        }
        function switchTabs(i){
            switch (i) {
                case 0:
                    $("#station-section").hide(0);
                    $("#datasource-section").hide(0);
                    $("#sensor-section").hide(0);
                    $("#gateway-section").fadeIn(500);
                    break;
                case 1:
                    $("#gateway-section").hide(0);
                    $("#datasource-section").hide(0);
                    $("#sensor-section").hide(0);
                    $("#station-section").fadeIn(500);
                    break;
                case 2:
                    $("#gateway-section").hide(0);
                    $("#station-section").hide(0);
                    $("#sensor-section").hide(0);
                    $("#datasource-section").fadeIn(500);
                    break;

                default:
                    $("#datasource-section").hide(0);
                    $("#gateway-section").hide(0);
                    $("#station-section").hide(0);
                    $("#sensor-section").fadeIn(500);
                    break;
            }
        }
    </script>
</body>
</html>