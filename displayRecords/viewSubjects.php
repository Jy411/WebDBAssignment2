<?php

include_once '../database.inc.php'; // to connect to DB

// Create instance of DB class
$db = new Db();

//echo $_SESSION['loggedInAs'];
// if logged in as teacher
//if ($_SESSION['loggedInAs'] === 1) {
//
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subjects</title>
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
        <h2>Viewing All Subjects</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <table>
            <tr>
                <th><b>Subject ID</b></th>
                <th><b>Subject Name</b></th>
                <th><b>Subject Type</b></th>
            </tr>

            <?php

            $rows = $db -> select("SELECT * FROM Subject");

            // For each record in the array
            foreach ($rows as $key => $value) {
                if ($value['subType'] == 'C'){
                    $subType = 'Core';
                } else {
                    $subType = 'Selective';
                }
                echo "<tr><td>".$value['subID']."</td>"; // subjectID
                echo "<td>".$value['subName']."</td>"; // subName
                echo "<td>".$subType."</td></tr>"; // subType
            }

            ?>

        </table>
        <br>
        <a href="<?php if($_SESSION['loggedInAs'] === 1){ echo '../schoolTeacher/schoolTeacher.php'; } else { echo '../schoolAdmin/adminSubjects/adminSubjects.html'; } ?>">
            <button type="button">Back</button>
        </a>

    </section>
</section>

</body>
</html>