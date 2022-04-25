<?php
    include '../../connect.php';
    if(isset($_GET['requestid'])){
        $id=$_GET['requestid'];

        $sql="UPDATE reservation SET Status = 2 WHERE Reservation_id=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            header('location:../adminrequests.php');
        }
        else{
            die(mysqli_error($con));
        }
    }
?>