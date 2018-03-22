<?php

    //session_start(); //ob_start();

    /* php populate html table from mysql database
    $hostname = $_SESSION['hostname1']; $databaseName = $_SESSION['database1'];
    $username = $_SESSION['loggedUser']; $password = $_SESSION['loggedPwd'];  */

    $hostname = 'localhost';
    $databaseName = 'orlchania';
    $username = 'Giota';
    $password = '2476';
    $selPerson = 90;
    $selVisit = 118;


    error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
        $connect = mysql_connect($hostname, $username, $password);
        if(!$connect) {
            die("Problem with the database");
        }
        else {
            mysql_select_db($databaseName);
            mysql_set_charset('utf8',$connect);
        }

    // mysql select query
    $queryP = "SELECT * FROM person WHERE PersonID = $selPerson;";
    $resultP=mysql_query($queryP, $connect) or die('Error, query failed');

    $queryV = "SELECT * FROM visit WHERE visitID = $selVisit;";
    $resultV=mysql_query($queryV, $connect) or die('Error, query failed');

    $person = mysql_fetch_row( $resultP);
?>


<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class='container'>

            <form class="jumbotron">

                <div class="row" readonly>
                    <div class="form-group col-md-4">
                        <label for="personSurName">Επώνυμο</label>
                        <input type="text" class="form-control" id="personSurName" placeholder="Επώνυμο">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="personFirstName">Όνομα</label>
                        <input type="text" class="form-control" id="personFirstName" placeholder="Όνομα">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="personJob">Επάγγελμα</label>
                        <input type="text" class="form-control" id="personJob" placeholder="Επάγγελμα">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="personBirth">Ημ.γέν/ης</label>
                        <input type="text" class="form-control" id="personBirth" placeholder="Ημ.γέν/ης">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="personAge">Ετών</label>
                        <input type="text" class="form-control" id="personAge" placeholder="Ετών" value= <?=date('Y/m/d')- $person[4];?>>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="personInsurance">Ασφάλεια</label>
                        <input type="text" class="form-control" id="personInsurance" placeholder="Ασφάλεια">
                    </div>

                    <div class="form-group col-md-5">
                        <label for="personArea">Περιοχή</label>
                        <input type="text" class="form-control" id="personArea" placeholder="Περιοχή">
                    </div>
                    <div class="form-group col-md-7">
                        <label for="personAddress">Διεύθυνση</label>
                        <input type="text" class="form-control" id="personAddress" placeholder="Διεύθυνση">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="personMobile">Κινητό τηλ.</label>
                        <input type="text" class="form-control" id="personMobile" placeholder="Κινητό τηλ.">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="personPhone">Τηλέφωνο (2ο)</label>
                        <input type="text" class="form-control" id="personPhone" placeholder="Τηλέφωνο (2)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="personEmail">e-mail</label>
                        <input type="email" class="form-control" id="personEmail" placeholder="e-mail">
                    </div>

                </div>

            </form>

       </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <?php
        echo "
            <script>
                $(document).ready(function() {
                    document.getElementById('personSurName').value = '$person[1]';
                    document.getElementById('personFirstName').value = '$person[2]';
                    document.getElementById('personJob').value = '$person[3]';
                    document.getElementById('personBirth').value = '$person[4]';
                    //document.getElementById('personAge').value = '5';
                    document.getElementById('personInsurance').value = '$person[5]';
                    document.getElementById('personArea').value = '$person[6]';
                    document.getElementById('personAddress').value = '$person[7]';
                    document.getElementById('personMobile').value = '$person[8]';
                    document.getElementById('personPhone').value = '$person[9]';
                    document.getElementById('personEmail').value = '$person[10]';
                });
            </script>
        ";
    ?>

    </body>
</html>