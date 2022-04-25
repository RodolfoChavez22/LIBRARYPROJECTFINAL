<?php
    session_start();
    include 'connect.php';
    //Direct back if user is not logged in
    //Error1: Not Logged in, Error2: General Error, Error3: Cannot exceed order limit
    if(empty($_SESSION['User_Status'])){header('location: find?error=1');die;}
    //Check if user has a reason to be on this page
    if(isset($_GET['reserve']) && isset($_GET['type'])){
        $UID = $_SESSION['User_id'];
        $ItemID = $_GET['reserve'];
        $Type = $_GET['type'];
        $sql="SELECT * FROM user WHERE User_id = $UID";
        $result=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $Balance = $row['Balance'];
            $UserStatus = $row['User_Status'];
        }
        //Receieve user info, if it fails redirect back to catalog
        if($result && mysqli_num_rows($result) > 0){$user_data = mysqli_fetch_assoc($result);}
        else{header('location: find?error=2');die;}
        //Check if the user has any current overdue loan payments
        if($Balance > 0){header('location: find?error=6');die;}
        //********** */
        $testsql="SELECT Current_orders FROM user WHERE User_id = $UID";
        $testresult=mysqli_query($con,$testsql);
        while($row=mysqli_fetch_assoc($testresult)){
            $order_amount = $row['Current_orders'];
        }
        //****************** */
        //Admin and Staff have a total of 5 orders
        if($_SESSION['User_Status'] == 'admin' || $_SESSION['User_Status'] == 'staff'){

            if($order_amount >= 5){header('location: find?error=3');die;}
        }
        //Users have a total of 3 orders
        else if($_SESSION['User_Status'] == 'user'){
            if($order_amount >= 3){header('location: find?error=5');die;}
        }
        //Redirect if failed to find user_data
        else{header('location: find?error=2');die;}
        $sql = 'SELECT * From ' .$Type. ' WHERE Rental_status != 0 AND '.$Type.'_id = '.$ItemID.'';
        $result=mysqli_query($con,$sql);
        if($result && mysqli_num_rows($result) > 0){$Item = mysqli_fetch_assoc($result);}
        else{header('location: find?error=4');die;}
        if($Item['Reference_type'] == 4){$ItemName = $Item['Model'];}
        else{$ItemName = $Item['Name'];}
        //If the user passed all errors then create an item for them
        $sql = 'INSERT INTO item (User_id,'.$Type.'_id) VALUES(?,?)';
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
        else{
            mysqli_stmt_bind_param($stmt, "ss", $UID, $ItemID);
            mysqli_stmt_execute($stmt);
        }
    }
    else{header('location: find?error=2');die;}
    $ItemID = mysqli_insert_id($con);

    //echo "User Status: ".$_SESSION['User_Status']."<br/>"; // echo user type (user, staff, admin)
    //echo "UserName: ".$_SESSION['Username']."<br/>"; // echo username
    //echo "Reserve BookID: ".$bookid."<br/>"; // echo id of book in book table
    //echo "UserID: ".$uid."<br/>"; // echo id of user in user table

    //$sql="SELECT item.Item_id
            //FROM book
            //INNER JOIN item on item.Book = book.book_id
            //WHERE item.Book = $bookid AND item.Num_copies > 0";
            //$result=mysqli_query($con,$sql);

        // printf("Records updated: %d\n", mysqli_affected_rows($con));

        //if($result){

            //if(mysqli_num_rows($result) > 0){
                
                //$itemid = mysqli_fetch_row($result)[0];
                //echo "Item Id: ".$itemid."<br/>"; // echo item id in item that references the book id in book table

                //$usql = "UPDATE user SET Current_orders = Current_orders + 1 WHERE User_id = $uid"; // adds plus 1 to order_status to user in user table

                //$uresult = mysqli_query($con, $usql);

                //if($uresult) { // if order_status < 3 for user or order_status < 4 for staff go in here and do reservation (for user atm)

                    //echo "You can reserve a book<br/>";

    
    
    //testing why admin  is reserving more books than allowed
    $testsql="SELECT Current_orders FROM user WHERE User_id = $UID";
    $testresult=mysqli_query($con,$testsql);
    while($row=mysqli_fetch_assoc($testresult)){
        $order_amount = $row['Current_orders'];
    }
    //***********
    
    
    
     //Replace with prepared statement, we can assume that they are only requesting so the value is defaulted to 1
    date_default_timezone_set('America/Chicago');
    $created = new DateTime();
    $created = $created->format('Y-m-d H:i:s');
    $num = 1;            
    $sql = 'INSERT INTO `reservation` (`User`, `Status`, `Item`, `Request_date`) VALUES(?,?,?,?)';
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
    else{
        mysqli_stmt_bind_param($stmt, "iiis", $UID, $num, $ItemID, $created);
        mysqli_stmt_execute($stmt);
    }
    $result=mysqli_stmt_get_result($stmt);
    //if($result) {
        //echo $result;
        //echo 'Successfully Reserved Book</br>';
    header('location: find?co='.$order_amount.'&success='.$ItemName.'');
    die;
        //$sql = "UPDATE item SET Num_copies = Num_copies - 1 WHERE Item_id = $itemid";
    
        //$updateresult = mysqli_query($con, $sql);
    
        //if($updateresult) {
            //echo "Successfully updated num_copies of item</br>";
        //} else {
                //die(mysqli_error($con));
            //}
    
        //} else { // order status is either greater or equal to 3 (for user atm)
                //die(mysqli_error($con));
        //}
        //} else {
            //die(mysqli_error($con));
                // echo "Can't Reserve";
            //}

        //} else {
            //echo "Book Not Available</br>";
        //}

        //} else {
            //die(mysqli_error($con));
        //}


        //$cosql = "SELECT Current_orders FROM user WHERE user.User_id = $uid";
        
        //$coresult = mysqli_query($con, $cosql);
        
        //if($coresult) {
            //$currentorders = mysqli_fetch_row($coresult)[0];
        //} else {
            //die(mysqli_error($con));
        //}
        
        //echo "Current Orders: ".$currentorders."<br/>"; // echo current_orders after reservation
    //}
?>