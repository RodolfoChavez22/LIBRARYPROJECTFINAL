<!DOCTYPE html>
<html>
    <head>
        <title>Create User</title>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>

    <?php
        include '../../connect.php';
        include_once '../../header.php';
        //Set Timezone for user creation date
        date_default_timezone_set('America/Chicago');
        //Redirect if the user is not a admin
        if($_SESSION['User_Status'] != 'admin'){
            header("Location: ../../homepage");
        }

        //Record User input and Error handles
        if(isset($_REQUEST['submit'])){
            $Fname= $_REQUEST['fname'];
            $Lname= $_REQUEST['lname'];
            $DOB= $_REQUEST['date'];
            $Email= $_REQUEST['email'];
            $Username= $_REQUEST['username'];
            $Password= $_REQUEST['password'];
            $Balance= $_REQUEST['balance'];
            $Mobile= $_REQUEST['mobile'];
            $Role=$_REQUEST['role'];

            if(empty($Fname) or empty($Lname)){$errorMsg[0] = 'Name Required';}

            if(empty($DOB)){$errorMsg[1] = 'Date of Birth Required';} 
            
            if($DOB > date("Y-m-d")){$errorMsg[1] = 'Valid Date Required';}

            if(empty($Email)){$errorMsg[2] = 'Email Required';}

            if(empty($Username)){$errorMsg[3] = 'Username Required';}

            if(strlen($Password) < 6){$errorMsg[4] = 'Must Be At Least 6 Characters';}

            if(empty($Balance) && $Balance != 0){$errorMsg[5] = 'Balance Required';}

            if(empty($Mobile)){$errorMsg[6] = 'Mobile Required';}

            if(empty($Role)){$errorMsg[7] = 'Role Required';}

            //Prepared SQL Statements for Error Handles and Update
            if(empty($errorMsg)){
                $sql = "SELECT * FROM user WHERE email=?";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "SQL statement failed";
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $Email);
                    mysqli_stmt_execute($stmt);
                    $result=mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) > 0){$errorMsg[8] = 'Email Already Taken';}
                }

                $sql = "SELECT * FROM user WHERE username=?";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "SQL statement failed";
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $Username);
                    mysqli_stmt_execute($stmt);
                    $result2=mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result2) > 0){$errorMsg[9] = 'Username Already Taken';}
                }
                if(empty($errorMsg)){
                    $Hashed_password = password_hash($Password, PASSWORD_DEFAULT);
                    $created = new DateTime();
                    $created = $created->format('Y-m-d H:i:s');

                    $sql = "INSERT INTO user (Fname,Lname,DOB,Email,Username,Password,Balance,Pnumber,Created,User_Status) VALUES(?,?,?,?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "SQL statement failed";
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "ssssssdsss", $Fname, $Lname, $DOB, $Email, $Username, $Hashed_password, $Balance, $Mobile, $created, $Role);
                        mysqli_stmt_execute($stmt);
                        header("location: ../users?add");
                    }
                }
            }
        }
    ?>
<div class="page-content">
        <div class = "display-body">
            <form  action = "add" method="post" class="signup-form">
                <h3 class="display-header">Create User</h3>
                <div class = "signup-input">
                    <label class="label-double">Full Name</label><br>
                    <?php
                        if(isset($errorMsg[0])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[0]."</p>";}
                    ?>
                    <input type="text" placeholder="First name..." class="input-double" name="fname" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
                    <input type="text" placeholder="Last name..." class="input-double" name="lname" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>"><br>
                    <label class="label-single">Date of Birth</label>
                    <?php
                        if(isset($errorMsg[1])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[1]."</p>";}
                    ?>
                    <input type="date" class="input-single" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>">
                    <label class="label-single">Email</label>
                    <?php
                        if(isset($errorMsg[2])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[2]."</p>";}
                        if(isset($errorMsg[8])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[8]."</p>";}
                    ?>
                    <input type="email" placeholder="Email..." class="input-single" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                    <label class="label-single">User Name</label>
                    <?php
                        if(isset($errorMsg[3])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[3]."</p>";}
                        if(isset($errorMsg[9])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[9]."</p>";}
                    ?>
                    <input type="text" placeholder="Username..." class="input-single" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                    <label class="label-single">Password</label>
                    <?php
                        if(isset($errorMsg[4])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[4]."</p>";}
                    ?>
                    <input type="password" placeholder="Password..." class="input-single" name="password">
                    <label class="label-single">Balance</label>
                    <?php
                        if(isset($errorMsg[5])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[5]."</p>";}
                    ?>
                    <input type="text" placeholder="0..." class="input-single" name="balance" value="<?php echo isset($_POST['balance']) ? $_POST['balance'] : '' ?>">
                    <label class="label-single">Mobile</label>
                    <?php
                        if(isset($errorMsg[6])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[6]."</p>";}
                    ?>
                    <input type="text" placeholder="713..." class="input-single" name="mobile" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : '' ?>">
                    <label class="label-single">Role</label>
                    <?php
                        if(isset($errorMsg[7])){echo "<p style='color:red; font-size:12px; margin-left:9px;'>".$errorMsg[7]."</p>";}
                    ?>
                    <select name="role">
                        <option value="user">User</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class = "signup-button">
                    <button type="submit" name ="submit">CREATE USER</button>
                </div>
            </form>
        </div>
    </div>
<?php
    include_once '../../footer.php';
?>