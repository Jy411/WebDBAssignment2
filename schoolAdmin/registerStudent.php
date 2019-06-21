<?php

include_once '../database.inc.php';

$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $stuID = $_POST['stuID'];
    $classID = $_POST['classID'];

    $query = "INSERT INTO StudentClass VALUES (?,?)";
    $db -> preparedInsertStudentClass($query, $stuID, $classID);
//    $db ->query($query);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <script>
        function handleStudentChange() {
            let studentID = document.getElementById('studentList');
            studentID = studentID.options[studentID.selectedIndex].value;
            console.log('Selected StudentID: ' + studentID);
        }
    </script>
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

        <form action="registerStudent.php" method="post">

            <div class="centerContent perfectCenter">
                <label for="studentList">Student:&nbsp</label>
                <select id="studentList" name="stuID" onchange="handleStudentChange()">
                    <?php

                    $rows = $db -> select("SELECT * FROM Student");

                    // For each record in the array
                    foreach ($rows as $key => $value) {
                        $stuID = $value['stuID'];
                        $stuName = $value['stuFName']." ".$value['stuLName'];
                        echo "<option value='$stuID'>ID:$stuID $stuName</option>";
                    }

                    ?>
                </select>
            </div>


            <div class="centerContent perfectCenter">
                <label for="classList">Class:&nbsp</label>
                <select id="classList" name="classID">
                    <?php

                    $rows = $db -> select("SELECT * FROM Class");

                    // For each record in the array
                    foreach ($rows as $key => $value) {
                        $classID = $value['classID'];
                        $className = $value['className'];
                        echo "<option value='$classID'>ID:$classID $className</option>";
                    }

                    ?>
                </select>
            </div>


            <div class="centerContent perfectCenter">
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo "<p style='color: red'>Student registered to class!</p>";
                }

                ?>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Register Student to Class</button>
            </div>

        </form>

        <a href="schoolAdmin.php"><button type="button">Back</button></a>

    </section>
</section>


</body>
</html>