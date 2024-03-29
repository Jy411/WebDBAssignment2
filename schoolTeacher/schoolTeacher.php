<?php

include_once '../database.inc.php'; // to connect to DB

$db = new Db();

$_SESSION['loggedInAs'] = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Teacher</title>
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
        <h3>Logged in as Teacher!</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Select an option for more choices.</h4>
        <a href="../displayRecords/viewSubjects.php"><button type="button">View All Subjects</button></a>
        <a href="teacherStudents/teacherStudents.php"><button type="button">Students</button></a>
        <a href="../displayRecords/viewClasses.php"><button type="button">View All Classes</button></a>

        <a href="../index.php"><button type="button">Back</button></a>

    </section>
</section>


</body>
</html>