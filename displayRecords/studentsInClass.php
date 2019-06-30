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
        <h2>Viewing Students in Class</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <table>
            <tr>
                <th><b>Student ID</b></th>
                <th><b>Student</b></th>
                <th><b>Class</b></th>
                <th><b>Total Score</b></th>
                <th><b>Final Grade</b></th>
            </tr>

            <?php

            // TODO HALFWAY DONE NEED TO SHOW SCORES FOR ALL STUDENTS IN A SPECIFIC CLASS

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $classID = $_GET['classID'];
                $query = "SELECT sc.stuID, stuFName, stuLName FROM StudentClass sc JOIN Student s 
                            ON sc.stuID=s.stuID WHERE classID=$classID ORDER BY s.stuID";
                $rows = $db -> select($query);

                // For each record in the array
                foreach ($rows as $key => $value) {
                    $studentID = $value['stuID'];
                    $query = "select round(sum(subScore)/count(subScore)) as TotalScore from StudentReport where stuID=$studentID";
                    $rows = $db->query($query);
                    foreach ($rows as $key1 => $value1) {
                        $totalScore = $value1['TotalScore'];
                        if ($totalScore >= 90) {
                            $finalGrade = 'A';
                        } elseif ($totalScore >= 80 && $totalScore <= 89) {
                            $finalGrade = 'B';
                        } elseif ($totalScore >= 70 && $totalScore <= 79) {
                            $finalGrade = 'C';
                        } elseif ($totalScore >= 60 && $totalScore <= 69) {
                            $finalGrade = 'D';
                        } elseif ($totalScore < 60) {
                            $finalGrade = 'F';
                        }
                    }
                    $studentName = $value['stuFName']." ".$value['stuLName'];
                    echo "<tr><td><a href='studentReport.php?stuID=".$studentID."'>".$studentID."</a></td>";
                    echo "<td>".$studentName."</td>";
                    echo "<td>".$classID."</td>";
                    echo "<td>$totalScore</td>";
                    echo "<td>$finalGrade</td></tr>";
                }
            }

            ?>

        </table>
        <br>
        <a href="javascript:history.back()"><button type="button">Back</button></a>
    </section>
</section>

</body>
</html>