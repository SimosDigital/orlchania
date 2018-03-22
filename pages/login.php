<?php

session_start();
//ob_start();

$username = $_POST['username']; 
$password = $_POST['password'];
$hostname = $_SESSION['hostname1'];
$databaseName = $_SESSION['database1'];

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
    $connect = mysql_connect($hostname, $username, $password);

    if($connect) {
        $_SESSION['logged'] = 1;
        $_SESSION['loggedUser'] = $username;
        $_SESSION['loggedPwd'] = $password;
        header("Location: ../");
    }
    else {
        $_SESSION['logged'] = 0;
        $_SESSION['loggedUser'] = NULL;
        $_SESSION['logged_pwd'] = NULL;
        header("Location: ../");
    }

?>
