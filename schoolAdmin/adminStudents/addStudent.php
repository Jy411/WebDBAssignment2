<?php

include_once '../../database.inc.php';

// Create instance of DB
$db = new Db();

// On form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<script>console.log("Successfully retrieved POST values")</script>';

    /*
     * Retrieve values from POST upon clicking submit
     * */
    $stuID = $_POST['stuID'];
    // Sanitize user input
    $stuFName = str_replace(array('\'', '"'), '', $_POST['stuFName']);
    $stuLName = str_replace(array('\'', '"'), '', $_POST['stuLName']);
    $stuGender = $_POST['stuGender'];

    echo 'ID: '.$stuID;
    echo '<br>';
    echo 'FName: '.$stuFName;
    echo '<br>';
    echo 'LName: '.$stuLName;
    echo '<br>';
    echo 'Gender: '.$stuGender;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Add Student</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../../style.css" rel="stylesheet">

</head>
<body>

<section class="centerContent">
    <img src="../../images/MIT_Logo.svg" height="100px" width=auto alt="MIT Logo" />
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox centerContent perfectCenter">
        <h2>Admin - Add Student</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h3>Input Student Details</h3>

        <form action="addStudent.php" method="post">
            <div class="centerContent perfectCenter">
                <label for="studentId">Student ID:&nbsp</label>
                <input type="number" id="studentId" name="stuID" placeholder="Enter Student ID" required>
            </div>

            <div class="centerContent perfectCenter">
                <label for="studentFName">Student Name:&nbsp</label>
                <input type="text" id="studentFName" name="stuFName" placeholder="Enter Student Name" required>
            </div>

            <div class="centerContent perfectCenter">
                <label for="studentLName">Student Last Name:&nbsp</label>
                <input type="text" id="studentLName" name="stuLName" placeholder="Enter Student Last Name" required>
            </div>

            <div class="centerContent perfectCenter">
                <label for="studentGender">Student Gender:&nbsp</label>
                <select id="studentGender" name="stuGender" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="centerContent perfectCenter">
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Student inserted here
                    $db->preparedInsertStudent("INSERT INTO Student VALUES (?,?,?,?)", $stuID, $stuFName, $stuLName, $stuGender);
                }

                ?>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Add Student</button>
            </div>
        </form>

        <a href="adminStudents.html"><button type="button">Back</button></a>
    </section>
</section>


</body>
</html>