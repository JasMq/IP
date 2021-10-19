<?php
    include_once 'topbarout.php';
?>

<?php
    include_once 'hidephp/dbget.hide.php';
?>
        <div class = "display-container">
            <h1>Art Gallery</h1>
            <form action="display.php" method="POST">
                <input type="text" name="keyword" placeholder="Type in your keyword...">
                <button type="submit" name="submit">Search</button>
            </form>

            <!-- insert each data record -->
            <?php
                // check whether the submit button has been set
                if (isset($_POST['submit'])) {
                
                    $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);

                    $sql = "SELECT creator AS Creater,
                    record_subject AS Subject,
                    record_description AS Description,
                    publisher AS Publisher,
                    record_source AS Source,
                    temporal AS Temporal,
                    record_image AS Image
                    FROM MyRecords
                    WHERE creator LIKE '%$keyword%' 
                    OR record_subject LIKE '%$keyword%'
                    OR record_description LIKE '%$keyword%'
                    OR publisher LIKE '%$keyword%'
                    OR record_source LIKE '%$keyword%'
                    OR temporal LIKE '%$keyword%';";

                    $data = mysqli_query($conn, $sql);


                } else {

                    // get all the data record from the database
                    $sql = "SELECT creator AS Creater,
                    record_subject AS Subject,
                    record_description AS Description,
                    publisher AS Publisher,
                    record_source AS Source,
                    temporal AS Temporal,
                    record_image AS Image
                    FROM MyRecords;";

                    // if it is not set, display all data on the screen
                    $data = mysqli_query($conn, $sql);
                    
                }

               

                
                // if the records found is greater than zero, display each records using a while loop
                if (mysqli_num_rows($data) > 0) {

                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<div class="record-container">';
                        echo '<img class="image" src="'.$row['Image'].'">';
                        echo '<div class="creater"><b>Creater:&nbsp;</b>'.$row['Creater'].'</div>';
                        echo '<div class="subject"><b>Subject:&nbsp;</b>'.$row['Subject'].'</div>';
                        echo '<div class="description"><b>Description:&nbsp;</b>'.$row['Description'].'</div>';
                        echo '<div class="publisher"><b>Publisher:&nbsp;</b>'.$row['Publisher'].'</div>';
                        echo '<div class="source"><b>Source:&nbsp;</b>'.$row['Source'].'</div>';
                        echo '<div class="temporal"><b>Temporal:&nbsp;</b>'.$row['Temporal'].'</div>';
                        echo '</div>';
                    }
                } else {
                    echo "There are no results matching your entered keyword. Try Again!";
                }




            ?>

            
        </div>
        

        
<?php
    include_once 'bottonbar.php';
?>