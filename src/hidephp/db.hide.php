<?php

    $servername = "mysql";
    $username = "php";
    $password = "php";
    $dbname = "cloud_computing";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // echo "SQL connected successfully! <br>";
    // echo "Server Info: ". mysqli_get_server_info($conn);


    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS MyRecords (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    creator VARCHAR(255) NOT NULL,
    record_subject VARCHAR(255) NOT NULL,
    record_description TEXT NOT NULL,
    publisher VARCHAR(255) NOT NULL,
    record_source VARCHAR(255) NOT NULL,
    record_spatial VARCHAR(255) NOT NULL,
    temporal VARCHAR(255) NOT NULL,
    record_image VARCHAR(255) NOT NULL
    )";
    
    if (mysqli_query($conn, $sql)) {
    //   echo "Table MyRecords created successfully";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
    
    

    // use prepare statement for insert query
    $st = mysqli_prepare($conn, "INSERT INTO MyRecords VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // bind variables to insert query params
    mysqli_stmt_bind_param($st, 'issssssss', $id, $creator, $subject, $description, $publisher, $source, $spatial, $temporal, $image);


    //read the json file contents
    $jsondata = file_get_contents('records.json');
    
    // echo "get json data successfully";


    $jsondata = preg_replace( '/[^[:print:]]/', '',$jsondata);

    //convert json object to php associative array
    $data = json_decode($jsondata, true);

    // check if $data is indeed an array or an object
    if (is_array($data) || is_object($data)) {

        // looping through each record and insert it into the table
        foreach ($data as $row)
        {
            
            
            $id = $row['_id'];
            $creator = $row['dc:creator'];
            $subject = $row['dc:subject'];
            $description = $row['dc:description'];
            $publisher = $row['dc:publisher'];
            $source = $row['dc:source'];
            $spatial = $row['dcterms:spatial'];
            $temporal = $row['dcterms:temporal'];
            $image = $row['1000_pixel_jpg'];


            // execute insert query
            mysqli_stmt_execute($st);
        
        }

    } else {
        echo "Unfortunately, an error occured.";
    }



    // sql to create user table
    $sql = "CREATE TABLE IF NOT EXISTS users (
    usersId INT(11)  PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersName VARCHAR(255) NOT NULL,
    usersEmail VARCHAR(255) NOT NULL,
    usersPwd VARCHAR(255) NOT NULL
    )";
        
    if (mysqli_query($conn, $sql)) {
       
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }


    
    // close the connection
    mysqli_close($conn);
    
?>