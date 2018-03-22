<?php

session_start();

// php populate html table from mysql database
$hostname1 = $_SESSION['hostname1'];
$databaseName1 = $_SESSION['database1'];
$userName = $_SESSION['loggedUser'];
$userPwd = $_SESSION['loggedPwd'];

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
    $connect = mysql_connect($hostname1, $userName, $userPwd);
    if(!$connect) {
        die("Problem with the database");
    }
    else {
        mysql_select_db($databaseName1);
        mysql_set_charset('utf8',$connect);
    }

// mysql select query
$query = "SELECT * FROM person 
          ORDER by person.personSurName ASC , person.PersonFirstName ASC;";

$result=mysql_query($query, $connect) or die('Error, query failed');

?>

<!-- Table  -->
<table id="orlTable" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Επώνυμο</th>
            <th>Όνομα</th>
            <th>Εργασία</th>
            <th>Ημ. Γέννησης</th>
            <th>Ασφάλεια</th>
            <th>Περιοχή</th>
            <th>Διεύθυνση</th>
            <th>Σταθερό τηλ</th>
            <th>Κινητό</th>
            <th>e-mail</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = mysql_fetch_array($result)) {?>
        <tr>
            <td><?=$row[1]?></td>
            <td><?=$row[2]?></td>
            <td><?=$row[3]?></td>
            <td><?=$row[4]?></td>
            <td><?=$row[5]?></td>
            <td><?=$row[6]?></td>
            <td><?=$row[7]?></td>
            <td><?=$row[8]?></td>
            <td><?=$row[9]?></td>
            <td><?=$row[10]?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function(){ $('#orlTable').DataTable(); });
</script>
