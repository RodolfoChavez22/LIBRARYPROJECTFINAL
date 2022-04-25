<?php
    include_once 'adminpanel.php';
    //Reset Search Fields
    if(isset($_REQUEST['reset'])){
        
        $_SESSION["Report-IType"];
        $_SESSION["User-Username"] = '%%';
        $_SESSION["Loan-Date-From"] = '';
        $_SESSION["Loan-Date-To"] = '';
        $_SESSION["Loan-Status"] = '';
        // $_SESSION["Limit"] = '';
    }
    
    //Define Search Fields in Session
    if(isset($_REQUEST['submit'])){
        $_SESSION["Report-IType"] = $_REQUEST["type"];
        $_SESSION["User-Username"] = '%'.$_REQUEST["Username"].'%';
        $_SESSION["Loan-Date-From"] = $_REQUEST["Date-From"];
        $_SESSION["Loan-Date-To"] = $_REQUEST["Date-To"];
        $_SESSION["Loan-Status"] = $_REQUEST["Status"];
        // $Sanitize = preg_replace("/[^0-9]/", "", $_REQUEST["Limit"]);
        // $_SESSION["Limit"] = filter_var($Sanitize, FILTER_SANITIZE_NUMBER_INT);
    }

    //Define Session Variables Inititally

    if(empty($_SESSION["Report-IType"])){$_SESSION["Report-IType"] = '%%';}
    if(empty($_SESSION["User-Username"])){$_SESSION["User-Username"] = '%%';}
    if(empty($_SESSION["Loan-Date-From"])){$_SESSION["Loan-Date-From"] = '';}
    if(empty($_SESSION["Loan-Date-To"])){$_SESSION["Loan-Date-To"] = '';}
    if(empty($_SESSION["Loan-Status"])){$_SESSION["Loan-Status"] = '';}

    // if(empty($_SESSION["Limit"])){$_SESSION["Limit"] = '';}

    //Initialize Dynamic SQL Statements
    $Output = '';
    $Variables = '';
    $SessionVars = array();

    $Limitby = '10';
    //Initialize Datalist entries for duplicates
    $DataArray = array();

    //Build Dynamic SQL Statements

    $typearr = ['book', 'journal', 'disk', 'electronic'];
    
    if($_SESSION["Report-IType"] != '%%' && in_array(strtolower($_SESSION["Report-IType"]), $typearr)){
       
        $Output = ".".ucfirst($_SESSION["Report-IType"])."_id";
    }

    $total = '';
    $Output2 = '';
    if(!empty($_SESSION["Loan-Date-From"]) || !empty($_SESSION["Loan-Date-To"])){
        if(!empty($_SESSION["Loan-Date-From"]) && empty($_SESSION["Loan-Date-To"])){
            $Output2 = $Output2 .' AND loan.Drop_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Loan-Date-From"];
            $SessionVars[] = date("Y-m-d");
            $total = "WHERE loan.Drop_date BETWEEN '".$_SESSION["Loan-Date-From"]."' AND '".date("Y-m-d")."'";

        }
        elseif(empty($_SESSION["Loan-Date-From"]) && !empty($_SESSION["Loan-Date-To"])){
            $Output2 = $Output2 .' AND loan.Drop_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = date("1-1-1");
            $SessionVars[] = $_SESSION["Loan-Date-To"];
            $total =  "WHERE loan.Drop_date BETWEEN '".date("1-1-1")."' AND '".$_SESSION["Loan-Date-To"]."'";
        }
        else{
            $Output2 = $Output2 .' AND loan.Drop_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Loan-Date-From"];
            $SessionVars[] = $_SESSION["Loan-Date-To"];
            $total = "WHERE loan.Drop_date BETWEEN '".$_SESSION["Loan-Date-From"]."' AND '".$_SESSION["Loan-Date-To"]."'";
        }
    }

    $loanstat = $_SESSION["Loan-Status"];
    if($_SESSION["Loan-Status"] != '%%'){ 
        if($_SESSION["Loan-Status"] == "Loaned") {
            $loanstat = " AND loan.Returned = 0 ";
        } else if($_SESSION["Loan-Status"] == "Returned") {
            $loanstat = " AND loan.Returned = 1 ";
        } else {
            $loanstat = '';
        }
    }

    if($_SESSION["User-Username"] != '%%'){ $Output2 = $Output2 .' AND Username LIKE ?'; $Variables = $Variables .'s'; $SessionVars[] = $_SESSION["User-Username"]; }

    // echo "Output: ".$Output."<br/";
    // echo "Output2: ".$Output2."<br/>";
    // echo "loanstat: ".$loanstat."<br/>";
    
    // echo $SessionVars[0]." to ".$SessionVars[1]."<br./>";
    // echo $SessionVars[2];
    // echo $total;

    // if(!empty($_SESSION["Limit"])){
    //     $Limitby = $_SESSION["Limit"];
    // }
