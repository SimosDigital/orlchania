<?php

session_start();
//ob_start();

// php populate html table from mysql database
$hostname1 = $_SESSION['hostname1'];
$databaseName1 = $_SESSION['database1'];
$hostname2 = $_SESSION['hostname2'];
$databaseName2 = $_SESSION['database2'];
$username = $_SESSION['loggedUser']; 
$password = $_SESSION['loggedPwd'];

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
    $connect1 = mysql_connect($hostname1, $username, $password);
    $connect2 = mysql_connect($hostname2, $username, $password);
    if(!$connect1 || !$connect2 ) {
        die("Problem with the database");
    }
    else {
        mysql_select_db($databaseName1);
        mysql_set_charset('utf8',$connect1);
        mysql_select_db($databaseName2);
        mysql_set_charset('utf8',$connect2);
    }

    // mysql select query
$query1 = "SELECT visit.VisitID, person.PersonID, visit.VisitDate, visit.VisitTime, visit.visitDB, visit.VisitReceipt, person.PersonSurName,
            person.PersonFirstName, person.PersonBirth, person.PersonInsurance,
            person.PersonPhone,visit.VisitDiagnosis, visit.VisitTreatment, visit.VisitCost
          FROM orlchania.person INNER JOIN orlchania.visit ON person.PersonID=visit.VisitPerson
          UNION SELECT visit.VisitID, person.PersonID, visit.VisitDate, visit.VisitTime, visit.visitDB, visit.VisitReceipt, person.PersonSurName,
            person.PersonFirstName, person.PersonBirth, person.PersonInsurance,
            person.PersonPhone,visit.VisitDiagnosis, visit.VisitTreatment, visit.VisitCost
          FROM neraida.person INNER JOIN neraida.visit ON person.PersonID=visit.VisitPerson";

          //ORDER by visit.VisitDate DESC, visit.VisitTime ASC;";

$result1=mysql_query($query1, $connect1) or die('Error, query failed');
/*
$query2 = "SELECT visit.VisitID, person.PersonID, visit.VisitDate, visit.VisitTime, visit.VisitReceipt, person.PersonSurName,
            person.PersonFirstName, person.PersonBirth, person.PersonInsurance,
            person.PersonPhone,visit.VisitDiagnosis, visit.VisitTreatment, visit.VisitCost
          FROM person INNER JOIN visit ON person.PersonID=visit.VisitPerson
          ORDER by visit.VisitDate DESC, visit.VisitTime ASC;";

$result2=mysql_query($query2, $connect2) or die('Error, query failed');
*/

?>


<!-- Table  -->
<table id="orlTable" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>V-ID</th>
            <th>P-ID</th>
            <th>Ημερομηνία</th>
            <th> Ώρα</th>
            <th> DB</th>
            <th>Αρ. απόδ</th>
            <th>Επώνυμο</th>
            <th>Όνομα</th>
            <th>Ετών</th>
            <th>Ασφάλεια</th>
            <th>Τηλέφωνο</th>
            <th>Διάγνωση</th>
            <th>Θεραπεία</th>
            <th>Κόστος</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row1 = mysql_fetch_array($result1)) {?>
        <tr>
            <td><?=$row1[0]?></td>
            <td><?=$row1[1]?></td>
            <td><?=/*date('d-m-Y', strtotime(*/$row1[2]/*))*/?></td>
            <td><?=$row1[3]?></td>
            <td><?=$row1[4]?></td>
            <td><?=$row1[5]?></td>
            <td><?=$row1[6]?></td>
            <td><?=$row1[7]?></td>
            <td><?=date("Y/m/d")- $row1[8]?></td>
            <td><?=$row1[9]?></td>
            <td><?=$row1[10]?></td>
            <td><?=$row1[11]?></td>
            <td><?=$row1[12]?></td>
            <td><?=$row1[13]?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div data-toggle="modal" data-target="#test-modal">
</div>

<div id='visitform'>
    <div class='modal fade' id='test-modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='display: none;'>
        <div class='modal-dialog'>
            <div class='loginmodal-container'>
                <h1>Επίσκεψη στο Ιατρείο</h1><br>
                <form name='logdb' method='post' action='pages/checkdb.php'>
                    <h3>Στοιχεία Ασθενή</h3>
                        <div id='selPerson'>
                        </div>
                    <!--<input type='text' name='username' placeholder='Username'>
                    <input type='password' name='password' placeholder='Password'>
                    <input type='submit' name='login' class='login loginmodal-submit' value='Login'>-->
                </form>
            </div>
        </div>
    </div>
</div>

<div id='test'>
test
</div>

<script>

    $(document).ready(function(){
        $('#orlTable').DataTable({
            paging: true,
            scrollY: 600,
            order: [[2,'ASC'],[3,'ASC']],
            lengthMenu: [ [20, 50, 100, -1], [20, 50, 100, "All"] ]
        });

        var table = $('#orlTable').DataTable();

        table.column( 0 ).visible( false );
        table.column( 1 ).visible( false );
        //table.column(1).order('asc').draw();
 
        $('#orlTable tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
            var exporttable = table.row( this ).data() ;
            document.getElementById('test').innerHTML = 'Μονό κλικ (exporttable [ ]). Ασθενής:' + exporttable[1] + ' , Επίσκεψη: ' + exporttable[0];
        } );

        $('#orlTable tbody').on( 'dblclick', 'tr', function () {
            var selRow = table.row( this ).data() ;
            document.getElementById('tester').innerHTML = 'Διπλό κλικ ($selRow [ ]).    Ασθενής:' + selRow[1] + ' , Επίσκεψη: ' + selRow[0];

            //document.getElementById('selPerson').load('personForm.php');
            //$('#selPerson').load('personForm.php');
            //alert (selRow[1]);

            $.post("pages/personForm.php",{selPerson: selRow[1]}, function(data, status){
                //alert("Data: " + data + "\nStatus: " + status);
                document.getElementById('selPerson').innerHTML = data;
                //document.getElementById('selPerTest').innerHTML = String(data);
                $('#test-modal').modal('show');


            });
        });
    });
</script>
