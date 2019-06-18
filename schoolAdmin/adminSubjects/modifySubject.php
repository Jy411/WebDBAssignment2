<?php

include_once '../../database.inc.php';
include_once '../../includes.php';

$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $modSubId = $_POST['subjectList'];
    $newSubName = $_POST['subName'];
    $newSubType = $_POST['subType'];

    // Query DB to check if there are duplicate subject names
    $checkResult = $db -> select("SELECT * FROM Subject WHERE subName='$newSubName'");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Modify Subject</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../../style.css" rel="stylesheet">

    <script>
        function handleSubjectChange() {
            let subjectValue = document.getElementById('subjectList');
            subjectValue = subjectValue.options[subjectValue.selectedIndex].value;
            console.log('Selected SubjectID: ' + subjectValue);
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
        <h2>Admin - Modify Subject</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h3>Select A Subject To Modify.</h3>

        <form action="modifySubject.php" method="post">

            <div class="centerContent perfectCenter">
                <label for="subjectList">Subject:&nbsp</label>
                <select id="subjectList" name="subjectList" onchange="handleSubjectChange()" required>
                    <?php
                    /**
                     * Populate the dropdown options with records from Subject
                     */
                    $rows = $db -> select("SELECT * FROM Subject");

                    // For each record in the array
                    foreach ($rows as $key => $value) {
                        $subId = $value['subID'];
                        $subName = $value['subName'];
                        echo "<option value='$subId'>$subName</option>";
                    }
                    ?>
                </select>
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

            <div class="centerContent perfectCenter">
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (count($checkResult) > 0) {
                        // there is a duplicate
                        echo '<script>console.log("Already exists")</script>';
                        echo "<p style='color: red'>Error modifying Subject ID: $modSubId Subject Name: $newSubName!<br>ID or Name already exists!</p>";
                    } else {
                        // no duplicate
                        $query = "UPDATE Subject SET subName=?, subType=? WHERE subID=?";
                        $db -> preparedModifySubject($query, $modSubId, $newSubName, $newSubType);
                    }
                }



                ?>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Modify Subject</button>
            </div>

        </form>

        <a href="adminSubjects.html"><button type="button">Back</button></a>

    </section>
</section>

<?php




?>

</body>
</html>