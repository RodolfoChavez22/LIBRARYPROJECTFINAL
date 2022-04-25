<?php 
    include_once 'adminpanel.php'; 
    //Reset Search Fields
    if(isset($_REQUEST['reset'])){
        $_SESSION["User-Fname"] = '%%';
        $_SESSION["User-Lname"] = '%%';
        $_SESSION["User-Email"] = '%%';
        $_SESSION["User-Username"] = '%%';
        $_SESSION["User-Mobile"] = '%%';
        $_SESSION["User-Loan-From"] = '';
        $_SESSION["User-Loan-To"] = '';
        $_SESSION["User-Balance-From"] = '';
        $_SESSION["User-Balance-To"] = '';
        $_SESSION["User-Status"] = '';
        $_SESSION["User-Date-From"]= '';
        $_SESSION["User-Date-To"] = '';
        $_SESSION["Limit"] = '';
    }

    //Define Search Fields in Session
    if(isset($_REQUEST['submit'])){
        $_SESSION["User-Fname"] = '%'.$_REQUEST["Fname"].'%';
        $_SESSION["User-Lname"] = '%'.$_REQUEST["Lname"].'%';
        $_SESSION["User-Email"] = '%'.$_REQUEST["Email"].'%';
        $_SESSION["User-Username"] = '%'.$_REQUEST["Username"].'%';
        $_SESSION["User-Mobile"] = '%'.$_REQUEST["Mobile"].'%';
        $_SESSION["User-Loan-From"] = $_REQUEST["Loan-From"];
        $_SESSION["User-Loan-To"] = $_REQUEST["Loan-To"];
        $_SESSION["User-Balance-From"] = $_REQUEST["Balance-From"];
        $_SESSION["User-Balance-To"] = $_REQUEST["Balance-To"];
        $_SESSION["User-Status"] = '%'.$_REQUEST["Status"].'%';
        $_SESSION["User-Date-From"]= $_REQUEST['Date-From'];
        $_SESSION["User-Date-To"] = $_REQUEST['Date-To'];
        $_SESSION["Limit"] = $_REQUEST['Limit'];
    }

    //Define Session Variables Inititally
    if(empty($_SESSION["User-Fname"])){$_SESSION["User-Fname"] = '%%';}
    if(empty($_SESSION["User-Lname"])){$_SESSION["User-Lname"] = '%%';}
    if(empty($_SESSION["User-Email"])){$_SESSION["User-Email"] = '%%';}
    if(empty($_SESSION["User-Username"])){$_SESSION["User-Username"] = '%%';}
    if(empty($_SESSION["User-Mobile"])){$_SESSION["User-Mobile"] = '%%';}
    if(empty($_SESSION["User-Loan-From"])){$_SESSION["User-Loan-From"] = '';} 
    if(empty($_SESSION["User-Loan-To"])){$_SESSION["User-Loan-To"] = '';}
    if(empty($_SESSION["User-Balance-From"])){$_SESSION["User-Balance-From"] = '';}
    if(empty($_SESSION["User-Balance-To"])){$_SESSION["User-Balance-To"] = '';}
    if(empty($_SESSION["User-Status"])){$_SESSION["User-Status"] = '%%';}
    if(empty($_SESSION["User-Date-From"])){$_SESSION["User-Date-From"] = '';}
    if(empty($_SESSION["User-Date-To"])){$_SESSION["User-Date-To"] = '';}
    if(empty($_SESSION["Limit"])){$_SESSION["Limit"] = '';}

    //Initialize Dynamic SQL Statements
    $Output = '';
    $Variables = '';
    $SessionVars = array();
    $Limitby = '10';

    //Initialize Datalist entries for duplicates
    $DataArray = array();

    //Build Dynamic SQL Statements
    if($_SESSION["User-Fname"] != '%%'){ $Output = $Output .' AND Fname LIKE ?'; $Variables = $Variables .'s'; $SessionVars[] = $_SESSION["User-Fname"]; }
    if($_SESSION["User-Lname"] != '%%'){ $Output = $Output .' AND Lname LIKE ?'; $Variables = $Variables .'s'; $SessionVars[] = $_SESSION["User-Lname"]; }
    if($_SESSION["User-Email"] != '%%'){ $Output = $Output .' AND Email LIKE ?'; $Variables = $Variables .'s'; $SessionVars[] = $_SESSION["User-Email"]; }
    if($_SESSION["User-Username"] != '%%'){ $Output = $Output .' AND Username LIKE ?'; $Variables = $Variables .'s'; $SessionVars[] = $_SESSION["User-Username"]; }
    if($_SESSION["User-Mobile"] != '%%'){ $Output = $Output .' AND Pnumber LIKE ?'; $Variables = $Variables .'s'; $SessionVars[] = $_SESSION["User-Mobile"]; }
    if($_SESSION["User-Status"] != '%%'){ $Output = $Output .' AND User_Status LIKE ?'; $Variables = $Variables .'s'; $SessionVars[] = $_SESSION["User-Status"]; }
    //If the user only inputs olny one entry in a to-from, autocomplete it to search for a single exact entry
    if(!empty($_SESSION["User-Loan-From"]) || !empty($_SESSION["User-Loan-To"])){
        if(!empty($_SESSION["User-Loan-From"]) && empty($_SESSION["User-Loan-To"])){
            $Output = $Output .' AND Current_orders BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["User-Loan-From"];
            $SessionVars[] = '1000000000';
        }
        elseif(empty($_SESSION["User-Loan-From"]) && !empty($_SESSION["User-Loan-To"])){
            $Output = $Output .' AND Current_orders BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = '1';
            $SessionVars[] = $_SESSION["User-Loan-To"];
        }
        else{
            $Output = $Output .' AND Current_orders BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["User-Loan-From"];
            $SessionVars[] = $_SESSION["User-Loan-To"];
        }
    }
    if(!empty($_SESSION["User-Balance-From"]) || !empty($_SESSION["User-Balance-To"])){
        if(!empty($_SESSION["User-Balance-From"]) && empty($_SESSION["User-Balance-To"])){
            $Output = $Output .' AND Balance BETWEEN ? AND 1000000';
            $Variables = $Variables .'i';
            $SessionVars[] = $_SESSION["User-Balance-From"];
        }
        elseif(empty($_SESSION["User-Balance-From"]) && !empty($_SESSION["User-Balance-To"])){
            $Output = $Output .' AND Balance BETWEEN 1 AND ?';
            $Variables = $Variables .'i';
            $SessionVars[] = $_SESSION["User-Balance-To"];  
        }
        else{
            $Output = $Output .' AND Balance BETWEEN ? AND ?';
            $Variables = $Variables .'ii';
            $SessionVars[] = $_SESSION["User-Balance-From"];
            $SessionVars[] = $_SESSION["User-Balance-To"];   
        }
    }

    if(!empty($_SESSION["User-Date-From"]) || !empty($_SESSION["User-Date-To"])){
        if(!empty($_SESSION["User-Date-From"]) && empty($_SESSION["User-Date-To"])){
            $Output = $Output .' AND DOB BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["User-Date-From"];
            $SessionVars[] = date("Y-m-d");
        }
        elseif(empty($_SESSION["User-Date-From"]) && !empty($_SESSION["User-Date-To"])){
            $Output = $Output .' AND DOB BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = date("1-1-1");
            $SessionVars[] = $_SESSION["User-Date-To"];
        }
        else{
            $Output = $Output .' AND DOB BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["User-Date-From"];
            $SessionVars[] = $_SESSION["User-Date-To"];
        }
    }
    if(!empty($_SESSION["Limit"])){
        $Limitby = $_SESSION["Limit"];
    }
