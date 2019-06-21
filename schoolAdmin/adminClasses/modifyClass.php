<?php

include_once '../../database.inc.php';

$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $modClassId = $_POST['classList'];
    $newClassName = $_POST['className'];
    $newClassYear = $_POST['classYear'];
    $newClassGrade = $_POST['classGrade'];

    // Query DB to check if there are duplicate Class names
    $checkResult = $db -> select("SELECT * FROM Class WHERE className='$newClassName'");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Modify Class</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="../../style.css" rel="stylesheet">
    <script>
        function handleClassGrade() {
            let classYearValue = document.getElementById('classYear');
            // get value (1,2,3,4,5) of selected year
            classYearValue = classYearValue.options[classYearValue.selectedIndex].value;
            console.log('Class Year: ' + classYearValue);

            let classGradeDropDown = document.getElementById('classGrade');
            // if year 1, 2 or 3 selected
            if (classYearValue === '1' || classYearValue === '2' || classYearValue === '3'){
                // removes everything and adds the option in
                classGradeDropDown.options.length = 0;
                let option = document.createElement("option");
                option.text = "Lower Secondary";
                option.id = "LS";
                option.value = '1';
                classGradeDropDown.add(option);
                console.log(option);
            } else {
                // removes everything and adds the options in
                classGradeDropDown.options.length = 0;
                let option = document.createElement("option");
                option.text = "Upper Secondary Art";
                option.id = "USA";
                option.value = '2';
                classGradeDropDown.add(option);
                console.log(option);
                option = document.createElement("option");
                option.text = "Upper Secondary Science";
                option.id = "USS";
                option.value = '3';
                classGradeDropDown.add(option);
                console.log(option);
            }
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
        <h3>Admin - Modify Class</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Select A Class To Modify.</h4>

        <form action="modifyClass.php" method="post">

            <div class="centerContent perfectCenter">
                <label for="classList">Class:&nbsp</label>
                <select id="classList" name="classList">
                    <?php

                    /**
                     * Populate dropdown option with records from class
                     */
                    $rows = $db -> select("SELECT * FROM Class");

                    // For each record in the array
                    foreach ($rows as $key => $value) {
                        $classID = $value['classID'];
                        $className = $value['className'];
                        echo "<option value='$classID'>$className</option>";
                    }

                    ?>
                </select>
            </div>

            <div class="centerContent perfectCenter">
                <label for="className">Class Name:&nbsp</label>
                <input type="text" id="className" name="className" placeholder="Enter Class Name" required>
            </div>

            <div class="centerContent perfectCenter">
                <label for="classYear">Class Year:&nbsp</label>
                <select id="classYear" name="classYear" onchange="handleClassGrade()" required>
                    <option>==Select an option==</option>
                    <option value="1">Year 1</option>
                    <option value="2">Year 2</option>
                    <option value="3">Year 3</option>
                    <option value="4">Year 4</option>
                    <option value="5">Year 5</option>
                </select>
            </div>

            <div class="centerContent perfectCenter">
                <label for="classGrade">Class Grade:&nbsp</label>
                <select id="classGrade" name="classGrade" required>

                </select>
            </div>

            <div class="centerContent perfectCenter">
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (count($checkResult) > 0) {
                        // there is a duplicate
                        echo '<script>console.log("Already exists")</script>';
                        echo "<p style='color: red'>Error modifying Class ID: $modClassId Class Name: $newClassName!<br>ID or Name already exists!</p>";
                    } else {
                        // no duplicate
                        $query = "UPDATE Class SET className=?, classYear=?, classGrade=? WHERE classID=?";
                        $db -> preparedModifyClass($query, $modClassId, $newClassName, $newClassYear, $newClassGrade);
                    }
                }

                ?>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Modify Subject</button>
            </div>

        </form>

        <a href="adminClasses.html"><button type="button">Back</button></a>
    </section>
</section>

<?php




?>

</body>
</html>