<?php
    include_once 'topbarout.php';
?>

<?php
    // include_once 'hidephp/dbget.hide.php';
?>
        <div class = "display-container">
            <h1>Art Gallery</h1>
            <form action="/hidephp/search.hide.php" method="POST">
                <input type="text" name="useraccount" placeholder="Type in your keyword...">
                <button type="submit" name="submit">Search</button>
            </form>
        </div>
        
        
<?php
    include_once 'bottonbar.php';
?>