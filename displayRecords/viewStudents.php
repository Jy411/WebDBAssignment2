<?php

include_once '../database.inc.php'; // to connect to DB

// Create instance of DB class
$db = new Db();

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
                if ($value['stuGender'] == 'M'){
                    $stuGender = 'Male';
                } else {
                    $stuGender = 'Female';
                }
                echo "<tr><td>".$value['stuID']."</td>"; // Student ID
                echo "<td>".$value['stuFName']."</td>"; // Student FName
                echo "<td>".$value['stuLName']."</td>"; // Student LName
                echo "<td>".$stuGender."</td></tr>"; // Student Gender
            }

            ?>

        </table>
        <br>
        <a href="javascript:history.back()"><button type="button">Back</button></a>
    </section>
</section>

</body>
</html>