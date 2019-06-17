<?php

include_once '../../database.inc.php';
include_once '../../includes.php';

// On form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<script>console.log("Successfully retrieved POST values")</script>';

    $subId = $conn -> real_escape_string($_POST['subId']);
    $subName = $conn -> real_escape_string($_POST['subName']);
    $subType = $_POST['subType'];

    echo $subId.'<br>';
    echo $subName.'<br>';
    echo $subType.'<br>';

    $result = checkForDuplicate($conn, $subName);

}

?>

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

        <form action="addSubject.php" method="post">
            <div class="centerContent perfectCenter">
                <label for="subjectId">Subject ID:&nbsp</label>
                <input type="number" id="subjectId" name="subId" placeholder="Enter Subject ID">
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectName">Subject Name:&nbsp</label>
                <input type="text" id="subjectName" name="subName" placeholder="Enter Subject Name">
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectType">Subject Type:&nbsp</label>
                <select id="subjectType" name="subType">
                    <option>== Select A Value ==</option>
                    <option value="C">Core</option>
                    <option value="S">Selective</option>
                </select>
            </div>

            <div class="col centerContent perfectCenter">

                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // checks if results more than 0
                    if ($result->num_rows > 0) {
                        // there is a duplicate
                        echo '<script>console.log("Already exists")</script>';
                        echo "<p style='color: red'>Error inserting Subject ID: $subId Subject Name: $subName!<br>ID or Name already exists!</p>";
                    } else {
                        // no duplicate
                        $stmt = $conn -> prepare("INSERT INTO Subject VALUES (?,?,?)");
                        insertSubject($subId, $subName, $subType);
                        $conn -> close();
                        echo '<script>console.log("DB Connection Closed")</script>';
                    }
                }

                ?>

            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Add Subject</button>
            </div>
        </form>

        <a href="adminSubjects.html"><button type="button">Back</button></a>
    </section>
</section>

<?php




?>

</body>
</html>