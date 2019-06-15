<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Add Subject</title>
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
        <h3>Admin - Add Subject</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Input Subject Details</h4>

        <form>
            <div class="centerContent perfectCenter">
                <label for="subjectId">Subject ID:&nbsp</label>
                <input type="number" id="subjectId" placeholder="Enter Subject ID">
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectName">Subject Name:&nbsp</label>
                <input type="text" id="subjectName" placeholder="Enter Subject Name">
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectType">Subject Type:&nbsp</label>
                <select id="subjectType">
                    <option value="C">Core</option>
                    <option value="S">Selective</option>
                </select>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Add Subject</button>
            </div>
        </form>

        <a href="adminSubjects.php"><button type="button">Back</button></a>
    </section>
</section>

<?php




?>

</body>
</html>