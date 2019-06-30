<?php

include_once '../database.inc.php'; // to connect to DB

// Create instance of DB class
$db = new Db();

//echo $_SESSION['loggedInAs'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classes</title>
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
        <h2>Viewing All Classes</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h2>Click on Class ID to view students</h2>
        <table>
            <tr>
                <th><b>Class ID</b></th>
                <th><b>Class Name</b></th>
                <th><b>Class Year</b></th>
                <th><b>Class Grade</b></th>
            </tr>

            <?php

            $rows = $db -> select("SELECT * FROM Class");

            // For each record in the array
            foreach ($rows as $key => $value) {
                if ($value['classGrade'] == 1){
                    $classGrade = 'Lower Secondary';
                } elseif ($value['classGrade'] == 2) {
                    $classGrade = 'Upper Secondary Art';
                } elseif ($value['classGrade'] == 3) {
                    $classGrade = 'Upper Secondary Science';
                }
                echo "<tr><td><a href='studentsInClass.php?classID=".$value['classID']."'>".$value['classID']."</a></td>"; // subjectID
                echo "<td>".$value['className']."</td>"; // subName
                echo "<td>".$value['classYear']."</td>"; // subName
                echo "<td>".$classGrade."</td></tr>"; // subType
            }

            ?>

        </table>
        <br>
        <a href="<?php if($_SESSION['loggedInAs'] === 1){ echo '../schoolTeacher/schoolTeacher.php'; } else { echo '../schoolAdmin/adminClasses/adminClasses.html'; } ?>">
            <button type="button">Back</button>
        </a>
    </section>
</section>

</body>
</html>