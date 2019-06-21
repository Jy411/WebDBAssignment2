<?php

include_once '../database.inc.php'; // to connect to DB

$db = new Db();

$_SESSION['loggedInAs'] = 2;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator</title>
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
        <h3>Logged in as Admin!</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Select an option for more choices.</h4>
        <a href="adminSubjects/adminSubjects.html"><button type="button">Subjects</button></a>
        <a href="adminStudents/adminStudents.html"><button type="button">Students</button></a>
        <a href="adminClasses/adminClasses.html"><button type="button">Classes</button></a>
        <a href="registerStudent.php"><button type="button">Register Student to class</button></a>
        <a href="../displayRecords/studentClass.php"><button type="button">Student Class Ledger</button></a>

        <a href="../index.php"><button type="button">Back</button></a>

    </section>
</section>


</body>
</html>