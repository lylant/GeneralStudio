<?php
    // Prevent caching
    header("Cache-Control: no-cache");
    header("Expires: -1");

    // Set headers for exporting csv file
    header("Content-Type: text/csv; charset=utf-8");  
    header("Content-Disposition: attachment; filename=exported_data.csv");  

    // Retrieve database credentials
    require_once("res/config/db_config.php");

    // Connect to DBMS, using MySQLi
    $dbConn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if($dbConn->connect_error) {
        die("Failed to connect to database " . $dbConn->connect_error);
    }


    $output = fopen("php://output", "w");  

    fputcsv($output, array("name", "level", "price", "institution"));

    $querySelect = ("SELECT name
        , level
        , price
        , institution
        FROM courses;");

    $querySelectResult = $dbConn -> query($querySelect)
        or die("Problem with query: SELECT | " . $dbConn->error);
    
    while($row = $querySelectResult -> fetch_assoc()) {
        fputcsv($output, $row);
    }
    
    fclose($output);


    /*
    while($row = mysqli_fetch_assoc($result))  
    {  
         fputcsv($output, $row);  
    }  
    fclose($output);  


    while($row = $queryresult->fetch_assoc()) {
        echo $row["name"];
    }
    */

?>