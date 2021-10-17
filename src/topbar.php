<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <!-- check the current login  status-->
                <?php
                if (isset($_SESSION["usersId"])) {
                    echo "<li><a href='logout.php'>Log out</a></li>";
                } else {
                    echo "<li><a href='login.php'>Log in</a></li>";
                }
                ?>
                <li><a href="signup.php">Sign up</a></li>
            </ul>
        </div>
    </nav>


    