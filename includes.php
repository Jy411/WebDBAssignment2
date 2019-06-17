<?php

/* Get all records from Subject table
 * @returns object containing all records
 * */
function getAllSubjects(mysqli $dbConn) {
    $query = "SELECT * FROM Subject";
    echo '<script>console.log("Fetching Data...")</script>';
    $result = $dbConn->query($query);
//    $dbConn->close();
//    echo '<script>console.log("DB Connection Closed")</script>';
    return $result;
}

/* Gets all SubjectID and Subject Names
 * @returns object containing all records
 * */
function checkForDuplicate(mysqli $dbConn, $subName) {
//    $query = "SELECT * FROM `Subject` WHERE (subID=$subId OR subName='English') LIMIT 1";
    $query = "SELECT * FROM Subject WHERE subName='$subName' LIMIT 1";
//    $query = "SELECT * FROM Subject WHERE subID=$subId LIMIT 1";
    $result = $dbConn->query($query);
    return $result;
}

/* Add a subject to Subject table with prepared statements
 * Parameters are SubjectID, SubjectName, and SubjectType
 * */
function insertSubject($subId, $subName, $subType) {
    global $stmt;
    if ($stmt &&
        $stmt -> bind_param('iss', $subId, $subName, $subType) &&
        $stmt -> execute()
    ) {
        // insert success
        echo '<script>console.log("Successfully inserted")</script>';
        echo "<p style='color: red'>ID: $subId Name: $subName Type: $subType successfully inserted!</p>";
    } else {
        echo '<script>console.log("Unsuccessful insert")</script>';
        echo "<p style='color: red'>Insertion Error!</p>";
//        echo $stmt -> error;
    }
}

/* Delete subject
 * Takes in database connection and id of subject to be removed
 * */
function deleteSubject(mysqli $dbConn, $removeSubId) {
    $query = "DELETE FROM Subject WHERE subID=$removeSubId";
    $dbConn -> query($query);
}

function modifySubject($subId, $subName, $subType) {
    global $stmt;
    if ($stmt &&
        $stmt -> bind_param('ssi', $subName, $subType, $subId) &&
        $stmt -> execute() &&
        $stmt -> affected_rows === 1
    ) {
        echo 'Updated';
    } else {
        echo 'Not Updated';
    }
}