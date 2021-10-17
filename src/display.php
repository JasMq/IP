<?php
    include_once 'topbarout.php';
?>

<?php
    include_once 'hidephp/dbget.hide.php';
?>
        <div class = "display-container">
            <h1>Art Gallery</h1>
            <form action="/hidephp/search.hide.php" method="POST">
                <input type="text" name="useraccount" placeholder="Type in your keyword...">
                <button type="submit" name="submit">Search</button>
            </form>

            // test used
            <!-- <div class = "record-container">
                <div class="creater"></div>
                <div class="subject"></div>
                <div class="description"></div>
                <div class="publisher"></div>
                <div class="source"></div>
                <div class="temporal"></div>
                <img class="image">
            </div> -->

            <!-- insert each data record -->
            <?php
                // get all the data record from the database
                $sql = "SELECT creator AS Creater,
                 record_subject AS Subject,
                 record_description AS Descriptioon,
                 publisher AS Publisher,
                 record_source AS Source,
                 temporal AS Temporal,
                 record_image AS Image
                 FROM MyRecords;";
                $data = mysqli_query($conn, $sql);

                if (mysqli_num_rows($data) > 0) {

                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<div class="record-container">';
                        echo '<img class="image" src="'.$row['Image'].'">';
                        echo '<div class="creater">Creater:'.$row['Creater'].'</div>';
                        echo '<div class="subject">Subject:'.$row['Subject'].'</div>';
                        echo '<div class="description">Description:'.$row['Descriptioon'].'</div>';
                        echo '<div class="publisher">Publisher:'.$row['Publisher'].'</div>';
                        echo '<div class="source">Source:'.$row['Source'].'</div>';
                        echo '<div class="temporal">Temporal:'.$row['Temporal'].'</div>';
                        echo '</div>';
                    }
                }


            ?>
        </div>
        

        
<?php
    include_once 'bottonbar.php';
?>