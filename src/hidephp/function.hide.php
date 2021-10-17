<?php

// detail implementation of emptyInputDetection function
function emptyInputDetection($username, $email, $pwd, $pwdrp) {
    // declare the returned result
    $result;
    // if user not enter any input
    if (empty($username) || empty($email) || empty($pwd) || empty($pwdrp)) {
        // initialize the result to true
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


function invalidUsername($username) {
    // declare the returned result
    $result;

    // check whether the user name entered match our expected input character
    if (!preg_match ('/[a-zA-Z0-9 ]/', $username)) {
        $result = true;
        
    }
    else {
        $result = false;
    }
    return $result;
}



function invalidEmail($email) {
    // declare the returned result
    $result;

    // check whether the mail is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
        
    }
    else {
        $result = false;
    }
    return $result;
}



function pwdNotMatch($pwd, $pwdrp) {
    // declare the returned result
    $result;

    // check whether the password is matching
    if ($pwd !== $pwdrp) {
        $result = true;
        
    }
    else {
        $result = false;
    }
    return $result;
}


function userNameExists($conn, $username, $email) {

    // prepare the MYSQL statement
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?";
    $stmt = mysqli_stmt_init($conn);


    // use prepared statement to check in the database, avoiding destroying the database
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=runningstmtfailed");
        exit();
    }


    // bind user's input with the stmt
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);

    mysqli_stmt_execute($stmt);
    
    // getting the result data from the database 
    $dataResult = mysqli_stmt_get_result($stmt);

    // check whether the result can be found
    if ($row = mysqli_fetch_assoc($dataResult)) {
        return $row;
    } 
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);

}



function createEachUser($conn, $username, $email, $pwd) {

    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES (?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);

    // if cannot create user correctly, invalid creation header lead to a prompting message 
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $pwd);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();

}


// detail implementation of empty login input function
function emptyLoginInput($useraccount, $pwd) {
    // declare the returned result
    $result;
    // if user not enter any input
    if (empty($useraccount) || empty($pwd)) {
        // initialize the result to true
        $result = true;
       
    }
    else {
        $result = false;
    }
    return $result;
}


function userLogin($conn, $useraccount, $pwd) {
    // check whether that user with given input exist in the database
    // since the passed in vaue can be either user name or user email.
    $userFound = userNameExists($conn, $useraccount, $useraccount);

    // invalid login header lead to a prompting message
    if ($userFound === false) {
        
        header("location: ../login.php?error=loginFailed");
        exit();
    } 
    // if the login is sucessful, go directely to the homepage.html
    header("location: ../homepage.html");
    exit();
}