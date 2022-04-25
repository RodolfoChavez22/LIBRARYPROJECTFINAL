<?php
    include_once 'adminpanel.php';
    //Reset Search Fields
    if(isset($_REQUEST['reset'])){
        $_SESSION["Request-User"] = '%%';
        $_SESSION["Request-Status"] = '%%';
    }

    //Define Search Fields in Session
    if(isset($_REQUEST['submit'])){
        $_SESSION["Request-User"] = '%'.$_REQUEST["User"].'%';
        $_SESSION["Request-Status"] = '%'.$_REQUEST["Status"].'%';
    }

    //Define Session Variables Inititally
    if(empty($_SESSION["Request-User"])){$_SESSION["Request-User"] = '%%';}
    if(empty($_SESSION["Request-Status"])){$_SESSION["Request-Status"] = '%%';}
    
    //Initialize Dynamic SQL Statements
    $Output = '';
    $DataArray = array();
    $Limitby = 10;

    if($_SESSION["Request-User"] != '%%'){ $Output = $Output .'Username LIKE \''.$_SESSION["Request-User"]. '\'';}
    if($_SESSION["Request-Status"] != '%%'){ 
        if(!empty($Output)){
            $Output = $Output .' AND ';
        }
        $Output = $Output .'Reserve_status LIKE \''.$_SESSION["Request-Status"]. '\'';
    }
    if(empty($Output)){$Output = $Output .'Reservation_id > 1';}

    if(isset($_REQUEST['cancelid'])){
        $RID = $_REQUEST['cancelid'];
        $IID = $_REQUEST['itemid'];
        $sql = "UPDATE reservation SET Status = 4 WHERE Item = $IID";
        $result = mysqli_query($con,$sql);
        $sql = "DELETE FROM notifications WHERE notification_item = $IID";
        $result = mysqli_query($con,$sql);
        if($result){
            $sql = "DELETE FROM item WHERE Item_id = $IID";
            $result = mysqli_query($con,$sql);
            header("location:request?success");
        }
    }
    if(isset($_REQUEST['acceptid'])){
        $RID = $_REQUEST['acceptid'];
        $UID = $_REQUEST['userid'];
        $IID = $_REQUEST['itemid'];
        $US = $_REQUEST['userstatus'];
        $sql = "UPDATE reservation SET Status = 2 WHERE Item = $IID";
        $result = mysqli_query($con,$sql);
        header("location:request?success");
    }


