<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Administrator - Add Class</title>
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
        <h3>Admin - Add Class</h3>
    </section>
</section>
<br>
<section class="centerContent">
    <section class="loginChoiceBox col centerContent perfectCenter">
        <h4>Input Class Details</h4>

        <form>
            <div class="centerContent perfectCenter">
                <label for="classId">Class ID:&nbsp</label>
                <input type="number" id="classId" placeholder="Enter Class ID">
            </div>

            <div class="centerContent perfectCenter">
                <label for="className">Class Name:&nbsp</label>
                <input type="text" id="className" placeholder="Enter Class Name">
            </div>

            <div class="centerContent perfectCenter">
                <label for="classYear">Class Year:&nbsp</label>
                <select id="classYear" name="classYear" onchange="handleClassGrade()">
                    <option>== Select A Year ==</option>
                    <option value="1">Year 1</option>
                    <option value="2">Year 2</option>
                    <option value="3">Year 3</option>
                    <option value="4">Year 4</option>
                    <option value="5">Year 5</option>
                </select>
            </div>

            <div class="centerContent perfectCenter">
                <label for="classGrade">Class Grade:&nbsp</label>
                <select id="classGrade">

                </select>
            </div>

            <div class="centerContent perfectCenter">
                <button type="submit">Add Class</button>
            </div>
        </form>

        <a href="adminClasses.php"><button type="button">Back</button></a>
    </section>
</section>


</body>
</html>