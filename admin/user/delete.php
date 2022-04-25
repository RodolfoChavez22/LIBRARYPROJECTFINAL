<?php
    include '../../connect.php';
    //Redirect if the user is not a admin
    if($_SESSION['User_Status'] != 'admin'){
        header("Location: ../../homepage.php");
      }
    //Delete the user
    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];

        $sql="UPDATE user SET Deleted_id = 1 WHERE User_id=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            header('location:../users?delete');
        }
        else{
            die(mysqli_error($con));
        }
    }
?>