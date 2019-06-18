<?php

class Db {
    /*
     * Connection to DB is static so that
     * it only needs to connect once
     */
    protected static $connection;

    /**
     * Connect to the DB
     * @return mysqli object instance on success / bool false on failure
     * */
    public function connect() {
        $server = "localhost";
        $user = "root";
        $password = "root";
        $myDB = "classDB";

        // Try to connect to DB
        if (!isset(self::$connection)) {
            // Creates a DB connection object
            self::$connection = new mysqli ($server, $user, $password, $myDB);
            echo '<script>console.log("Successfully Connected to DB")</script>';
        }

        // If connection fails
        if (self::$connection === false) {
            // Handle error
            return false;
        }
        return self::$connection;
    }

    /**
     * Queries the DB
     *
     * @param $query string The query string
     * @return mixed The result of mysqli::query() function
     * */
    public function query($query) {
        // Connect to DB
        $connection = $this -> connect();

        // Query the DB
        $result = $connection -> query($query);
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query string The query string
     * @return array Database rows on success / bool False on failure
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        echo '<script>console.log("Successful query")</script>';
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function preparedInsertStudent($query, $stuID, $stuFName, $stuLName, $stuGender) {
        global $stmt;
        $connection = $this -> connect();
        $stmt = $connection -> prepare($query);

        if (
            $stmt &&
            // Bind params to placeholder values
            $stmt -> bind_param('isss', $stuID, $stuFName, $stuLName, $stuGender) &&
            $stmt -> execute()
        ) {
            // insert success
            echo '<script>console.log("New student successfully inserted.")</script>';
            echo "<p style='color: red'>ID: $stuID Name: $stuFName $stuLName Type: $stuGender successfully inserted!</p>";
        }  else {
            echo '<script>console.log("Unsuccessful insert")</script>';
            echo "<p style='color: red'>Insertion Error! ID is not unique.</p>";
        }
    }

    public function preparedModifyStudent($query, $stuID, $stuFName, $stuLName, $stuGender) {
        global $stmt;
        // Connects to DB first
        $connection = $this -> connect();

        // Prepares the query
        $stmt = $connection -> prepare($query);

        if ($stmt &&
            $stmt -> bind_param('sssi', $stuFName, $stuLName, $stuGender, $stuID) &&
            $stmt -> execute() &&
            $stmt -> affected_rows === 1
        ) {
            echo '<script>console.log("Successfully Modified Student!")</script>';
            echo "<p style='color: red'>Student Modified!</p>";
        } else {
            echo '<script>console.log("Failed to modify student :(")</script>';
            echo "<p style='color: red'>Student not Modified!</p>";
        }
    }

    /**
     * Insert subject in to the Subject table with prepared statements (INSERT query)
     *
     * @param $query string Insert Query eg. [INSERT INTO Subject VALUES (?,?,?)]*
     */
    public function preparedInsertSubject($query, $subID, $subName, $subType) {
        global $stmt;
        // Connects to DB first
        $connection = $this -> connect();

        // Prepares the query
        $stmt = $connection -> prepare($query);

        if (
            $stmt &&
            // Bind params to placeholder values
            $stmt -> bind_param('iss', $subID, $subName,$subType) &&
            $stmt -> execute()
        ) {
            // insert success
            echo '<script>console.log("New subject successfully inserted")</script>';
            echo "<p style='color: red'>ID: $subID Name: $subName Type: $subType successfully inserted!</p>";
        }  else {
            echo '<script>console.log("Unsuccessful insert")</script>';
            echo "<p style='color: red'>Insertion Error! ID or Name already taken!</p>";
        }
    }

    public function preparedModifySubject($query, $subID, $subName, $subType) {
        global $stmt;
        // Connects to DB first
        $connection = $this -> connect();

        // Prepares the query
        $stmt = $connection -> prepare($query);

        if ($stmt &&
            $stmt -> bind_param('ssi', $subName, $subType, $subID) &&
            $stmt -> execute() &&
            $stmt -> affected_rows === 1
        ) {
            echo '<script>console.log("Successfully Modified!")</script>';
            echo "<p style='color: red'>Subject Modified!</p>";
        } else {
            echo '<script>console.log("Failed to modify.")</script>';
            echo "<p style='color: red'>Subject not Modified!</p>";
        }
    }

    /**
     * Fetch the last error from the database
     *
     * @return string Database error message
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }



}