<?php

include_once '../../database.inc.php';
include_once '../../includes.php';

// Create instance of DB
$db = new Db();

// On form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<script>console.log("Successfully retrieved POST values")</script>';

    /*
     * Retrieve values from POST upon clicking submit
     * */
    $subId = $_POST['subId'];
    // Quote and escape string
    $subName = str_replace(array('\'', '"'), '', $_POST['subName']);
    $subType = $_POST['subType'];

    echo $subId.'<br>';
    echo $subName.'<br>';
    echo $subType.'<br>';

    // Query DB to check if there are duplicate subject names
    $checkResult = $db -> select("SELECT * FROM Subject WHERE subName='$subName'");
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
        <h2>Admin - Add Subject</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h3>Input Subject Details</h3>

        <form action="addSubject.php" method="post">
            <div class="centerContent perfectCenter">
                <label for="subjectId">Subject ID:&nbsp</label>
                <input type="number" id="subjectId" name="subId" placeholder="Enter Subject ID" required>
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectName">Subject Name:&nbsp</label>
                <input type="text" id="subjectName" name="subName" placeholder="Enter Subject Name" required>
            </div>

            <div class="centerContent perfectCenter">
                <label for="subjectType">Subject Type:&nbsp</label>
                <select id="subjectType" name="subType" required>
                    <option value="C">Core</option>
                    <option value="S">Selective</option>
                </select>
            </div>

            <div class="col centerContent perfectCenter">
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // checks if results more than 0
                    if (count($checkResult) > 0) {
                        // there is a duplicate
                        echo '<script>console.log("Already exists")</script>';
                        echo "<p style='color: red'>Error inserting Subject ID: $subId Subject Name: $subName!<br>ID or Name already exists!</p>";
                    } else {
                        // no duplicate
                        $db->preparedInsertSubject("INSERT INTO Subject VALUES (?,?,?)", $subId, $subName, $subType);
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