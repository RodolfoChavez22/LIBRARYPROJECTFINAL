<!DOCTYPE html>
<html>
    <head>
        <title>Create Publisher</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>

    <?php
        include '../../connect.php';
        session_start();

        if(isset($_REQUEST['submit'])){
            $Publisher= filter_var($_REQUEST['publisher'],FILTER_SANITIZE_STRING);

            if(empty($Publisher)){$errorMsg[0] = 'Publisher Name Required';}

            $sql = "SELECT * FROM publisher WHERE Publisher_name = '$Publisher'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) != 0){$errorMsg[0] = 'Publisher Already Created';}

            if(empty($errorMsg)){
                $sql = "INSERT INTO publisher (Publisher_name) VALUES ('$Publisher')";
                    
                $result = mysqli_query($con,$sql);
                if($result){header("location: ../books.php");}
                else{die(mysqli_error($con));}
            }
        }
    ?>

        <div class = "display-body">
            <form  action = "publisher.php" method="post" class="signup-form">
                <h3 class="display-header">Create Publisher</h3>
                <div class = "signup-input">
                    <label class="label-single">Publisher Name</label>
                    <?php
                        if(isset($errorMsg[0])){echo "<p style='color:red; font-size:12px; margin-left:15px;'>".$errorMsg[0]."</p>";}
                    ?>
                    <input type="text" placeholder="Type..." class="input-single" name="publisher" value="<?php echo isset($_POST['publisher']) ? $_POST['publisher'] : '' ?>">
                </div>
                <div class = "signup-button">
                    <button type="submit" name ="submit">CREATE PUBLISHER</button>
                </div>
            </form>
        </div>
    </body>
</html>