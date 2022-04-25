<script>
    var state = false;
    function toggle(){
        if(state){
            document.getElementById("ipassword").setAttribute("type","password");
            document.getElementById("ipasswordrepeat").setAttribute("type","password");
            document.getElementById("icon").innerText = "visibility_off";
            state = false;
        }
        else{
            document.getElementById("ipassword").setAttribute("type","text");
            document.getElementById("ipasswordrepeat").setAttribute("type","text");
            document.getElementById("icon").innerText = "visibility";
            state = true;
            icon.innerT = "visibility";
        }
    }
</script>

<style>
    .errors {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        color: red;
        font-size: 12px;
    }
</style>

<?php
    include_once 'header.php';
    include('validate_signup.php');
?>
    <div class="page-content">
        <div class = "signup-body">
            <head2>
                <title>Sign Up</title>
                <link rel="stylesheet" href="style.css">
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
            </head2>
            <form  method="post" class="signup-form">
                <h2>SIGN UP</h2>
                <div class = "signup-input">
                    <label class="label-double">Full Name</label><br>
                    <input type="text" placeholder="First name..." class="input-double" name="fname" autocomplete="off" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>">
                    <input type="text" placeholder="Last name..." class="input-double" name="lname" autocomplete="off" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>">
                    <div class="errors">
                        <p>
                            <?php echo $errors['name'];?>
                        </p>
                    </div>
                    <label class="label-single">Email</label>
                    <input type="email" placeholder="Email..." class="input-single" name="email" autocomplete="on" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                    <div class="errors"><?php echo $errors['email'];?></div>
                    <label class="label-single">User Name</label>
                    <input type="text" placeholder="Username..." class="input-single" name="uid" autocomplete="off" value="<?php echo isset($_POST['uid']) ? $_POST['uid'] : '' ?>">
                    <div class="errors"><?php echo $errors['username'];?></div>
                    <label class="label-single">Password</label>
                    <input type="password" placeholder="Password..." id="ipassword" class="input-single" name="pwd" autocomplete="off">
                    <i><span class="material-icons-outlined" id ="icon" onclick="toggle()">visibility_off</span></i>
                    <div class="errors"><?php echo $errors['password'];?></div>
                    <label class="label-single">Repeat Password</label>
                    <input type="password" placeholder="Password..." id ="ipasswordrepeat" class="input-single" name="pwdrepeat"  autocomplete="off">
                </div>
                <div class = "message-signredirect">Already a User?</div>
                <div class = "link-signredirect"> 
                    <li><a href="login">Log In Instead</a></li>
                </div>



                <div class = "signup-button">
                    <button type="submit" name ="submit-signup">SIGN UP</button>
                </div>
                <div class="errors"><?php echo $errors['duplicate'];?></div>
            </form>
        </div>
    </div>
<?php
    include_once 'footer.php';
?>