<?php

include_once '../database.inc.php'; // to connect to DB

// Create instance of DB class
$db = new Db();

echo $_SESSION['loggedInAs'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
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
        <h2>Viewing All Students</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h2>Click on Student ID to View Student Scores</h2>
        <table>
            <tr>
                <th><b>Student ID</b></th>
                <th><b>Student First Name</b></th>
                <th><b>Student Last Name</b></th>
                <th><b>Student Gender</b></th>
            </tr>

            <?php

            $rows = $db -> select("SELECT * FROM Student");

            // For each record in the array
            foreach ($rows as $key => $value) {
                $studentID = $value['stuID'];
                if ($value['stuGender'] == 'M'){
                    $stuGender = 'Male';
                } else {
                    $stuGender = 'Female';
                }
                echo "<tr><td><a href='studentReport.php?stuID=".$studentID."'>".$studentID."</a></td>";
                echo "<td>".$value['stuFName']."</td>"; // Student FName
                echo "<td>".$value['stuLName']."</td>"; // Student LName
                echo "<td>".$stuGender."</td></tr>"; // Student Gender
            }

            ?>

        </table>
        <br>
        <a href="<?php if($_SESSION['loggedInAs'] === 1){ echo '../schoolTeacher/teacherStudents/teacherStudents.php'; } else { echo '../schoolAdmin/adminStudents/adminStudents.html'; } ?>">
            <button type="button">Back</button>
        </a>
    </section>
</section>

</body>
</html>