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
        font-size: 17px;
    }
    
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 45%; /* Could be more or less, depending on screen size */
  height: 30%;
  border-radius:10px;
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>





<?php
    include_once 'C:\xampp\htdocs\library\header.php';

    $errors['submit'] = '';
    $userid = $_SESSION['User_id'];

    if(isset($_POST['submit'])){
        $email=$_POST['Email'];
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $username=$_POST['username'];
        $phonenum=$_POST['phonenum'];

        if(!empty($email) && !empty($hash) && !empty($username) && !empty($phonenum)){

            $sql="UPDATE user SET Email = '$email', password ='$$hash', Username = '$username', Pnumber = '$phonenum' WHERE User_id = '$userid' ";
            $result = mysqli_query($con, $sql);
            if($result){
                echo "";
            }else{
                $errors['submit'] = "Please Enter All Information";
                die(mysqli_error($con));
            }
        }else{
            $errors['submit'] = "Please enter all information";
        }
    }
?>

<?php
        $errors['check'] = '';

        if(isset($_POST['check'])){
            if(isset($_POST['book'])){

            if(!empty($_POST['book'])){
            $books = $_POST['book'];

                foreach($books as $item){
                    $sql = "UPDATE reservation SET Status = 4 WHERE Item = $item";
                    $result = mysqli_query($con,$sql);
                    $sql = "DELETE FROM notifications WHERE notification_item = $item";
                    $result = mysqli_query($con,$sql);
                    if($result){
                        $sql = "DELETE FROM item WHERE Item_id =  $item";
                        $result = mysqli_query($con,$sql);
                    }
                }
            }else{
                $errors['check'] = "No Checkboxes To Select";
        }
            }
            }

    ?>
    <button id="myBtn" style="position:absolute; left:.5% ; margin-top:7%; width:17%; height: 15%; border-radius:5%; background-color: white;text-align: center; text-decoration: none; display: inline-block; font-size: 20px;font-weight: bold;letter-spacing: 0.5px;">Notifications</button>

<!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <span class="close">&times;</span>
    <h2 style="text-align: center;">Notifications</h2>
    <?php
    $sql = "SELECT item.Disk_id, item.Electronic_id, item.Book_id, item.Journal_id, notification_item
    from notifications
    INNER JOIN item ON item.Item_id=notifications.notification_item
    Where notification_User = '$userid'";

    $result = mysqli_query($con, $sql); 
    $i = 0; 
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $IID = $row['notification_item'];

            if(!empty($row['Disk_id'])){
                $sql2 = "SELECT disk.Name FROM item INNER JOIN disk ON disk.Disk_id=item.Disk_id WHERE item.User_id = $userid AND item.Item_id = $IID";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $disk = $row2['Name'];
                $i+=1;
                echo'<p style="text-align:center; font-size: 20px;font-weight: bold;letter-spacing: 0.5px; padding: 10px">You have made a reservation for '.$disk.'</p>';
            }
            elseif(!empty($row['Electronic_id'])){
                $sql2 = "SELECT electronic.Name FROM item INNER JOIN electronic ON electronic.Electronic_id=item.Electronic_id WHERE item.User_id = $userid AND item.Item_id = $IID";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $elect = $row2['Name'];
                $i+=1;
                echo'<p style="text-align:center; font-size: 20px;font-weight: bold;letter-spacing: 0.5px; padding: 10px">You have made a reservation for '.$elect.'</p>';
            }
            elseif(!empty($row['Book_id'])){
                $sql2 = "SELECT book.Name FROM item INNER JOIN book ON book.Book_id=item.Book_id WHERE item.User_id = $userid AND item.Item_id = $IID";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $book = $row2['Name'];
                $i+=1;
                echo'<p style="text-align:center; font-size: 20px;font-weight: bold;letter-spacing: 0.5px; padding: 10px">You have made a reservation for '.$book.'</p>';
            }
            elseif(!empty($row['Journal_id'])){
                $sql2 = "SELECT journal.Name FROM item INNER JOIN journal ON journal.Journal_id=item.Journal_id WHERE item.User_id = $userid AND item.Item_id = $IID";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $journal = $row2['Name'];
                $i+=1;
                echo'<p style="text-align:center; font-size: 20px;font-weight: bold;letter-spacing: 0.5px; padding: 10px">You have made a reservation for '.$journal.'</p>';
            }
        }
        if($i < 1){
            echo'<p style="text-align:center; font-size: 20px;font-weight: bold;letter-spacing: 0.5px; padding: 10px">NO NEW NOTIFICATIONS</p>';
        }
    }
    else{
        echo'<p style="text-align:center; font-size: 20px;font-weight: bold;letter-spacing: 0.5px; padding: 10px">Some text in the Modal..</p>';
    }
    

    ?>
