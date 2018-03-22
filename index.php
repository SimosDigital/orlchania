<?php
    session_start();
    $_SESSION['hostname1'] = 'localhost';
    $_SESSION['database1'] = 'orlchania';
    $_SESSION['hostname2'] = 'localhost';
    $_SESSION['database2'] = 'neraida2';
?>

<!DOCTYPE html>

<html lang="el">

<head>
	<!-- <base href="http://www.orlchania.gr/"/> 
	<base href="http://localhost/giota/"/> -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="google-site-verification" content="nTwwntCKvv3gcU2mkx7occs-KyfZkrYa9vNwT0-rozM" />

    <title>ΩΡΛ Ασημακοπούλου Παναγιώτα</title>

    <!-- <link rel="canonical" href="http://www.orlchania.gr/"/> -->
    <link rel="shortcut icon" type="image/png" href="images/logo.png"/>

    <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap core CSS -->
    <link href="css/jquery.dataTables.min.css" rel="stylesheet"> <!-- DataTable styles -->
    <link href="css/main.css" rel="stylesheet"> <!-- Custom styles for this template -->
</head>

<body>

    <div class="container adminContainer">

        <div class="navbar navbar-inverse navbar-static-top row">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav">
                        <li id="menu1"><a role="button" id="menu11">Επισκέψεις</a></li>
                        <li id="menu2"><a role="button" id="menu12">Ασθενείς</a></li>
                        <li id="menu3"><a role="button" id="menu13">Μύτη</a></li>
                        <li id="menu4"><a role="button" id="menu14">Λαιμός</a></li>
                        <li id="menu5"><a role="button" id="menu15">Παιδο-ΩΡΛ</a></li>
                        <li id="menu6"><a role="button" id="menu16">Φωτογραφίες</a></li>
                        <li id="menu7"><a role="button" id="menu17">Βιογραφικό</a></li>
                        <li id="menu8"><a role="button" id="menu18">Επικοινωνία</a></li>
                    </ul>
                    <a href="" class="btn btn-primary btn-lg pull-right p-2" role="button"
                        data-toggle="modal" data-target="#login-modal" id="userName">&nbsp Login &nbsp
                    </a>
                </div>
            </div>
        </div>

        <div class="row mainData" id="mainData">
            <!-- Main page data from external txt file -->
        </div>

        <div id=tester>
            tester
        </div>

        <div id=selPerTest>
            selected Person tester
        </div>

    </div>

    <!-- jQuery, bootstrap and other JavaScript plugins -->
    <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>

    <?php

        if (!isset($_SESSION['logged']) || $_SESSION["logged"] != 1) {
            echo "
                <!-- Login modal -->
                <div class='modal fade' id='login-modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='display: none;'>
                    <div class='modal-dialog'>
                        <div class='loginmodal-container'>
                            <h1>Login to Your Account</h1><br>
                            <form name='logdb' method='post' action='pages/login.php'>
                                <input type='text' name='username' placeholder='Username'>
                                <input type='password' name='password' placeholder='Password'>
                                <input type='submit' name='login' class='login loginmodal-submit' value='Login'>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('userName').innerHTML = '&nbsp Login &nbsp';
                    var logged = 0;
                </script>

            ";
        }
        else {
            $loggedUserName = $_SESSION['loggedUser'];
            echo "
                <script>
                    document.getElementById('userName').innerHTML = '&nbsp Γεια σου $loggedUserName &nbsp';
                    var logged = 1;
                </script>

                <!-- Login modal -->
                <div class='modal fade' id='login-modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='display: none;'>
                    <div class='modal-dialog'>
                        <div class='loginmodal-container'>
                            <h1>Αποσύνδεση χρήστη</h1><br>
                            <form name='logdb' method='post' action='pages/login.php'>
                                <input type='submit' name='login' class='login loginmodal-submit' value='Έξοδος'>
                            </form>
                        </div>
                    </div>
                </div>

            ";
        }

        if (!isset($_SESSION['logged'])) {  // Αυτόματα παράθυρο login μόνο τη πρώτη φορά
            echo "
                <script>
                    $('#login-modal').modal();
                </script>
            ";
        }
    ?>

    <script>
        $(document).ready(function() {
            $("#menu11").click(function() {
                //Do stuff when clicked
                $('li').removeClass('active');
                $('#menu1').addClass('active');
                if (logged) { $('#mainData').load('pages/visitList.php'); };
            });
            $("#menu12").click(function() {
                //Do stuff when clicked
                $('li').removeClass('active');
                $('#menu2').addClass('active');
                if (logged) { $('#mainData').load('pages/patients.php'); };
            });
        });
    </script>

</body>

</html>
