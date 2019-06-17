<?php

include_once '../../database.inc.php';
include_once '../../includes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $modSubId = $_POST['subjectList'];
    $newSubName = $_POST['subName'];
    $newSubType = $_POST['subType'];

    echo $modSubId;
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
        <h3>Admin - Modify Subject</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Select A Subject To Modify.</h4>

        <form action="modifySubject.php" method="post">

            <div class="centerContent perfectCenter">
                <label for="subjectList">Subject:&nbsp</label>
                <select id="subjectList" name="subjectList" onchange="handleSubjectChange()">
                    <?php

                    $result = getAllSubjects($conn);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $subId = $row['subID'];
                            $subName = $row['subName'];
                            echo "<option value='$subId'>$subName</option>";
                        }
                    }

                    ?>
                </select>
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

            <div class="centerContent perfectCenter">
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if ($subName){
                        $query = "UPDATE Subject SET subName=?, subType=? WHERE subID=?";
                        $stmt = $conn -> prepare($query);
                        modifySubject($modSubId, $newSubName, $newSubType);
                    } else {
                        echo "<p style='color: red'>No subject name!</p>";
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