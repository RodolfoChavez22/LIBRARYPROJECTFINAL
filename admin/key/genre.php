<!DOCTYPE html>
<html>
    <head>
        <title>Create Genre</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>

    <?php
        include '../../connect.php';
        session_start();

        if(isset($_REQUEST['submit'])){
            $Genre= filter_var($_REQUEST['genre'],FILTER_SANITIZE_STRING);

            if(empty($Genre)){$errorMsg[0] = 'Genre Type Required';}

            $sql = "SELECT * FROM genre WHERE Genre_type = '$Genre'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) != 0){$errorMsg[0] = 'Genre Already Created';}

            if(empty($errorMsg)){
                $sql = "INSERT INTO genre (Genre_type) VALUES ('$Genre')";
                    
                $result = mysqli_query($con,$sql);
                if($result){header("location: ../books.php");}
                else{die(mysqli_error($con));}
            }
        }
    ?>

        <div class = "display-body">
            <form  action = "genre.php" method="post" class="signup-form">
                <h3 class="display-header">Create Genre</h3>
                <div class = "signup-input">
                    <label class="label-single">Genre Type</label>
                    <?php
                        if(isset($errorMsg[0])){echo "<p style='color:red; font-size:12px; margin-left:15px;'>".$errorMsg[0]."</p>";}
                    ?>
                    <input type="text" placeholder="Type..." class="input-single" name="genre" value="<?php echo isset($_POST['genre']) ? $_POST['genre'] : '' ?>">
                </div>
                <div class = "signup-button">
                    <button type="submit" name ="submit">CREATE GENRE</button>
                </div>
            </form>
        </div>
    </body>
</html>