?>

    <div class="content">
        <head2> <title>Manage Requests</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css"> </head2>
        <?php
            if(isset($_REQUEST['success'])){
                $Success = $_REQUEST['success'];
                echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Your request change was successful</h4>';
            }
        ?>
        <form class="admin-form">
            <h2 style = "text-align:center;">User Requests</h2>
            <h4>Search by:</h4><br>
            <label class="admin-label">Username:</label>
                <input list="listUsername" name="User" placeholder="Username..." class="admin-list"
                    <?php if($_SESSION["Request-User"] != '%%'){ $Value =  'value = "'.substr($_SESSION["Request-User"], 1, -1).'"'; echo $Value; } ?>>
                    <datalist id="listUsername">
                        <?php
                            $DataArray = array_diff( $DataArray, $DataArray);
                            $sql = "SELECT Username, Deleted_id FROM user WHERE Deleted_id = 0";
                            if($result = mysqli_query($con,$sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp = $row['Username'];
                                        if(!in_array($temp, $DataArray)){
                                            $DataArray[] = $temp;
                                            echo "<option>$temp</option>";
                                        }
                                    }
                                }
                            }
                        ?>
                    </datalist>
                </input>
                <label class="admin-label">Status:</label>
                <input list="listStatus" name="Status" placeholder="Status..." class="admin-list"
                    <?php if($_SESSION["Request-Status"] != '%%'){ $Value =  'value = "'.substr($_SESSION["Request-Status"], 1, -1).'"'; echo $Value; } ?>>
                    <datalist id="listStatus">
                        <?php
                            $DataArray = array_diff( $DataArray, $DataArray);
                            $sql = "SELECT Reserve_status FROM reservation_status";
                            if($result = mysqli_query($con,$sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp = $row['Reserve_status'];
                                        if(!in_array($temp, $DataArray)){
                                            $DataArray[] = $temp;
                                            echo "<option>$temp</option>";
                                        }
                                    }
                                }
                            }
                        ?>
                    </datalist>
                </input> <br><br>
                <div class="admin-button-line"> 
                    <label class="admin-button"> <button type="submit" name ="submit">Search</button> </label>
                    <label class="admin-button"> <button type="submit" name ="reset">Reset</button> </label>
                </div>     
        </form>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <table class = "content-table">
            <thread>
                <tr>
                    <th style = "width:1%;">#</th>
                    <th>Username
                    </th>
                    <th>Item
                    </th>
                    <th>Status
                    </th>
                    <th>Request Date
                    </th>
                    <th>Actions</th>
                </tr>
            </thread>
        <?php
            $sql = '';
            $NumResults = 0;
            $num = 0;
            $sql="SELECT reservation.Reservation_id, item.Item_id, user.User_id, reservation.Status, reservation.Request_date,
                        reservation_status.Reserve_status, user.Username, book.Name AS bName, journal.Name AS jName, electronic.Name AS eName, disk.Name AS dName, user.User_Status
            FROM reservation
            LEFT JOIN item ON item.Item_id=reservation.Item
            LEFT JOIN book ON item.Book_id = book.Book_id
            LEFT JOIN journal ON item.Journal_id = journal.Journal_id
            LEFT JOIN disk ON item.Disk_id = disk.Disk_id
            LEFT JOIN electronic ON item.Electronic_id = electronic.Electronic_id
            INNER JOIN user ON user.User_id=reservation.User
            INNER JOIN reservation_status ON reservation_status.Reserve_id=reservation.Status
            WHERE $Output
            ORDER BY Request_date";
            $result=mysqli_query($con,$sql);
            $NumResults = $NumResults + mysqli_num_rows($result);
            $sql = '';
            //Set page value based on default or user -----------------------------------------------------------------------------
            if(!isset($_GET['page'])){$page = 1;}
            else{$page = $_GET['page'];}

            $PageResults = $Limitby;
            $NumOfPages = ceil($NumResults/$PageResults);
            $FirstResult = ($page-1)*$PageResults;
            $num = $FirstResult;
            $sql = "";
            $result = "";



            include '../connect.php';
            $sql="SELECT reservation.Reservation_id, item.Item_id, user.User_id, reservation.Status, reservation.Request_date,
                        reservation_status.Reserve_status, user.Username, book.Name AS bName, journal.Name AS jName, electronic.Name AS eName, disk.Name AS dName, user.User_Status
            FROM reservation
            LEFT JOIN item ON item.Item_id=reservation.Item
            LEFT JOIN book ON item.Book_id = book.Book_id
            LEFT JOIN journal ON item.Journal_id = journal.Journal_id
            LEFT JOIN disk ON item.Disk_id = disk.Disk_id
            LEFT JOIN electronic ON item.Electronic_id = electronic.Electronic_id
            INNER JOIN user ON user.User_id=reservation.User
            INNER JOIN reservation_status ON reservation_status.Reserve_id=reservation.Status
            WHERE $Output
            ORDER BY Request_date
            LIMIT $FirstResult, $PageResults";
            $result=mysqli_query($con,$sql);
            
            if(!empty($result)){
                while($row=mysqli_fetch_assoc($result)){
                $ID = $row['Reservation_id'];
                $Item = $row['Item_id'];
                $UserID = $row['User_id'];
                $UStatus = $row['User_Status'];
                if(!empty($row['bName'])){$ItemName = $row['bName'];}
                if(!empty($row['jName'])){$ItemName = $row['jName'];}
                if(!empty($row['eName'])){$ItemName = $row['eName'];}
                if(!empty($row['dName'])){$ItemName = $row['dName'];}
                if(empty($ItemName)){$ItemName = 'None';}
                $Status = $row['Reserve_status'];
                $Date = $row['Request_date'];
                $Username = $row['Username'];
                //Echo the table -----------------------------------------------------------------------------------------------------
                $num += 1;
                echo '
                <tbody>
                    <tr id = '.$num.'>
                        <td id = "'.$num.'" onclick ="content()">
                            <s style="padding:5px 7px; border-radius: 5px;">'.$num.'</s>
                        </td>
                        <td id = "'.$num.'" onclick ="content()">
                            <b>'.$Username.'</b><br>
                        </td>
                        <td id = "'.$num.'" onclick ="content()">'.$ItemName.'</td>';
                        echo'
                        <td class = "admin-table-name" id = "'.$num.'" onclick ="content()">
                            <b style = "color: #3091C1; font-size: 18px;">'.$Status.'</b><br>
                        </td>
                        <td id = "'.$num.'" onclick ="content()">'.$Date.'</td>
                        <td id = "'.$num.'" onclick ="content()">
                            <button class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: #38B023; font-size: 18px;">Change</button><br>
                        </td>
                    </tr>
                    <div class="modal" id="modal'.$num.'">
                        <div class="modal-header">
                            <div class="title">Changing Reservation #: '.$ID.'</div>
                            <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class = "modal-body-text">
                                    <div style ="display:inline-block;"> 
                                        <div style = "color: rgba(0,0,0,.50); display:inline-block;"> 
                                            <b>Details</b> 
                                            <hr style="width:585px; border-color: rgba(0,0,0,.15); display:inline-block; position: relative; top: -3px;"> </hr>
                                        </div> <br><br>
                                        <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                            <b>Username:</b> '.$Username.'
                                        </div><br>
                                        <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                            <b>Item ID:</b> '.$Item.'
                                        </div><br>';
                                        if($Status != 'Canceled'){
                                            echo '                                        
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Item Name:</b> '.$ItemName.'
                                            </div><br>';
                                        }
                                        else{
                                            echo'
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Item Name:</b> None
                                            </div><br>';
                                        }
                                        echo'
                                        <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                            <b>Current Status:</b> '.$Status.'
                                        </div><br>';
                                        if($Status != 'Canceled' && $Status != 'Loaned' && $Status != 'Returned'){
                                            echo '                                        
                                            <div style = "display:inline-block; margin: 10px auto; max-width: 460px;">
                                                <button type="button" class = "button-reserve" style="font-size: 25px;" onclick="location.href=\'?acceptid='.$ID.'&itemid='.$Item.'&userid='.$UserID.'&userstatus='.$UStatus.'\'">Accept Request</button>
                                                <button type="button" class = "button-delete" style="font-size: 25px;" onclick="location.href=\'?cancelid='.$ID.'&itemid='.$Item.'\'">Cancel Request</button>
                                            </div><br>';
                                        }
                                    echo '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="overlay"></div>
                </tbody>';
                }
            }
            else{
                $NumOfPages = 0;
            }
            echo '</table>';
            echo '<div class = "PageCount">';
            for($PageCount=1;$PageCount<=$NumOfPages;$PageCount++){
                echo '<a href="?page='.$PageCount.'">';
                if($PageCount == $page){
                    echo '<div class = "Selected-Page" style = "display:inline-block;">
                                <b>'.$PageCount.'</b>
                        </div>
                    </a>';
                }
                else{
                    echo '<div class = "Unselected-Page" style = "display:inline-block;">
                                <b>'.$PageCount.'</b>
                        </div>
                    </a>';
                } 
            }
            echo '</div>';
        ?>
</div>
</section>
</div>
<?php include_once '../footer.php'; ?>
<script type="text/javascript" src="../modal.js"></script> 