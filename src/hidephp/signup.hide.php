<?php
    // coonnect to the database
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







if (isset($_POST["submit"])) {
    echo "The sign up page works";

    // require the prewritten functions store in this file
    require_once 'function.hide.php';

    // get the input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwdrp = $_POST["passwordrp"];


    // detecting any empty input
    if (emptyInputDection($username, $email, $pwd, $pwdrp) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    // *************************** Sign Up Page Functions *********************************
    // detecting the invalid username
    if (invalidUsername($username) !== false) {
        header("location: ../signup.php?error=invaliduname");
        exit();
    }

    // detecting the invalid email
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }


    // detecting whether the password entered for 
    // the two time matching to each other
    if (pwdNotMatch($pwd, $pwdrp) !== false) {
        header("location: ../signup.php?error=passwordisnotmatching");
        exit();
    }

    // check whether the sign up username is already in the database
    if (userNameExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernameistaken");
        exit();
    }

    // if all conditions met, create that user in our database system
    createEachUser($conn, $username, $email, $pwd);

}
else {
    // if something went wrong, back to the signup.php
    header("location: ../signup.php");
    exit();
}
?>