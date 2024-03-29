<?php

include_once '../../database.inc.php';

$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $removeSubId = $_POST['subjectList'];

    $query = "DELETE FROM Subject WHERE subID=$removeSubId";
    $db ->query($query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Remove Subject</title>
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
        <h2>Admin - Remove Subject</h2>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h3>Select A Subject To Remove.</h3>

        <form action="removeSubject.php" method="post">

            <div class="centerContent perfectCenter">
                <label for="subjectList">Subject:&nbsp</label>
                <select id="subjectList" name="subjectList" onchange="handleSubjectChange()">
                    <?php

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
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo "<p style='color: red'>Subject Deleted!</p>";
                }

                ?>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Remove Subject</button>
            </div>

        </form>


        <a href="adminSubjects.html"><button type="button">Back</button></a>

    </section>
</section>

</body>
</html>