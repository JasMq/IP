<?php
    include_once 'topbar.php';
?>

     <!-- sign up form  -->
    <h1 class="login-heading">Log In</h1>
    <div class="login-form">
        <form action="/hidephp/login.hide.php" method="POST">
            <input type="text" name="useraccount" placeholder="Please enter the user name/email">
            <input type="text" name="password" placeholder="Please enter your password">
            <button type="submit" name="submit">Log In</button>
        </form>

        <?php
            if (isset($_GET["error"])) {

                if ($_GET["error"] == "emptyInputFound") {
                    echo "<p>You left some place blank!</p>";
                }
                else if ($_GET["error"] == "invalidlogininfo") {
                    echo "<p>The name entered is invalid</p>";
                } 
            }
        ?>

    </div>

    
<?php
    include_once 'bottonbar.php';
?>