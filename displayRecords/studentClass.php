<?php

include_once '../database.inc.php'; // to connect to DB

// Create instance of DB class
$db = new Db();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Class List</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
</head>
<body>

<section class="centerContent">
    <img src="../images/MIT_Logo.svg" height="100px" width=auto alt="MIT Logo" />
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox centerContent perfectCenter">
        <h2>Viewing All Students and Classes</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <table>
            <tr>
                <th><b>Student</b></th>
                <th><b>Class</b></th>
                <th><b>Class Year</b></th>
                <th><b>Class Grade</b></th>
            </tr>

            <?php


            $query = "SELECT S.stuID, stuFName, stuLName, className, classYear, classGrade FROM Student S 
                        INNER JOIN StudentClass SC ON S.stuID = SC.stuID 
                        INNER JOIN Class C on SC.classID = C.classID";
            $rows = $db -> select($query);

            // For each record in the array
            foreach ($rows as $key => $value) {
                $stuID = $value['stuID'];
                $studentName = $value['stuFName']." ".$value['stuLName'];
                if ($value['classGrade'] == 1){
                    $classGrade = 'Lower Secondary';
                } elseif ($value['classGrade'] == 2) {
                    $classGrade = 'Upper Secondary Art';
                } elseif ($value['classGrade'] == 3) {
                    $classGrade = 'Upper Secondary Science';
                }
//                echo "<tr><td><a href='../addScoreToStudent.php?stuID=".$stuID."'>".$stuID.' '.$studentName."</a></td>";
                echo "<tr><td>".$stuID.' '.$studentName."</td>";
                echo "<td>".$value['className']."</td>";
                echo "<td>".$value['classYear']."</td>";
                echo "<td>".$classGrade."</td></tr>";
            }

            ?>

        </table>
        <br>
        <a href="javascript:history.back()"><button type="button">Back</button></a>
    </section>
</section>

</body>
</html>