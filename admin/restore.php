<?php include_once 'adminpanel.php'; 

    //Reset Search Fields
    if(isset($_REQUEST['reset'])){
        $_SESSION["Restore-Name"] = '%%';
        $_SESSION["Restore-Type"] = '%%';
        $_SESSION["Restore-Rental-From"] = '';
        $_SESSION["Restore-Rental-To"] = '';
        $_SESSION["Restore-Limit"] = '';
    }
    //Define Search Fields in Session
    if(isset($_REQUEST['submit'])){
        $_SESSION["Restore-Name"] = filter_var('%'.$_REQUEST["Name"].'%', FILTER_SANITIZE_STRING);
        $_SESSION["Restore-Type"] = filter_var('%'.$_REQUEST["Type"].'%', FILTER_SANITIZE_STRING);
        $Sanitize = preg_replace("/[^0-9]/", "", $_REQUEST['Rental-From']);
        $_SESSION["Restore-Rental-From"] = filter_var($Sanitize, FILTER_SANITIZE_NUMBER_INT);
        $Sanitize = preg_replace("/[^0-9]/", "", $_REQUEST['Rental-To']);
        $_SESSION["Restore-Rental-To"] = filter_var($Sanitize, FILTER_SANITIZE_NUMBER_INT);
        $Sanitize = preg_replace("/[^0-9]/", "", $_REQUEST['Limit']);
        $_SESSION["Restore-Limit"] = filter_var($Sanitize, FILTER_SANITIZE_NUMBER_INT);
    }
    //Define Session Variables Inititally
    if(empty($_SESSION["Restore-Name"])){$_SESSION["Restore-Name"] = '%%';}
    if(empty($_SESSION["Restore-Type"])){$_SESSION["Restore-Type"] = '%%';}
    if(empty($_SESSION["Restore-Rental-From"])){$_SESSION["Restore-Rental-From"] = '';}
    if(empty($_SESSION["Restore-Rental-To"])){$_SESSION["Restore-Rental-To"] = '';}
    if(empty($_SESSION["Restore-Limit"])){$_SESSION["Restore-Limit"] = '';}

    $DataArray = array();
    //Initialize Dynamic SQL Statements
    $BOutput = '';
    $JOutput = '';
    $DOutput = '';
    $EOutput = '';
    $UOutput = '';

    $Limitby = 10;
    //Could not figure out a way to work with a union that dont share many of the same values, so this is messy attempt to salvage
    if($_SESSION["Restore-Name"] != '%%'){ 
        $BOutput = $BOutput .' AND Name LIKE \'%'.$_SESSION["Restore-Name"].'%\'';
        $JOutput = $JOutput .' AND Name LIKE \'%'.$_SESSION["Restore-Name"].'%\'';
        $DOutput = $DOutput .' AND Name LIKE \'%'.$_SESSION["Restore-Name"].'%\'';
        $EOutput = $EOutput .' AND Name LIKE \'%'.$_SESSION["Restore-Name"].'%\'';
        $UOutput = $UOutput .' AND Username LIKE \'%'.$_SESSION["Restore-Name"].'%\''; 
    }
    if($_SESSION["Restore-Type"] != '%%'){ 
        $BOutput = $BOutput .' AND itemtype.Type_name LIKE \'%'.$_SESSION["Restore-Type"].'%\'';
        $JOutput = $JOutput .' AND itemtype.Type_name LIKE \'%'.$_SESSION["Restore-Type"].'%\'';
        $DOutput = $DOutput .' AND itemtype.Type_name LIKE \'%'.$_SESSION["Restore-Type"].'%\'';
        $EOutput = $EOutput .' AND itemtype.Type_name LIKE \'%'.$_SESSION["Restore-Type"].'%\'';
    }
    if(!empty($_SESSION["Restore-Rental-From"]) || !empty($_SESSION["Restore-Rental-To"])){
        if(!empty($_SESSION["Restore-Rental-From"]) && empty($_SESSION["Restore-Rental-To"])){
            $BOutput = $BOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND 1000000000';
            $JOutput = $JOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND 1000000000';
            $DOutput = $DOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND 1000000000';
            $EOutput = $EOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND 1000000000';
            $UOutput = $UOutput .' AND Current_Orders BETWEEN '.$_SESSION["Restore-Rental-From"].' AND 1000000000';
        }
        elseif(empty($_SESSION["Restore-Rental-From"]) && !empty($_SESSION["Restore-Rental-To"])){
            $BOutput = $BOutput .' AND Rental_status BETWEEN 1 AND '.$_SESSION["Restore-Rental-To"].'';
            $JOutput = $JOutput.' AND Rental_status BETWEEN 1 AND '.$_SESSION["Restore-Rental-To"].'';
            $DOutput = $DOutput .' AND Rental_status BETWEEN 1 AND '.$_SESSION["Restore-Rental-To"].'';
            $EOutput = $EOutput .' AND Rental_status BETWEEN 1 AND '.$_SESSION["Restore-Rental-To"].'';
            $UOutput = $UOutput .' AND Current_Orders BETWEEN 1 AND '.$_SESSION["Restore-Rental-To"].'';
        }
        else{
            $BOutput = $BOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND '.$_SESSION["Restore-Rental-To"].'';
            $JOutput = $JOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND '.$_SESSION["Restore-Rental-To"].'';
            $DOutput = $DOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND '.$_SESSION["Restore-Rental-To"].'';
            $EOutput = $EOutput .' AND Rental_status BETWEEN '.$_SESSION["Restore-Rental-From"].' AND '.$_SESSION["Restore-Rental-To"].'';
            $UOutput = $UOutput .' AND Current_Orders BETWEEN '.$_SESSION["Restore-Rental-From"].' AND '.$_SESSION["Restore-Rental-To"].'';
        }
    }
    
    if(!empty($_SESSION["Restore-Limit"])){ $Limitby = $_SESSION["Restore-Limit"];}

