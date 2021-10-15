<?php
    include_once 'topbar.php';
?>

     <!-- sign up form  -->
    <h1 class="signup-heading">Sign up </h1>
    <div class="signup-form">
        <form action="/hidephp/signup.hide.php" method="POST">
            <input type="text" name="username" placeholder="Please set up the user name">
            <input type="text" name="email" placeholder="Please set up the email">
            <input type="text" name="password" placeholder="Please set up the password">
            <input type="text" name="passwordrp" placeholder="Please enter the password again">
            <button type="submit" name="submit">Sign Up</button>
        
        </form>

    </div>

<?php
    include_once 'bottonbar.php';
?>