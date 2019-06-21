<?php

include_once '../../database.inc.php';

$db = new Db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets value of selected option of dropdown menu
    $removeClassId = $_POST['classList'];

    $query = "DELETE FROM Class WHERE classID=$removeClassId";
    $db ->query($query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Remove Class</title>
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
        <h3>Admin - Remove Class</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Select A Class To Remove.</h4>

        <form action="removeClass.php" method="post">

            <div class="centerContent perfectCenter">
                <label for="classList">Class:&nbsp</label>
                <select id="classList" name="classList">
                    <?php

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
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo "<p style='color: red'>Class Deleted!</p>";
                }

                ?>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Remove Class</button>
            </div>

        </form>


        <a href="adminClasses.html"><button type="button">Back</button></a>
    </section>
</section>

<?php




?>

</body>
</html>