</div>

</div>

<div class="page-content">
    <div class = "usrdash">
            <head2>
                <title>User Dashboard</title>
                <link rel="stylesheet" href="../style.css">
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
            </head2>
        

        
            <div class = "userdash">


                <link rel="stylesheet" href="style.css">
                <form method = "post" class="login-form" style = "position: absolute; left:.5%; margin-top:10%; width: 17%; height: 57%;">
                    <h2> Change Information </h2>
                    <div class = "login-input">
                        <label>Change Email<label> <input type = "text" placeholder =  "New Email..."  class = "login-input" name = "Email">
                    </div>
                    <div class = "login-input">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password..." id="ipassword" name = "password">
                            <i><span class="material-icons-outlined" id ="icon" onclick="toggle()">visibility_off</span></i>
                    </div>
                    <div class = "login-input">
                        <label>UserName<label> <input type = "text" placeholder = "New UserName..." class = "login-input" name="username">
                    </div>
                    <div class = "login-input">
                        <label>Phone Number<label> <input type = "text" placeholder = "New Phone Number..." class="login-input" name = "phonenum">
                    </div>
                    
                    <label>Ready To Submit Changes?<label>
                    <button type = "submit" name="submit" style="width: 200px; height:50px;background-color: #999DA0;border: none; color: Black; padding: 15px 32px;
                    text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border-radius: 5px;"> Submit Changes</button>
                    <div class="errors">
                        <p>
                            <?php echo $errors['submit'];?>
                        </p>
                    </div>
                
                </form>
            </div>

            
            <form class="login-form" style = "position:absolute; margin-top:.5%; margin-left:-10%; width:50%; height:22%">
            <h2>User Information</h2>
                <table class ="table table-bordered">
                    <thead>
                        <tr>
                            <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">UserName</th>
                            <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">First Name</th>
                            <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Last Name</th>
                            <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Email Address</th>
                            <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">DOB</th>
                            <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Phone Number</th>
                            <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Amount Owed</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        $sql = "Select * from `user` Where User_id = '$userid'";
                        $result = mysqli_query($con, $sql);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $Balance = $row['Balance'];
                                $Uname = $row['Username'];
                                $fname = $row['Fname'];
                                $lname = $row['Lname'];
                                $email = $row['Email'];
                                $dob = $row['DOB'];
                                $pnum =$row['Pnumber'];

                                echo'<tr>
                                <th scope = "row" style = "padding-left:20px">'.$Uname.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$fname.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$lname.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$email.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$dob.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$pnum.'</th>
                                <th scope = "row" style = "padding-left:20px">$'.$Balance.'</th>
                                
                                </tr>';
                            }
                        }


                    ?>
                    </tbody>
                    
                </table>
            </form>
            

            <form class="login-form" lass="login-form" style = "position:absolute; margin-top:13% ; margin-left:-10%; width:47%; height:53%;" >
            <h2> Book History </h2>
                <table>
                <tr>
                    <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Loan ID</th>
                    <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Item Name</th>
                    <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Date Loaned</th>
                    <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Due Date</th>
                    <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Status</th>
                    <th scope = "col" style = "padding-left:30px; font-size: 19; color: grey">Fine</th>
                </tr>
                <?php

                $sql = "SELECT DISTINCT loan.Loan_id, loan.Loan_date, loan.Return_date, loan.Drop_date,
                book.Name AS bName, journal.Name AS jName, electronic.Name AS eName, disk.Name AS dName FROM loan
                INNER JOIN reservation ON loan.Item = reservation.Item
                LEFT JOIN item ON item.Item_id=reservation.Item
                LEFT JOIN book ON item.Book_id = book.Book_id
                LEFT JOIN journal ON item.Journal_id = journal.Journal_id
                LEFT JOIN disk ON item.Disk_id = disk.Disk_id
                LEFT JOIN electronic ON item.Electronic_id = electronic.Electronic_id";
                $result = mysqli_query($con, $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $loanID = $row['Loan_id'];
                        if(!empty($row['bName'])){$ItemName = $row['bName'];}
                        if(!empty($row['jName'])){$ItemName = $row['jName'];}
                        if(!empty($row['eName'])){$ItemName = $row['eName'];}
                        if(!empty($row['dName'])){$ItemName = $row['dName'];}
                        if(empty($ItemName)){$ItemName = 'None';}
                        $loanout = new DateTime($row['Loan_date']);
                        $duedate = new DateTime($row['Return_date']);
                        $datediff = 0;
                        $Fine = 0;
                        if($loanout > $duedate){
                            $datediff = date_diff($duedate, $loanout);
                            $Fine = $datediff->format('%d');
                            $Fine = $Fine * 3;
                        }
                        if(!empty($datediff) && empty($row['Drop_date'])){
                            $stat = 'Overdue';
                        }
                        elseif(!empty($row['Drop_date'])){
                            $stat =  'Returned';
                        }
                        else{
                            $stat =  'Good';
                        }
                        $loanout = $row['Loan_date'];
                        $duedate = $row['Return_date'];
                        echo'<tr>
                                <th scope = "row" style = "padding-left:20px">'.$loanID.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$ItemName.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$loanout.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$duedate.'</th>
                                <th scope = "row" style = "padding-left:20px">'.$stat.'</th>
                                <th scope = "row" style = "padding-left:20px">$'.$Fine.'</th>
                                </tr>';
                    }
                }else{
                    echo 'notworking';
                }


                ?>
                
                
                </table>
            </form>

            
            <form method = "post" class="login-form" style = "position:absolute; margin-top:2%; margin-left:70%; width:25%; height:70%;">
            <h2> Library Requests </h2>
            <table>
                <tr>
                    <th scope = "col" style = "padding:15px; font-size: 19; color: grey">Book Name</th>
                    <th scope = "col" style = "padding:15px; font-size: 19; color: grey">Request Date</th>
                    <th scope = "col" style = "padding:15px; font-size: 19; color: grey">Select</th>
                    
                </tr>
                <tr>
                <?php

                $bookname = "";

                    $sql = "SELECT DISTINCT reservation.Request_date, reservation.Item
                    FROM user
                    INNER JOIN reservation ON reservation.User = $userid
                    INNER JOIN reservation_status ON reservation_status.Reserve_id = reservation.Status
                    INNER JOIN item ON item.Item_id=reservation.Item
                    INNER JOIN book ON book.Book_id=item.Book_id
                    WHERE reservation_status.reserve_status = 'Requested'
                    ";
                    $result = mysqli_query($con, $sql);
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){
                            $bookname = 'test';
                            $reqdate = $row['Request_date'];
                            $itemid = $row['Item'];         

                            echo'<tr>
                                    <th scope = "row" style = "padding-left:20px">'.$bookname.'</th>
                                    <th scope = "row" style = "padding-left:20px">'.$reqdate.'</th> 
                                    <th><input type="checkbox" name="book[]" value="' . $row["Item"] . '"/></th>
                                    ';
                        }

                    }else{
                        echo "not working";
                    }
                    ?>
                </tr>
                </table>
                <label style="font-size: 19;">Delete Requests<lable>
                <button type = "submit" name="check" style="width: 200px; height:50px;background-color: #999DA0;border: none; color: Black; padding: 15px 32px;
   text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border-radius: 5px;"> Submit </button>
   </tr>

                <div class="errors">
                        <p>
                            <?php echo $errors['check'];?>
                        </p>
                    </div>
                </form>
            


        

    </div>
</div>

<script>
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }

</script>

    

<?php
				include_once '../footer.php';
?>

