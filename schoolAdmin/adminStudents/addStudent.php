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
        <h3>Admin - Add Student</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Input Student Details</h4>

        <form>
            <div class="centerContent perfectCenter">
                <label for="subjectId">Student ID:&nbsp</label>
                <input type="number" id="studentId" placeholder="Enter Student ID">
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectName">Student Name:&nbsp</label>
                <input type="text" id="studentFName" placeholder="Enter Student Name">
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectName">Student Last Name:&nbsp</label>
                <input type="text" id="studentLName" placeholder="Enter Student Last Name">
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectType">Student Gender:&nbsp</label>
                <select id="studentGender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Add Student</button>
            </div>
        </form>

        <a href="adminStudents.php"><button type="button">Back</button></a>
    </section>
</section>

<?php




?>

</body>
</html>