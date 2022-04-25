<!DOCTYPE html>
<html>
    <head>
        <title>Create Author</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>

    <?php
        include '../../connect.php';
        session_start();

        if(isset($_REQUEST['submit'])){
            $Fname= filter_var($_REQUEST['fname'],FILTER_SANITIZE_STRING);
            $Lname= filter_var($_REQUEST['lname'],FILTER_SANITIZE_STRING);

            if(empty($Fname)){$errorMsg[0] = 'First Name Required';}
            if(empty($Lname)){$errorMsg[1] = 'Last Name Required';}

            $sql = "SELECT * FROM author WHERE  Fname = '$Fname' AND LName = '$Lname'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) != 0){$errorMsg[0] = 'Author Already Created';}


            if(empty($errorMsg)){
                $sql = "INSERT INTO author (FName,LName) VALUES ('$Fname','$Lname')";
                    
                $result = mysqli_query($con,$sql);
                if($result){header("location: ../books.php");}
                else{die(mysqli_error($con));}
            }
        }
    ?>

        <div class = "display-body">
            <form  action = "author.php" method="post" class="signup-form">
                <h3 class="display-header">Create Author</h3>
                <div class = "signup-input">
                    <label class="label-single">First Name</label>
                    <?php
                        if(isset($errorMsg[0])){echo "<p style='color:red; font-size:12px; margin-left:15px;'>".$errorMsg[0]."</p>";}
                    ?>
                    <input type="text" placeholder="First name..." class="input-single" name="fname" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
                    <label class="label-single">Last Name</label>
                    <?php
                        if(isset($errorMsg[1])){echo "<p style='color:red; font-size:12px; margin-left:15px;'>".$errorMsg[1]."</p>";}
                    ?>
                    <input type="text" placeholder="Last name..." class="input-single" name="lname" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
                </div>
                <div class = "signup-button">
                    <button type="submit" name ="submit">CREATE AUTHOR</button>
                </div>
            </form>
        </div>
    </body>
</html>