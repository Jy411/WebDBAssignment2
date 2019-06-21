<?php

include_once '../database.inc.php'; // to connect to DB

// Create instance of DB class
$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stuID = $_GET['stuID'];
    $_SESSION['stuID'] = $_GET['stuID'];

    $query = "SELECT stuFName, stuLName, StudentReport.subID, subName, subScore FROM StudentReport
                INNER JOIN Student S on StudentReport.stuID = S.stuID
                INNER JOIN Subject S2 on StudentReport.subID = S2.subID WHERE S.stuID=$stuID";

    $rows = $db->query($query);
    foreach ($rows as $key => $value) {
        $studentName = $value['stuFName']." ".$value['stuLName'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    // ON SUBMISSION OF SCORE
    $subID = $_POST['subID'];
    $subScore = $_POST['subScore'];
    $stuID = $_SESSION['stuID'];

    $stmt = "INSERT INTO StudentReport VALUES (?,?,?)";
    $db -> preparedInsertStudentReport($stmt, $_SESSION['stuID'], $subID, $subScore);

    $query = "SELECT stuFName, stuLName, StudentReport.subID, subName, subScore FROM StudentReport
                INNER JOIN Student S on StudentReport.stuID = S.stuID
                INNER JOIN Subject S2 on StudentReport.subID = S2.subID WHERE S.stuID=$stuID";

    $rows = $db->query($query);
    foreach ($rows as $key => $value) {
        $studentName = $value['stuFName']." ".$value['stuLName'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Scores</title>
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
        <h2>Viewing <?php echo $studentName ?>'s Score</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <table>
            <tr>
                <th><b>Subject ID</b></th>
                <th><b>Subject</b></th>
                <th><b>Score</b></th>
            </tr>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                // For each record in the array
                foreach ($rows as $key => $value) {
                    $studentName = $value['stuFName']." ".$value['stuLName'];
                    $subjectName = $value['subName'];
                    $subjectScore = $value['subScore'];
                    $subID = $value['subID'];
                    echo "<tr><td>".$subID."</td>";
                    echo "<td>".$subjectName."</td>";
                    echo "<td>".$subjectScore."</td></tr>";
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // For each record in the array
                foreach ($rows as $key => $value) {
                    $studentName = $value['stuFName']." ".$value['stuLName'];
                    $subjectName = $value['subName'];
                    $subjectScore = $value['subScore'];
                    $subID = $value['subID'];
                    echo "<tr><td>".$subID."</td>";
                    echo "<td>".$subjectName."</td>";
                    echo "<td>".$subjectScore."</td></tr>";
                }
            }
            ?>

        </table>

        <form action="studentReport.php" method="post">
            <div class="centerContent perfectCenter">
                <label for="subID">Subject:&nbsp</label>
                <select id="subID" name="subID" required>
                    <?php
                    /**
                     * Populate the dropdown options with records from Subject
                     */
                    $rows = $db -> select("SELECT * FROM Subject");

                    // For each record in the array
                    foreach ($rows as $key => $value) {
                        $subID = $value['subID'];
                        $subName = $value['subName'];
                        echo "<option value='$subID'>$subName</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="centerContent perfectCenter">
                <label for="subScore">Subject Score: &nbsp</label>
                <input type="number" min="0" max="100" id="subScore" name="subScore" placeholder="Input Exam Score (0-100)" required>
            </div>

            <div class="centerContent perfectCenter">
                <a href="../addScoreToStudent.php?stuID=<?php echo $stuID ?>"><button type="submit">Add Exam Score</button></a>
            </div>
        </form>

        <a href="<?php if($_SESSION['loggedInAs'] === 1){ echo '../schoolTeacher/schoolTeacher.php'; } else { echo '../schoolAdmin/schoolAdmin.php'; } ?>">
            <button type="button">Back</button>
        </a>
    </section>
</section>

</body>
</html>