<?php
    include_once 'adminpanel.php';
    //Reset Search Fields
    if(isset($_REQUEST['reset'])){
        $_SESSION["Request-User"] = '%%';
    }

    //Define Search Fields in Session
    if(isset($_REQUEST['submit'])){
        $_SESSION["Request-User"] = '%'.$_REQUEST["User"].'%';
    }

    //Define Session Variables Inititally
    if(empty($_SESSION["Request-User"])){$_SESSION["Request-User"] = '%%';}
    
    //Initialize Dynamic SQL Statements
    $Output = '';
    $DataArray = array();
    $Limitby = 10;

    if($_SESSION["Request-User"] != '%%'){ $Output = $Output .'AND Username LIKE \''.$_SESSION["Request-User"]. '\'';}
    
    if(isset($_REQUEST['returnid'])){
        $RID = $_REQUEST['returnid'];
        $IID = $_REQUEST['itemid'];
       // $Fine = 0;
        $returned = date("Y-m-d");
        echo $returned;
        $sql = "UPDATE loan SET Drop_date = '$returned', Returned = 1 WHERE Item = $IID";
        $result=mysqli_query($con,$sql);
        $sql = "UPDATE reservation SET Status = 9 WHERE Item = $IID";
        $result = mysqli_query($con,$sql);
        $sql = "DELETE FROM notifications WHERE notification_item = $IID";
        $result = mysqli_query($con,$sql);
        if($result){
            $sql = "UPDATE item SET In_use = 1 WHERE Item_id = $IID";
            $result = mysqli_query($con,$sql);
        }
        $sql = "SELECT * FROM loan WHERE Item = $IID";
        $result=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $returndate = $row['Return_date'];
           $User = $row['User'];
        }
        if($returned > $returndate){
            $returndate = new DateTime($returndate);
            $returned = new DateTime($returned);
            $datediff = date_diff($returned, $returndate);
            $Fine = $datediff->format('%d');
            $Fine = $Fine * 3;

        }
        if($Fine > 0){
           $sql2 = "UPDATE user SET Balance = ? WHERE User_id = $User";
            $stmt = mysqli_stmt_init($con);
            if(!mysqli_stmt_prepare($stmt,$sql2)){echo "SQL statement failed";}
            else{
               mysqli_stmt_bind_param($stmt, "d", $Fine);
               mysqli_stmt_execute($stmt);
            }
       }
        header("location:loans?success");
    }
?>

    <div class="content">
        <head2> <title>Manage Requests</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css"> </head2>
        <?php
            if(isset($_REQUEST['success'])){
                $Success = $_REQUEST['success'];
                echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Your return was successful</h4>';
            }
        ?>
        
        
        <form class="admin-form">
        <h2 style = "text-align:center;">User Loans</h2>
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
                </input><br><br>
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
                    <th>Loan Date
                    </th>
                    <th>Return Date
                    </th>
                    <th>Actions</th>
                </tr>
            </thread>
        <?php
            $sql = '';
            $NumResults = 0;
            $num = 0;
            $sql="SELECT loan.Loan_id, item.Item_id, user.User_id, loan.Item, loan.User, loan.Loan_date, loan.Return_date,user.Username,book.Name AS bName, journal.Name AS jName, electronic.Name AS eName, disk.Name AS dName
            FROM loan
            INNER JOIN item ON item.Item_id=loan.Item
            LEFT JOIN book ON item.Book_id = book.Book_id
            LEFT JOIN journal ON item.Journal_id = journal.Journal_id
            LEFT JOIN disk ON item.Disk_id = disk.Disk_id
            LEFT JOIN electronic ON item.Electronic_id = electronic.Electronic_id
            INNER JOIN user ON user.User_id=loan.User
            WHERE loan.Returned = 0 $Output
            ORDER BY Loan_date";
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
            $sql="SELECT loan.Loan_id, item.Item_id, user.User_id, loan.Item, loan.User, loan.Loan_date, loan.Return_date,user.Username,book.Name AS bName, journal.Name AS jName, electronic.Name AS eName, disk.Name AS dName
            FROM loan
            INNER JOIN item ON item.Item_id=loan.Item
            LEFT JOIN book ON item.Book_id = book.Book_id
            LEFT JOIN journal ON item.Journal_id = journal.Journal_id
            LEFT JOIN disk ON item.Disk_id = disk.Disk_id
            LEFT JOIN electronic ON item.Electronic_id = electronic.Electronic_id
            INNER JOIN user ON user.User_id=loan.User
            WHERE loan.Returned = 0 $Output
            ORDER BY Loan_date";
            $result=mysqli_query($con,$sql);
            
            if(!empty($result)){
                while($row=mysqli_fetch_assoc($result)){
                $ID = $row['Loan_id'];
                $Item = $row['Item_id'];
                $UserID = $row['User_id'];
                $LoanStart = $row['Loan_date'];
                $LoanEnd = $row['Return_date'];
                if(!empty($row['bName'])){$ItemName = $row['bName'];}
                if(!empty($row['jName'])){$ItemName = $row['jName'];}
                if(!empty($row['eName'])){$ItemName = $row['eName'];}
                if(!empty($row['dName'])){$ItemName = $row['dName'];}
                if(empty($ItemName)){$ItemName = 'None';}
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
                            <td id = "'.$num.'" onclick ="content()">'.$ItemName.'</td>
                        <td class = "admin-table-name" id = "'.$num.'" onclick ="content()">
                            <b style = "color: #3091C1; font-size: 18px;">'.$LoanStart.'</b><br>
                        </td>
                        <td id = "'.$num.'" onclick ="content()">'.$LoanEnd.'</td>';
                        if($LoanStart > $LoanEnd){
                            echo'
                            <td id = "'.$num.'" onclick ="content()">
                                <button style = "color: #ad4c4c; font-size: 17px;" class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: #38B023; font-size: 18px;"><b>Status: Overdue<br>Return</b></button><br>
                            </td>';
                        }
                        else{
                            echo'
                            <td id = "'.$num.'" onclick ="content()">
                                <button class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: #38B023; font-size: 18px;">Status: Good<br>Return</button><br>
                            </td>
                            ';
                        }
                echo'
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
                                        </div><br>                                  
                                        <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                            <b>Item Name:</b> '.$ItemName.'
                                        </div><br>
                                        <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                            <b>Date Started:</b> '.$LoanStart.'
                                        </div><br>
                                        <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                            <b>Date Started:</b> '.$LoanEnd.'
                                        </div><br>
                                        <div style = "display:inline-block; margin: 10px auto; max-width: 460px;">
                                            <button type="button" class = "button-reserve" style="font-size: 25px;" onclick="location.href=\'?returnid='.$ID.'&itemid='.$Item.'\'">Confirm Return</button>
                                        </div><br>
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