?>

<head2><title>Loan Reports</title></head2>
    <div class="content">
        <head2> <title>Loan Reports</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css"></head2>
        <?php
                if(!empty($_GET['page'])){
                    $sortby = $_SESSION["sortbyorder"];
                    $sort = $_SESSION["sortorder"];
                    if($sort == 'ASC'){ $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>';}
                    else{ $icon = '<i><span class="material-icons-outlined">arrow_drop_down</span></i>';}
                }
        ?>
       <form class="admin-form">
            <h2 style = "text-align:center;">Loan Report</h2>
            <h4>Search by:</h4><br>
                
                <label class="admin-label">Item Type:</label>
                <input list="listType" name="type" placeholder="Type name..." class="admin-list"
                    <?php if($_SESSION["Report-IType"] != '%%'){$Value =  'value = "'.substr($_SESSION["Report-IType"], 0, 0).'"';echo $Value;}?>>
                        <datalist id="listType">
                        <?php
                            //Prevents duplicate entries from appearing in datalist
                            $DataArray = array_diff( $DataArray, $DataArray);
                            $sql = "SELECT * FROM itemtype";
                            if($result = mysqli_query($con,$sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp = $row['Type_name'];
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

                <label class="admin-label">Username:</label>
                    <input list="listUsername" name="Username" class="admin-list" placeholder="Username..."
                    <?php if($_SESSION["User-Username"] != '%%'){ $Value =  'value = "'.substr($_SESSION["User-Username"], 1, -1).'"'; echo $Value; } ?>>
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

                <label class="admin-label">Returns From:</label>
                    <input type="date" name="Date-From" class="admin-list"
                        <?php if(!empty($_SESSION["Loan-Date-From"])){ $Value =  'value = "' .$_SESSION["Loan-Date-From"].'"'; echo $Value; } ?>>
                    </input>
                    <label class="admin-label">To</label>
                    <input type="date" name="Date-To" class="admin-list"
                        <?php if(!empty($_SESSION["Loan-Date-To"])){ $Value =  'value = "' .$_SESSION["Loan-Date-To"].'"'; echo $Value; } ?>>
                    </input>
                
                <label class="admin-label">Loan Status:</label>
                <input list="listStatus" name="Status" placeholder="Status..." class="admin-list"
                    <?php if($_SESSION["Loan-Status"] != '%%'){ $Value =  'value = "'.substr($_SESSION["Loan-Status"], 0, 0).'"'; echo $Value; } ?>>
                    <datalist id="listStatus">
                    <?php
                            $DataArray = array_diff($DataArray, $DataArray);
                            $sql = "SELECT Reserve_status FROM reservation_status";
                            if($result = mysqli_query($con,$sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp = $row['Reserve_status'];
                                        if(!in_array($temp, $DataArray)){
                                            if($temp == "Loaned" || $temp = "Returned") {
                                                $DataArray[] = $temp;
                                                echo "<option>$temp</option>";
                                            }
                                        }
                                    }
                                }
                            }
                        ?>
                    </datalist>
                </input> <br><br>

            <!-- <label class="admin-label">Limit Results:</label>
                <input type="text" name="Limit" placeholder="#..." class="admin-list"
                    <?php if(!empty($_SESSION["Limit"])){$Value =  'value = "'.$_SESSION["Limit"].'"';echo $Value;}?>>
                </input><br><br> -->
            <div class="admin-button-line">     
                <label class="admin-button">
                    <button type="submit" name ="submit">Search</button>
                </label>
                <label class="admin-button">
                    <button type="submit" name ="reset">Reset</button>
                </label>    
            </div>
        </form>
        <div class="sum">
            <?php
                // $sql3 = "SELECT SUM(DATEDIFF(loan.Drop_date, loan.Loan_date)) as Days_Reserved
                // FROM loan ".$total;

                $sql3="SELECT SUM(DATEDIFF(loan.Drop_date, loan.Loan_date)+1) as Days_Reserved
                FROM loan
                INNER JOIN user on user.User_id = loan.User
                INNER JOIN item on item.Item_id = loan.Item 
                WHERE item".$Output." IS NOT NULL ".$Output2.$loanstat;

                //echo $sql3."<br/><br/>";

                $stmt3 = mysqli_stmt_init($con);

                if(!mysqli_stmt_prepare($stmt3,$sql3)){echo "SQL statement failed";}
                else{
                    if(!empty($Variables)){
                        //Pass an array for paremeters
                        mysqli_stmt_bind_param($stmt3, $Variables, ...$SessionVars);
                        mysqli_stmt_execute($stmt3);
                        $result3=mysqli_stmt_get_result($stmt3);  
                    }
                    else { 
                        $result3 = mysqli_query($con,$sql3);               
                    }

                    
                    $row3 = mysqli_fetch_assoc($result3);
                    $total = $row3["Days_Reserved"];

                    if(is_null($total)) {
                        $total = 0;
                    }

                    echo "<h2 style='text-align: center'>Total Days Reserved: ".$total."</h2><br/>";
                }
             ?>
        </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
        <table class = "content-table">
            <thread>

                <tr style = "font-size:18px;">
                    <th style = "width:1%;">#</th>
                    <th>Item ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Loan Date</th>
                    <th>Due Date</th>
                    <th>Dropoff Date</th>
                    <th>Days Reserved</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thread>
            <?php
                include '../connect.php';
                $NumResults = 0;
                $num = 0;
               
                //Set page value based on default or user -----------------------------------------------------------------------------
                if(!isset($_GET['page'])){$page = 1;}
                else{$page = $_GET['page'];}

                // $PageResults = $Limitby;
                // $NumOfPages = ceil($NumResults/$PageResults);
                // $FirstResult = ($page-1)*$PageResults;
                // $num = $FirstResult;
                $sql = "";
                $result = "";
                //Dynamic to receieve all data

                $sql = "SELECT item.Item_id,user.Username, loan.Returned, loan.Loan_date, loan.Return_date, loan.Drop_date, DATEDIFF(loan.Drop_date, loan.Loan_date) as Days_Reserved, COALESCE(book.Name, journal.Name, electronic.Model, disk.Name) AS name, COALESCE(book.Img, journal.Img, electronic.Img, disk.Img) AS Img, COALESCE(book.Description, journal.Description, electronic.Description, disk.Description) AS Description 
                FROM loan
                INNER JOIN item on item.Item_id = loan.Item
                LEFT JOIN book ON item.Book_id = book.Book_id
                LEFT JOIN journal ON item.Journal_id = journal.Journal_id
                LEFT JOIN disk ON item.Disk_id = disk.Disk_id
                LEFT JOIN electronic ON item.Electronic_id = electronic.Electronic_id
                INNER JOIN user on user.User_id = loan.User 
                WHERE item".$Output." IS NOT NULL ".$Output2.$loanstat." ORDER BY loan.Drop_date DESC";

                // $sql = $sql." LIMIT ".$Limitby;

                //echo $sql."<br/><br/>";

                $stmt = mysqli_stmt_init($con);

                if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                else{
                    if(!empty($Variables)){
                        //Pass an array for paremeters
                        mysqli_stmt_bind_param($stmt, $Variables, ...$SessionVars);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                    }
                    else{ $result = mysqli_query($con,$sql);}

                    $numres = 0;
                    if(mysqli_num_rows($result) > 0) {
                        $numres = mysqli_num_rows($result);
                    };

                    echo "<h2 style='text-align: center'>Total Reservations: ".$numres."</h2><br/>";

                if(!empty($result)){
                    while($row=mysqli_fetch_assoc($result)){
                    $Item = $row['Item_id'];
                    $Name = $row['name'];
                    $Username = $row['Username'];
                    $LoanStart = $row['Loan_date'];
                    $LoanDue = $row['Return_date'];
                    $LoanEnd = $row['Drop_date'];
                    $Days = $row['Days_Reserved'];
                    if(is_null($Days)) {
                        $Days = 0;
                    } else {
                        $Days = $Days + 1;
                    }

                    $Image = $row['Img'];
                    $Description = $row['Description'];
                    //Echo the table -----------------------------------------------------------------------------------------------------
                    $num += 1;

                    echo '
                    <tbody>
                        <tr id = '.$num.'>
                            <td id = "'.$num.'" onclick ="content()">
                                <s style="padding:5px 7px; border-radius: 5px;">'.$num.'</s>
                            </td>
                            <td id = "'.$num.'" onclick ="content()">
                                <b>'.$Item.'</b><br>
                            </td>
                            <td id = "'.$num.'" onclick ="content()">
                                <b>'.$Name.'</b><br>
                            </td>
                            <td id = "'.$num.'" onclick ="content()">
                                <b>'.$Username.'</b><br>
                            </td>
                
                            <td class = "admin-table-name" id = "'.$num.'" onclick ="content()">
                                <b style = "color: #3091C1; font-size: 18px;">'.$LoanStart.'</b><br>
                            </td>
                            <td class = "admin-table-name" id = "'.$num.'" onclick ="content()">
                                <b style = "color: red; font-size: 18px;">'.$LoanDue.'</b><br>
                            </td>
                            <td class = "admin-table-name" id = "'.$num.'" onclick ="content()">
                                <b style = "color: green; font-size: 18px;">'.$LoanEnd.'</b><br>
                            </td>
                            <td id = "'.$num.'" onclick ="content()">'.$Days.'</td>';

                    echo'
                        </tr>
                        <div class="modal" id="modal'.$num.'">
                            <div class="modal-header">
                                <div class="modal-body">
                                    <div class = "modal-body-text">
                                        <div style ="display:inline-block; text-align: center;"> 
                                            <div style = "color: rgba(0,0,0,.50); display:inline-block;"> 
                                                <b>Details</b> 
                                                <hr style="width:585px; border-color: rgba(0,0,0,.15); display:inline-block; position: relative; top: -3px;"> </hr>
                                            </div> <br><br>
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Item ID:</b> '.$Item.'
                                            </div><br>
                                            
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Item Name:</b> '.$Name.'
                                                <div class = "modal-body-image">
                                                <img src="../img/'.$Image.'" width=160 height=240 style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; border: 3px solid rgba(0,0,0,.25); border-radius: 5px;">
                                                </div>
                                            </div>


                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                            <b>Description:</b><br>
                                            <div style="margin-left: 10px;display:inline-block;"><small>'.$Description.'</small></div>
                                            </div><br>                                       
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Date Started:</b> '.$LoanStart.'
                                            </div><br>
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Date Due:</b> '.$LoanDue.'
                                            </div><br>
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Date Returned:</b> '.$LoanEnd.'
                                            </div><br>
                                            <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                <b>Days Reserved:</b> '.$Days.'
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
                // else {
                //     $NumOfPages = 0;
                // }
            }
            ?>
        </table> 
        <!-- <div class = "PageCount">
            <?php
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
            ?>
        </div> -->
    </div>
</section>
</div>
<script type="text/javascript" src="../modal.js"></script> 
<?php include_once '../footer.php';?>                        