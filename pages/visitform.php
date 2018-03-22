<?php

echo '<h1>chek</h1>';

    if (isset($_POST['id'])) {
        echo '<h1>OK</h1>';

        showClient($_POST['id']);

        function showClient($x) {
           // your business logic





           $hostname = "localhost";
           $userName = $_SESSION['loggedUser'];
           $userPwd = $_SESSION['loggedPwd'];
           $databaseName = "orlchania";
           $selCustomer = $_POST['selCustomer'];
           $selVisit = $_POST['selVisit'];
           
           echo "
           <script>
               document.getElementById('tester').innerHTML = '<p> $setCustomer </p>
           <p> $setVisit </p>';
           </script>;
           ";
           
           error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
               $connect = mysql_connect($hostname, $userName, $userPwd);
               if(!$connect) {
                   die("Problem with the database");
               }
               else {
                   mysql_select_db($databaseName);
                   mysql_set_charset('utf8',$connect);
               }
           
           //mysql select query
           $query = "SELECT * FROM person WHERE person.PersonID = $selCustomer";
           $result=mysql_query($query, $connect) or die('Error, query failed');
           
           $resultString = '';
           
           for ($i=0;$i<10;$i++) {
               $resultString += '<p>' & $result[$i] & '</p>';
           };
           
           echo "
               <script>
                   $('#test-modal').modal('show');
                   document.getElementById('tester').innerHTML = 'good';
               </script>
           ";
           












        }

    }






?>


<script>
//    document.getElementById('visitformlabel').innerHTML = exporttable[0];
</script>
