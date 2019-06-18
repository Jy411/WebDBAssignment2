<?php

include_once '../../database.inc.php';

$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $removeStuID = $_POST['stuID'];

    $query = "DELETE FROM Student WHERE stuID=$removeStuID";
    $db ->query($query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Remove Student</title>
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
        <h2>Admin - Remove Student</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h3>Select A Student To Remove.</h3>

        <form action="removeStudent.php" method="post">

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
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo "<p style='color: red'>Student Removed!</p>";
                }

                ?>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Remove Student</button>
            </div>

        </form>



        <a href="adminStudents.html"><button type="button">Back</button></a>
    </section>
</section>

<?php




?>

</body>
</html>