<?php
require('../services.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gateway Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
                <?php
                    // TODO
                ?>
            <img src="/iot/assets/logo.png">
            <h1 id="loader">Welcome </h1>

            <form class="form">
                <input type="text" id="username" value="<?php if(detectUser($db) > 0) echo 'admin'; ?>" placeholder="Username">
                <input type="password" id="password" value="<?php if(detectUser($db) > 0) echo 'admin'; ?>" placeholder="Password">
                <button type="submit" id="login-button">Login</button>
                <div id="error"></div>
                <br>
            </form>
            <div class="default-data">
                <center>
                    <p>
                    <?php
                        echo init($db);
                        if (detectUser($db) > 0){
                            echo "username: <b>admin</b> <br> password: <b>admin</b>";
                        }
                    ?>
                    </p>
                </center>
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
    <script src="/iot/database.js"></script>
    <script>

        if(sessionStorage.getItem('_token')){
            var data = $.base64.decode(sessionStorage.getItem('_token')).split(',');
            login(data[0], $.base64.decode(data[1]));
        }

        $("#login-button").click(function(event){
            event.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();
            login(username, password);
        });
        function login(username, password){
            $.ajax({
                type: "GET",
                url: "login.php?username="+username+"&password="+password,
            }).then(function(data){
                if(data != 0){
                    sessionStorage.setItem('_token',data);
                    $('form').fadeOut(500);
                    $('.default-data').fadeOut(500);
                    $('.wrapper').addClass('form-success');
                    var loader = ["","Initializing","Loading gateways","Loading datasources","Checking sensors","Checking protocols", "Loading services", "Loading controllers", "Loading functions", "Generating views"];
                    var i=0;
                    var refreshIntervalId = setInterval(() => {
                        i++;
                        setTimeout(() => {
                            $("#loader").html(loader[i]);
                        }, 500);
                        if(i > loader.length){
                            console.log("done");
                            clearInterval(refreshIntervalId);
                            $("#loader").html("");
                            db.tables.forEach(element => {
                                db.table(element.name).count(function (count) {
                                    $("#loader").append("<p>Detected " + element.name + "s : " + count + "</p>");
                                });
                            });
                            setTimeout(() => {
                                $(".wrapper").append("<form style='text-align-last: center;' class='form'><button type='submit' onclick='javascript:(function() { window.location = '/iot' })()' >Continue</button></form>");
                            }, 500);
                        }
                    }, 500);
                    getSystem();
                }else{
                    $('#error').html("<br><center><font color='red'> Wrong combinations </font></center>");
                }
            });
        }

        function init(list){
            list.forEach(element => {
                sessionStorage.setItem('_'+list[element],"");
            });
        }

        function getSystem(){
            var system = ["user","gateway","station","datasource","sensor"];
            system.forEach(element => {
                populateAJAX(element);
            });
        }
    </script>
</body>
</html>