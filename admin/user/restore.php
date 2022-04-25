<?php
    include '../../connect.php';
    //Redirect if the user is not a admin
    if($_SESSION['User_Status'] != 'admin'){
        header("Location: ../../homepage.php");
    }
    //Restore the user
    if(isset($_GET['restoreid'])){
        $id=$_GET['restoreid'];

        $sql="UPDATE user SET Deleted_id = 0 WHERE User_id=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            header('location:../restore?success');
        }
        else{
            die(mysqli_error($con));
        }
    }
?>