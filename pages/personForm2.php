<?php

    if($_POST["selPerson"])
    {
    $selPersonID = $_POST["selPerson"];

    session_start(); //ob_start();

    // php populate html table from mysql database
    $hostname = $_SESSION['hostname1'];
    $databaseName = $_SESSION['database1'];
    $username = $_SESSION['loggedUser'];
    $password = $_SESSION['loggedPwd'];

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
    $queryP = "SELECT * FROM person WHERE PersonID = $selPersonID;";
    $resultP=mysql_query($queryP, $connect) or die('Error, query failed');

    $queryV = "SELECT * FROM visit WHERE visitID = $selVisit;";
    $resultV=mysql_query($queryV, $connect) or die('Error, query failed');

    $person = mysql_fetch_row( $resultP);
    }

    echo "
        <form class='jumbotron'>
            <div class='row' readonly>
                <div class='form-group col-md-4'>
                    <label for='personSurName'>Επώνυμο</label>
                    <input type='text' class='form-control' id='personSurName' placeholder='Επώνυμο'>
                </div>
                <div class='form-group col-md-4'>
                    <label for='personFirstName'>Όνομα</label>
                    <input type='text' class='form-control' id='personFirstName' placeholder='Όνομα'>
                </div>
                <div class='form-group col-md-4'>
                    <label for='personJob'>Επάγγελμα</label>
                    <input type='text' class='form-control' id='personJob' placeholder='Επάγγελμα'>
                </div>

            </div>
        </form>

        <script>
            //$(document).ready(function() {
                document.getElementById('personSurName').value = '$person[1]';
                document.getElementById('personFirstName').value = '$person[2]';
                document.getElementById('personJob').value = '$person[3]';
            //});
        </script>
    ";
?>


