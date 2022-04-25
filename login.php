<script>
    var state = false;
    function toggle(){
        if(state){
            document.getElementById("ipassword").setAttribute("type","password");
            document.getElementById("icon").innerText = "visibility_off";
            state = false;
        }
        else{
            document.getElementById("ipassword").setAttribute("type","text");
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
        font-size: 15px;
    }
</style>

<?php
    include_once 'header.php';
    include 'connect.php';

    $errors = array('username'=>'','password'=>'');

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$Username = $_POST['Username'];
		$Password = $_POST['Password'];

		if(!empty($Username) && !empty($Password))
		{

			//Reads from DB
			$query = "select * from user where Username = '$Username' limit 1";
			$result = mysqli_query($con, $query);

			if($result && mysqli_num_rows($result) > 0)
			{
				$user_data = mysqli_fetch_assoc($result);

				if (password_verify($Password, $user_data['Password']) && $user_data['Deleted_id'] == 0)
				{
					$_SESSION['User_id'] = $user_data['User_id'];
                    $_SESSION['User_Status'] = $user_data['User_Status'];
                    $_SESSION['Username'] = $user_data['Username'];
					header("Location: homepage");
					die;
				}
                else{
                    $errors['password'] = "Invalid Login<br/><br/>";
                }
			}
            else{
                $errors['username'] = "Invalid Login<br/>";
            }
		}
	    else
		{
			$errors['username'] = "Fill all fields<br/>";
		}
	}
?>

    <div class="page-content">
        <div class = "login-body">
            <head2>
                <title>Log In</title>
                <link rel="stylesheet" href="style.css">
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
            </head2>
            <form method="post" class="login-form">
            <h2>LOGIN</h2>
                <div class = "login-input">
                    <label class="label-single">User Name</label>
                    <input type="text" name="Username" placeholder="Username..." class="input-single" value="<?php echo isset($_POST['Username']) ? $_POST['Username'] : '' ?>"><br>
                </div>
                <div class="errors">
                        <p>
                            <?php echo $errors['username'];?>
                        </p>
                </div>
                <div class = "login-input">
                    <label class="label-single">Password</label>
                    <input type="password" name="Password" placeholder="Password..." id="ipassword" class="input-single">
                    <i><span class="material-icons-outlined" id ="icon" onclick="toggle()">visibility_off</span></i>
                </div>
                <div class="errors">
                        <p>
                            <?php echo $errors['password'];?>
                        </p>
                </div>
                <div class = "message-logredirect">No Account?</div>
                <div class = "link-logredirect"> 
                    <li><a href="signup">Register Instead</a></li>
                </div>
                <div class = "login-button">
                    <button type="submit">LOG IN</button>
                </div>
            </form>

        </div>
    </div>
<?php
    include_once 'footer.php';
?>