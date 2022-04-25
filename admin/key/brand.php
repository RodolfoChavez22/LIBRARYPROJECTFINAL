<!DOCTYPE html>
<html>
    <head>
        <title>Create Brand</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>

    <?php
        include '../../connect.php';
        session_start();

        if(isset($_REQUEST['submit'])){
            $Brand = filter_var($_REQUEST['brand'],FILTER_SANITIZE_STRING);

            if(empty($Brand)){$errorMsg[0] = 'Brand Required';}

            $sql = "SELECT * FROM brand WHERE Brand_name = '$Brand'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) != 0){$errorMsg[0] = 'Brand Already Created';}

            if(empty($errorMsg)){
                $sql = "INSERT INTO brand (Brand_name) VALUES ('$Brand')";
                    
                $result = mysqli_query($con,$sql);
                if($result){header("location: ../electronics.php");}
                else{die(mysqli_error($con));}
            }
        }
    ?>

        <div class = "display-body">
            <form  action = "brand.php" method="post" class="signup-form">
                <h3 class="display-header">Create Brand</h3>
                <div class = "signup-input">
                    <label class="label-single">Brand</label>
                    <?php
                        if(isset($errorMsg[0])){echo "<p style='color:red; font-size:12px; margin-left:15px;'>".$errorMsg[0]."</p>";}
                    ?>
                    <input brand="text" placeholder="Brand..." class="input-single" name="brand" value="<?php echo isset($_POST['brand']) ? $_POST['brand'] : '' ?>">
                </div>
                <div class = "signup-button">
                    <button brand="submit" name ="submit">CREATE BRAND</button>
                </div>
            </form>
        </div>
    </body>
</html>