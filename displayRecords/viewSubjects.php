<?php

include_once '../database.inc.php'; // to connect to DB
include_once '../includes.php'; // the functions are located here

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
        <h3>Viewing All Subjects</h3>
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

            $result = getAllSubjects($conn);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    if ($row['subType'] == 'C'){
                        $subType = 'Core';
                    } else {
                        $subType = 'Selective';
                    }
                    echo "<tr><td>".$row['subID']."</td>"; // subjectID
                    echo "<td>".$row['subName']."</td>"; // subName
                    echo "<td>".$subType."</td></tr>"; // subType
                }
            } else {
                echo "There are no subjects to display!";
            }

            ?>

        </table>

        <br>
        <a href="javascript:history.back()"><button type="button">Back</button></a>

    </section>
</section>

</body>
</html>