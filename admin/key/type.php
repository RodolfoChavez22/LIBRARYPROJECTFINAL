<!DOCTYPE html>
<html>
    <head>
        <title>Create Type</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>

    <?php
        include '../../connect.php';
        session_start();

        if(isset($_REQUEST['submit'])){
            $Type = filter_var($_REQUEST['type'],FILTER_SANITIZE_STRING);

            if(empty($Type)){$errorMsg[0] = 'Electronic Type Required';}

            $sql = "SELECT * FROM etype WHERE Electronic_type = '$Type'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) != 0){$errorMsg[0] = 'Electronic Type Created';}

            if(empty($errorMsg)){
                $sql = "INSERT INTO etype (Electronic_type) VALUES ('$Type')";
                    
                $result = mysqli_query($con,$sql);
                if($result){header("location: ../electronics.php");}
                else{die(mysqli_error($con));}
            }
        }
    ?>

        <div class = "display-body">
            <form  action = "type.php" method="post" class="signup-form">
                <h3 class="display-header">Create Type</h3>
                <div class = "signup-input">
                    <label class="label-single">Electronic Type</label>
                    <?php
                        if(isset($errorMsg[0])){echo "<p style='color:red; font-size:12px; margin-left:15px;'>".$errorMsg[0]."</p>";}
                    ?>
                    <input type="text" placeholder="Type..." class="input-single" name="type" value="<?php echo isset($_POST['type']) ? $_POST['type'] : '' ?>">
                </div>
                <div class = "signup-button">
                    <button type="submit" name ="submit">CREATE TYPE</button>
                </div>
            </form>
        </div>
    </body>
</html>