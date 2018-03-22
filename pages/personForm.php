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
                    <input type='text' class='form-control' id='personSurName' placeholder='Επώνυμο' value='$person[1]'>
                </div>
                <div class='form-group col-md-4'>
                    <label for='personFirstName'>Όνομα</label>
                    <input type='text' class='form-control' id='personFirstName' placeholder='Όνομα' value='$person[2]'>
                </div>
                <div class='form-group col-md-4'>
                    <label for='personJob'>Επάγγελμα</label>
                    <input type='text' class='form-control' id='personJob' placeholder='Επάγγελμα' value='$person[3]'>
                </div>

                <div class='form-group col-md-3'>
                    <label for='personBirth'>Ημ.γέν/ης</label>
                    <input type='text' class='form-control' id='personBirth' placeholder='Ημ.γέν/ης' value='", date('d/m/Y', strtotime($person[4])),"'>
                </div>
                <div class='form-group col-md-1'>
                    <label for='personAge'>Ετών</label>
                    <input type='text' class='form-control' id='personAge' placeholder='Ετών' value='", date('Y/m/d')- $person[4],"'>
                </div>
                <div class='form-group col-md-4'>
                    <label for='personInsurance'>Ασφάλεια</label>
                    <input type='text' class='form-control' id='personInsurance' placeholder='Ασφάλεια' value='$person[5]'>
                </div>

                <div class='form-group col-md-5'>
                    <label for='personArea'>Περιοχή</label>
                    <input type='text' class='form-control' id='personArea' placeholder='Περιοχή' value='$person[6]'>
                </div>
                <div class='form-group col-md-7'>
                    <label for='personAddress'>Διεύθυνση</label>
                    <input type='text' class='form-control' id='personAddress' placeholder='Διεύθυνση' value='$person[7]'>
                </div>

                <div class='form-group col-md-3'>
                    <label for='personMobile'>Κινητό τηλ.</label>
                    <input type='text' class='form-control' id='personMobile' placeholder='Κινητό τηλ.' value='$person[9]'>
                </div>
                <div class='form-group col-md-3'>
                    <label for='personPhone'>Τηλέφωνο (2ο)</label>
                    <input type='text' class='form-control' id='personPhone' placeholder='Τηλέφωνο (2)' value='$person[8]'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='personEmail'>e-mail</label>
                    <input type='email' class='form-control' id='personEmail' placeholder='e-mail' value='$person[10]'>
                </div>                
            </div>
        </form>
    ";
?>
