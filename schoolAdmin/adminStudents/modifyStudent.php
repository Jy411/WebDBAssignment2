<?php

include_once '../../database.inc.php';

$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $modStuID = $_POST['stuID'];
    // Sanitize user input
    $newStuFName = str_replace(array('\'', '"'), '', $_POST['stuFName']);
    $newStuLName = str_replace(array('\'', '"'), '', $_POST['stuLName']);
    $newStuGender = $_POST['stuGender'];


    echo $modStuID;
    echo '<br>';
    echo $newStuFName;
    echo '<br>';
    echo $newStuLName;
    echo '<br>';
    echo $newStuGender;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Modify Student</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../../style.css" rel="stylesheet">

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
    <img src="../../images/MIT_Logo.svg" height="100px" width=auto alt="MIT Logo" />
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox centerContent perfectCenter">
        <h2>Admin - Modify Student</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h3>Select A Student To Modify.</h3>

        <form action="modifyStudent.php" method="post">

            <div class="centerContent perfectCenter">
                <label for="studentList">Student:&nbsp</label>
                <select id="studentList" name="stuID" onchange="handleStudentChange()">
                    <?php

                    // TODO Dropdown List does not get updated upon form submission

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
                    $query = "UPDATE Student SET stuFName=?, stuLName=?, stuGender=? WHERE stuID=?";
                    $db -> preparedModifyStudent($query, $modStuID, $newStuFName, $newStuLName, $newStuGender);
                }

                ?>
            </div>


            <div class="centerContent perfectCenter">
                <button type="submit">Modify Student</button>
            </div>


        </form>

        <a href="adminStudents.html"><button type="button">Back</button></a>
    </section>
</section>
</body>
</html>