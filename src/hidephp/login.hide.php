<?php

// coonnect to the database
$servername = "mysql";
$username = "php";
$password = "php";
$dbname = "cloud_computing";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (isset($_POST["submit"])) {
    

    // require the prewritten functions store in this file
    require_once 'function.hide.php';

    // get the data user entered into the log in form
    $useraccount = $_POST["useraccount"];
    $pwd = $_POST["password"];


    // check whethet any blank are left empty
    if (emptyLoginInput($useraccount, $pwd) !== false) {
        header("location: ../login.php?error=emptyInputFound");
        exit();
    }


    if (userLogin($conn, $useraccount, $pwd)  !== false) {
        header("location: ../signup.php?error=invalidlogininfo");
        exit();
    }

}


