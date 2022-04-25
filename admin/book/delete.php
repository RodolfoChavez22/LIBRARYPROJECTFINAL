<?php
    include '../../connect.php';
    //Redirect if the user is not a admin
    if($_SESSION['User_Status'] != 'admin'){
        header("Location: ../../homepage");
    }
    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];

        $sql="UPDATE book SET Deleted_id = 1 WHERE Book_id=$id";
        $result=mysqli_query($con,$sql);
        if($result){
            header('location:../books?delete');
        }
        else{
            die(mysqli_error($con));
        }
    }
?>