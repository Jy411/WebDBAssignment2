<?php

include_once '../database.inc.php'; // to connect to DB

$sql = "SELECT * FROM Subject";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);

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
                <th>Subject ID</th>
                <th>Subject Name</th>
                <th>Subject Type</th>
            </tr>

            <?php

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row['subID']."</td>"; // subjectID
                    echo "<td>".$row['subName']."</td>"; // subName
                    echo "<td>".$row['subType']."</td></tr>"; // subType
                }
            } else {
                echo "There are no subjects to display!";
            }
            ?>
        </table>


    </section>
</section>

</body>
</html>