<?php

include_once 'database.inc.php'; // to connect to DB

// Create instance of DB class
$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Saves studentID to session variable
    $_SESSION['stuID'] = $_GET['stuID'];
//    echo $_SESSION['stuID'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    // ON SUBMISSION OF SCORE
    $subID = $_POST['subID'];
    $subScore = $_POST['subScore'];

//    echo $_SESSION['stuID'];
//    echo '<br>';
//    echo $subID;
//    echo '<br>';
//    echo $subScore;

    $stmt = "INSERT INTO StudentReport VALUES (?,?,?)";
    $db -> preparedInsertStudentReport($stmt, $_SESSION['stuID'], $subID, $subScore);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Exam Score Entry</title>
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
    <section class="loginChoiceBox centerContent perfectCenter">
        <h2>Student Exam Score Entry</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h3>Select Subject and input score</h3>



        <form action="addScoreToStudent.php" method="post">

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
                <button type="submit">Add Exam Score</button>
            </div>


        </form>

        <a href="displayRecords/studentReport.php?stuID=<?php echo $_SESSION['stuID'] ?>"><button type="button">Back</button></a>

    </section>
</section>

</body>
</html>