?>
        <div class="content">
            <head2> <title>Restore</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css"> </head2>
            <?php
                if(isset($_REQUEST['success'])){
                    $Success = $_REQUEST['success'];
                    echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Your restoration was successful</h4>';
                }
            ?>
    
            <form class="admin-form">
                <h2 style = "text-align:center;">Restore Items</h2>
                <h4>Search by:</h4><br>

                <label class="admin-label">Type:</label>
                <input list="listType" class="admin-list" name="Type" placeholder="Type..." 
                    <?php if($_SESSION["Restore-Type"] != '%%'){
                            $Value =  'value = "'.substr($_SESSION["Restore-Type"], 1, -1).'"'; echo $Value;}
                    ?>>
                    <datalist id="listType">
                        <?php
                            //Prevents duplicate entries from appearing in datalist
                            $DataArray = array_diff( $DataArray, $DataArray);
                            $sql = "SELECT Type_name AS Type FROM itemtype UNION SELECT 'User' AS Type From user"; 
                            if($result = mysqli_query($con,$sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp = $row['Type'];
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

                <label class="admin-label">Name:</label>
                <input list="listName" class="admin-list" name="Name" placeholder="Name..." 
                    <?php if($_SESSION["Restore-Name"] != '%%'){
                            $Value =  'value = "'.substr($_SESSION["Restore-Name"], 1, -1).'"'; echo $Value;}
                    ?>>
                    <datalist id="listName">
                        <?php
                            //Prevents duplicate entries from appearing in datalist
                            $DataArray = array_diff( $DataArray, $DataArray);
                            $sql = "SELECT Name AS Name FROM book WHERE Deleted_id = 1 UNION
                                    SELECT Name AS Name FROM journal Where Deleted_id = 1 UNION
                                    SELECT Name AS Name FROM disk WHERE Deleted_id = 1 UNION
                                    SELECT Name AS Name FROM electronic WHERE Deleted_id = 1 UNION
                                    SELECT Username AS Name FROM user WHERE Deleted_id = 1"; 
                            if($result = mysqli_query($con,$sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $temp = $row['Name'];
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
            
                <label class="admin-label">Rental Amount From:</label> 
                <input type="text" class="admin-text" name="Rental-From" placeholder="#..."
                    <?php 
                        if(!empty($_SESSION["Restore-Rental-From"])){ $Value =  'value = "'.$_SESSION["Restore-Rental-From"].'"'; echo $Value;}
                    ?>>
                </input>
                <label class="admin-label">To</label>
                <input type="text" class="admin-text" name="Rental-To" placeholder="#..."
                    <?php 
                        if(!empty($_SESSION["Restore-Rental-To"])){ $Value =  'value = "'.$_SESSION["Restore-Rental-To"].'"'; echo $Value;}
                    ?>>
                </input>

                <br><br>
                <label class="admin-label">Limit Results:</label>
                <input type="text" class="admin-text" name="Limit" placeholder="#..."
                    <?php 
                        if(!empty($_SESSION["Restore-Limit"])){ $Value =  'value = "'.$_SESSION["Restore-Limit"].'"'; echo $Value;}
                    ?>>
                </input> 
                <br>
                <div class="admin-button-line">
                    <label class="admin-button">
                        <button type="submit" name ="reset">Reset</button>
                    </label>   
                    <label class="admin-button">
                        <button type="submit" name ="submit">Search</button>
                    </label>
                </div>      
            </form>

            <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
            <?php

                if(!empty($_GET['sort'])){
                    $_SESSION["sortbyorder"] = $_GET['sort'];
                    $sortby = $_GET['sort'];
                    if(strpos($_SESSION["sortorder"], 'ASC') !== false){ $_SESSION["sortorder"] = 'DESC'; $icon = '<i><span class="material-icons-outlined">arrow_drop_down</span></i>'; $sort = 'DESC';}
                    else{ $_SESSION["sortorder"] = 'ASC'; $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>'; $sort = 'ASC';}
                }
                elseif(!empty($_GET['page'])){
                    $sortby = $_SESSION["sortbyorder"];
                    $sort = $_SESSION["sortorder"];
                    if($sort == 'ASC'){ $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>';}
                    else{ $icon = '<i><span class="material-icons-outlined">arrow_drop_down</span></i>';}
                }
                else{
                    $_SESSION["sortbyorder"] = 'ID';
                    $sortby = 'ID';
                    $_SESSION["sortorder"] = 'ASC'; 
                    $sort = 'ASC';
                    $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>'; 
                }
                ?>
                <table class = "content-table">
                    <thread>
                        <tr>
                            <th style = "width:1%;">#</th>
                            <th onclick="location.href='?sort=Type';" onmouseover="" style="cursor: pointer;">Type
                                <?php if($sortby == 'Type'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=ID';" onmouseover="" style="cursor: pointer;">ID
                                <?php if($sortby == 'ID'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Name';" onmouseover="" style="cursor: pointer;">Name
                                <?php if($sortby == 'Name'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Rental';" onmouseover="" style="cursor: pointer;">Rental
                                <?php if($sortby == 'Rental'){echo $icon;}?>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thread>
                <?php
                    $sql = '';
                    $NumResults = 0;
                    $num = 0;


                    //Get Page Count -----------------------------------------------------------------------------
                    $sql = "SELECT * FROM book INNER JOIN itemtype ON itemtype.Type_id = book.Reference_type WHERE Deleted_id = 1 $BOutput";
                    $result = mysqli_query($con,$sql);
                    $NumResults = $NumResults + mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0){$SelBooks = 1;}

                    $sql = "SELECT * FROM journal INNER JOIN itemtype ON itemtype.Type_id = journal.Reference_type WHERE Deleted_id = 1 $JOutput";
                    $result = mysqli_query($con,$sql);
                    $NumResults = $NumResults + mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0){$SelJournals = 1;}

                    $sql = "SELECT * FROM disk INNER JOIN itemtype ON itemtype.Type_id = disk.Reference_type WHERE Deleted_id = 1 $DOutput";
                    $result = mysqli_query($con,$sql);
                    $NumResults = $NumResults + mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0){$SelDisks= 1;}

                    $sql = "SELECT * FROM electronic INNER JOIN itemtype ON itemtype.Type_id = electronic.Reference_type WHERE Deleted_id = 1 $EOutput";
                    $result = mysqli_query($con,$sql);
                    $NumResults = $NumResults + mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0){$SelElectronics = 1;}

                    $sql = "SELECT *, 'User' AS Type FROM user WHERE Deleted_id = 1 $UOutput";
                    $result = mysqli_query($con,$sql);
                    $NumResults = $NumResults + mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0 ){$SelUsers = 1;}
                    //Workaround for some values of the Union not being real
                    if ($_SESSION["Restore-Type"] != "%User%" && $_SESSION["Restore-Type"] != '%%'){$SelUsers = '';}
                    if ($_SESSION["Restore-Type"] == 'User'){$SelUsers = 1;}

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
                    //Union Add Parts -----------------------------------------------------------------------------
                    if(!empty($SelBooks)) {
                        $sql ="SELECT book.Book_id AS ID, book.Name AS Name, book.Rental_status AS Rental, book.Reference_type, itemtype.Type_name AS Type
                                FROM book 
                                INNER JOIN itemtype ON itemtype.Type_id = book.Reference_type
                                WHERE book.Deleted_id=1 $BOutput";
                    }
                    if(!empty($SelJournals)) {
                        if(!empty($sql)){ $sql = $sql ." UNION "; }
                        $sql = $sql ."SELECT journal.Journal_id AS ID, journal.Name AS Name, journal.Rental_status AS Rental, journal.Reference_type, itemtype.Type_name AS Type
                                        FROM journal
                                        INNER JOIN itemtype ON itemtype.Type_id = journal.Reference_type
                                        WHERE journal.Deleted_id=1 $JOutput";
                    }
                    if(!empty($SelDisks)) {
                        if(!empty($sql)){ $sql = $sql ." UNION "; }
                        $sql = $sql ."SELECT disk.Disk_id AS ID, disk.Name AS Name, disk.Rental_status AS Rental, disk.Reference_type, itemtype.Type_name AS Type
                                        FROM disk
                                        INNER JOIN itemtype ON itemtype.Type_id = disk.Reference_type
                                        WHERE disk.Deleted_id=1 $DOutput";
                    }
                    if(!empty($SelElectronics)) {
                        if(!empty($sql)){ $sql = $sql ." UNION "; }
                        $sql = $sql ."SELECT electronic.Electronic_id AS ID, electronic.Name AS Name, electronic.Rental_status AS Rental, electronic.Reference_type, itemtype.Type_name AS Type
                                        FROM electronic
                                        INNER JOIN itemtype ON itemtype.Type_id = electronic.Reference_type
                                        WHERE Deleted_id=1 $EOutput";
                    }
                    if(!empty($SelUsers)) {
                        if(!empty($sql)){ $sql = $sql ." UNION "; }
                        $sql = $sql ."SELECT user.User_id AS ID, user.Username AS Name, user.Current_Orders AS Rental, 1 AS RefType, 'User' AS Type
                                        FROM user 
                                        WHERE Deleted_id=1 $UOutput";
                    }
                    if(!empty($sql)){ $sql = $sql ." ORDER BY $sortby $sort LIMIT $FirstResult, $PageResults"; }
                    //Run the sql statement ----------------------------------------------------------------------------------------             
                    if(!empty($sql)){
                        $stmt = mysqli_stmt_init($con);
                        if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                        else{$result = mysqli_query($con,$sql);}
                    }
                    if(!empty($result)){
                        while($row=mysqli_fetch_assoc($result)){
                        $ID = $row['ID'];
                        $Name = $row['Name'];
                        $Rental = $row['Rental'];
                        $Type = $row['Type'];
                        $sql2="SELECT * FROM $Type WHERE $Type.Deleted_id=1 AND $Type.$Type'_id' = $ID";
                        //Echo the table -----------------------------------------------------------------------------------------------------
                        $num += 1;
                        echo '
                        <tbody>
                            <tr id = '.$num.'>
                                <td id = "'.$num.'" onclick ="content()">
                                    <s style="padding:5px 7px; border-radius: 5px;">'.$num.'</s>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">
                                    <b>'.$Type.'</b><br>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">'.$ID.'</td>
                                <td class = "admin-table-name" id = "'.$num.'" onclick ="content()">
                                    <b style = "color: #3091C1; font-size: 18px;">'.$Name.'</b><br>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">'.$Rental.'</td>
                                <td id = "'.$num.'" onclick ="content()">
                                    <button class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: #38B023; font-size: 18px;">Restore</button><br>
                                </td>
                            </tr>
                            <div class="modal" id="modal'.$num.'">
                                <div class="modal-header">
                                    <div class="title">Confirm Restore of: '.$Name.'</div>
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
                                                    <b>Type:</b> '.$Type.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>ID:</b> '.$ID.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Name:</b> '.$Name.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Rental Amount:</b> '.$Rental.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; max-width: 460px; margin-left:37%">
                                                    <button type="button" class = "button-reserve" style="font-size: 25px;" onclick="location.href=\''.$Type.'/restore?restoreid='.$ID.'\'">Restore Now</button>
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