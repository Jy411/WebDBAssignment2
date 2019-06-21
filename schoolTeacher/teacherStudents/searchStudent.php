<?php
include_once '../../database.inc.php';

// Create instance of DB
$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stuID = $_POST['stuID'];
    $stuName = $_POST['stuName'];

//    echo $_GET['searchID'];
//    echo $_GET['searchName'];
//
//    echo $stuID;
//    echo $stuName;

    if ($_GET['searchID']) {
//        $query = "SELECT * FROM Student WHERE ((CONCAT(stuFName, ' ', stuLName) LIKE '%$stuName%') OR (stuID = $stuID))";
        $query = "SELECT * FROM Student WHERE stuID = $stuID";
        $rows = $db -> select($query);
    } elseif ($_GET['searchName']) {
        $query = "SELECT * FROM Student WHERE (CONCAT(stuFName, ' ', stuLName) LIKE '%$stuName%')";
        $rows = $db -> select($query);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Teacher - Students</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../../style.css" rel="stylesheet">
</head>
<body>

<section class="centerContent">
    <img src="../../images/MIT_Logo.svg" height="100px" width=auto alt="MIT Logo" />
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox centerContent perfectCenter">
        <h3>Search for Student</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Input student details.</h4>

        <form action="searchStudent.php?searchID=1" method="post">
            <div class="centerContent perfectCenter">
                <label for="studentId">Student ID:&nbsp</label>
                <input type="number" id="studentId" name="stuID" placeholder="Enter Student ID">
            </div>
            <div class="centerContent perfectCenter">
                <button type="submit">Search by ID</button>
            </div>
        </form>
        <form action="searchStudent.php?searchName=1" method="post">
            <div class="centerContent perfectCenter">
                <label for="studentName">Student Name:&nbsp</label>
                <input type="text" id="studentName" name="stuName" placeholder="Enter Student Name">
            </div>
            <div class="centerContent perfectCenter">
                <button type="submit">Search by Name</button>
            </div>
        </form>

        <div class="centerContent perfectCenter">
            <table>
                <tr>
                    <th><b>Student ID</b></th>
                    <th><b>Student First Name</b></th>
                    <th><b>Student Last Name</b></th>
                    <th><b>Student Gender</b></th>
                </tr>

                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    foreach ($rows as $key => $value) {
                        $studentID = $value['stuID'];
                        echo "<tr><td><a href='../../displayRecords/studentReport.php?stuID=".$studentID."'>".$studentID."</a></td>";
                        echo "<td>".$value['stuFName']."</td>";
                        echo "<td>".$value['stuLName']."</td>";
                        echo "<td>".$value['stuGender']."</td></tr>";
                    }
                }

                ?>

            </table>
        </div>

        <a href="teacherStudents.php"><button type="button">Back</button></a>

    </section>
</section>

</body>
</html>