?>
        <div class="content">
            <head2> <title>Users</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css"></head2>
            <?php
                if(isset($_REQUEST['update'])){
                    echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Entry updated successfully</h4>';
                }
                if(isset($_REQUEST['delete'])){
                    echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Deletion was successfull</h4>';
                }
                if(isset($_REQUEST['add'])){
                    echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Entry was added successfully</h4>';
                }
            ?>
            <button class="add-item" style="margin-bottom: 1%;"onclick="location.href='user/add';">
                Add User
            </button>
            <form class="admin-form">
                <h2 style = "text-align:center;">Users</h2>
                <h4>Search by:</h4><br>
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
                        $_SESSION["sortbyorder"] = 'User_id';
                        $sortby = 'User_id';
                        $_SESSION["sortorder"] = 'ASC'; 
                        $sort = 'ASC';
                        $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>'; 
                    }
                ?>
                <label class="admin-lable">First Name:</label>
                    <input list="listFname" name="Fname" class="admin-list" placeholder="First name..." 
                    <?php if($_SESSION["User-Fname"] != '%%'){ $Value =  'value = "'.substr($_SESSION["User-Fname"], 1, -1).'"'; echo $Value; }?>>
                        <datalist id="listFname">
                            <?php
                                //Prevents duplicate entries from appearing in datalist
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT Fname, Deleted_id FROM user WHERE Deleted_id = 0";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Fname'];
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
                <label class="admin-label">Last Name:</label>
                    <input list="listLname" name="Lname" class="admin-list" placeholder="Last name..."
                    <?php if($_SESSION["User-Lname"] != '%%'){ $Value =  'value = "'.substr($_SESSION["User-Lname"], 1, -1).'"'; echo $Value; } ?>>
                        <datalist id="listLname">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT Lname, Deleted_id FROM user WHERE Deleted_id = 0";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Lname'];
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
                <label class="admin-label">Email:</label>
                    <input list="listEmail" name="Email" class="admin-list" placeholder="Email..."
                    <?php if($_SESSION["User-Email"] != '%%'){ $Value =  'value = "'.substr($_SESSION["User-Email"], 1, -1).'"'; echo $Value; }?>>
                        <datalist id="listEmail">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT Email, Deleted_id FROM user WHERE Deleted_id = 0";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Email'];
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
                    </input> 
                <label class="admin-label">Phone Number:</label>
                    <input list="listMobile" name="Mobile" class="admin-list" placeholder="Mobile..."
                    <?php if($_SESSION["User-Mobile"] != '%%'){ $Value =  'value = "'.substr($_SESSION["User-Mobile"], 1, -1).'"'; echo $Value; } ?>>
                        <datalist id="listMobile">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT Pnumber, Deleted_id FROM user WHERE Deleted_id = 0";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Pnumber'];
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
                <label class="admin-label">Balance From:</label>
                    <input type="text" name="Balance-From" placeholder = '#...' class="admin-text"
                         <?php if(!empty($_SESSION["User-Balance-From"])){ $Value =  'value = "' .$_SESSION["User-Balance-From"].'"'; echo $Value; } ?>>
                    </input>
                <label class="admin-label">To</label>
                    <input type="text" name="Balance-To" placeholder = '#...' class="admin-text"
                        <?php if(!empty($_SESSION["User-Balance-To"])){ $Value =  'value = "' .$_SESSION["User-Balance-To"].'"'; echo $Value; } ?>>
                    </input><br><br>                
                <label class="label-space">Date of Birth From:</label>
                    <input type="date" name="Date-From" class="admin-text"
                        <?php if(!empty($_SESSION["User-Date-From"])){ $Value =  'value = "' .$_SESSION["User-Date-From"].'"'; echo $Value; } ?>>
                    </input>
                <label class="admin-label">To</label>
                    <input type="date" name="Date-To" class="admin-text"
                        <?php if(!empty($_SESSION["User-Date-To"])){ $Value =  'value = "' .$_SESSION["User-Date-To"].'"'; echo $Value; } ?>>
                    </input>
                <label class="label-space" style = "margin-left: 2%;">Loans From:</label>
                    <input type="text" name="Loan-From" placeholder = '#...' class="admin-text"
                        <?php if(!empty($_SESSION["User-Loan-From"])){ $Value =  'value = "' .$_SESSION["User-Loan-From"].'"'; echo $Value; } ?>>
                    </input>
                <label class="admin-label">To</label>
                    <input type="text" name="Loan-To" placeholder = '#...' class="admin-text"
                        <?php if(!empty($_SESSION["User-Loan-To"])){ $Value =  'value = "' .$_SESSION["User-Loan-To"].'"'; echo $Value; } ?>>
                    </input>
                <label class="admin-label">Role:</label>
                    <input list="listStatus" name="Status" class="admin-list" placeholder="Role..." style="width:8%;"
                    <?php if($_SESSION["User-Status"] != '%%'){ $Value =  'value = "'.substr($_SESSION["User-Status"], 1, -1).'"'; echo $Value; } ?>>
                        <datalist id="listStatus">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT User_Status, Deleted_id FROM user WHERE Deleted_id = 0";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['User_Status'];
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
                <label class="admin-label" style = "margin-left: 2%;">Limit Results:</label>
                    <input type="text" name="Limit" placeholder="#..." class="admin-text" style = "width: 6%;"
                        <?php if(!empty($_SESSION["Limit"])){ $Value =  'value = "'.$_SESSION["Limit"].'"'; echo $Value;} ?>>
                </input>  <br><br>
                <div class="admin-button-line">
                    <label class="admin-button">
                        <button type="submit" name ="submit">Search</button>
                    </label>
                    <label class="admin-button">
                        <button type="submit" name ="reset">Reset</button>
                    </label>
                </div>        
            </form>
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">           
                <table class = "content-table">
                    <thread>
                        <tr style = "font-size:18px;">
                            <th style = "width:1%;">#</th>
                            <th onclick="location.href='?sort=User_id';" onmouseover="" style="cursor: pointer;">ID
                                <?php if($sortby == 'User_id'){echo $icon;}?>
                            </th> 
                            <th onclick="location.href='?sort=Fname';" onmouseover="" style="cursor: pointer;">First Name
                                <?php if($sortby == 'Fname'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Lname';" onmouseover="" style="cursor: pointer;">Last Name
                                <?php if($sortby == 'Lname'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Username';" onmouseover="" style="cursor: pointer;">Username
                                <?php if($sortby == 'Username'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Email';" onmouseover="" style="cursor: pointer;">Email
                                <?php if($sortby == 'Email'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Pnumber';" onmouseover="" style="cursor: pointer;">Mobile
                                <?php if($sortby == 'Pnumber'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Current_orders';" onmouseover="" style="cursor: pointer;">Current Loans
                                <?php if($sortby == 'Current_orders'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=Balance';" onmouseover="" style="cursor: pointer;">Balance
                                <?php if($sortby == 'Balance'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=User_Status';" onmouseover="" style="cursor: pointer;">Role
                                <?php if($sortby == 'User_Status'){echo $icon;}?>
                            </th>
                            <th onclick="location.href='?sort=DOB';" onmouseover="" style="cursor: pointer;">DOB
                                <?php if($sortby == 'DOB'){echo $icon;}?>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thread>
                <?php
                    $sql = '';
                    $NumResults = 0;
                    $num = 0;

                    //Get Page Count -----------------------------------------------------------------------------
                    $sql = "SELECT * FROM user WHERE Deleted_id = 0 $Output";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "SQL statement failed";
                    }
                    else{
                        if(!empty($Variables)){
                            //Pass an array for paremeters
                            mysqli_stmt_bind_param($stmt, $Variables, ...$SessionVars);
                            mysqli_stmt_execute($stmt);
                            $result=mysqli_stmt_get_result($stmt);
                        }
                        else{ $result = mysqli_query($con,$sql); }
                    }
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

                    //Run the sql statement ----------------------------------------------------------------------------------------             
                    include '../connect.php';
                    //Dynamic SQL Statement
                    $sql="SELECT *
                            FROM user
                            WHERE Deleted_id=0 $Output
                            ORDER BY $sortby $sort
                            LIMIT $FirstResult, $PageResults";
                    //Prepared Statement to prevent SQL Injection
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo "SQL statement failed";
                    }
                    else{
                        if(!empty($Variables)){
                            //Pass an array for paremeters
                            mysqli_stmt_bind_param($stmt, $Variables, ...$SessionVars);
                            mysqli_stmt_execute($stmt);
                            $result=mysqli_stmt_get_result($stmt);
                        }
                        else{ $result = mysqli_query($con,$sql); }
    
                        while($row=mysqli_fetch_assoc($result)){
                            $ID=$row['User_id'];
                            $Fname=$row['Fname'];
                            $Lname=$row['Lname'];
                            $Email=$row['Email'];
                            $Username=$row['Username'];
                            $Mobile=$row['Pnumber'];
                            $Loans=$row['Current_orders'];
                            $Balance=$row['Balance'];
                            $Role=$row['User_Status'];
                            if($Role == 'user'){$MaxLoans = '/3';}
                            else{$MaxLoans = '/5';}
                            $DOB=$row['DOB'];
                            $Created=$row['Created'];
                        //Echo the table -----------------------------------------------------------------------------------------------------
                        $num += 1;
                        echo '
                        <tbody>
                            <tr id = '.$num.'>
                                <td id = "'.$num.'" onclick ="content()">
                                    <s style="padding:5px 7px; border-radius: 5px;">'.$num.'</s>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">
                                    <b>'.$ID.'</b><br>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">'.$Fname.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Lname.'</td>
                                <td id = "'.$num.'" onclick ="content()">
                                    <b style = "color: #3091C1; font-size: 18px;">'.$Username.'</b><br>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">'.$Email.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Mobile.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Loans.''.$MaxLoans.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Balance.'</td>
                                <td id = "'.$num.'" onclick ="content()">
                                    <b style = "color: #3091C1; font-size: 18px;">'.$Role.'</b><br>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">'.$DOB.'</td>
                                <td id = "'.$num.'" onclick ="content()">
                                    <button class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: #38B023; font-size: 18px;">Change</button><br>
                                </td>
                            </tr>

                            <div class="modal" id="modal'.$num.'">
                                <div class="modal-header">
                                    <div class="title">'.$Username.'</div>
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
                                                    <b>ID:</b> '.$ID.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Name:</b> '.$Fname.' '.$Lname.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Username:</b> '.$Username.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Email:</b> '.$Email.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Date of Birth:</b> '.$DOB.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Phone:</b> '.$Mobile.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Balance:</b> $'.$Balance.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Current Loans:</b> '.$Loans.''.$MaxLoans.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Role:</b> '.$Role.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 20px; max-width: 460px;">
                                                    <b>Date Created:</b> '.$Created.'
                                                </div><br><br>
                                                <div style = "display:inline-block; margin: 5px auto; max-width: 460px; margin-left:25%">
                                                    <button type="button" class = "button-reserve" style="font-size: 25px;" onclick="location.href=\'user/update?userid='.$ID.'\'">Update User</button>
                                                    <button type="button" class = "button-delete" style="font-size: 25px;" onclick="location.href=\'user/delete?deleteid='.$ID.'\'">Delete User</button>
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