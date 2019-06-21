<?php

include_once 'database.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Login Page</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

</head>

<body>

<section class="centerContent">
    <img src="images/MIT_Logo.svg" height="100px" width=auto alt="MIT Logo" />
</section>
<br>
<section class="centerContent">

    <section class="loginChoiceBox col centerContent perfectCenter">
        <h1>Login as:</h1>
        <a href="schoolTeacher/schoolTeacher.php"><button type="button">Teacher</button></a>
        <a href="schoolAdmin/schoolAdmin.php"><button type="button">Admin</button></a>
    </section>


</section>

</body>
</html>