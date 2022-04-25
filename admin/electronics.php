<?php 
    include_once 'adminpanel.php'; 
    //Reset Search Fields
    if(isset($_REQUEST['reset'])){
        $_SESSION["Electronic-Type"] = '%%';
        $_SESSION["Electronic-Model"] = '%%';
        $_SESSION["Electronic-Brand"] = '%%';
        $_SESSION["Electronic-Rental-To"] = '';
        $_SESSION["Electronic-Rental-From"] = '';
        $_SESSION["Electronic-Date-From"] = '';
        $_SESSION["Electronic-Date-To"] = '';
        $_SESSION["Limit"] = '';
    }
    
    //Define Search Fields in Session
    if(isset($_REQUEST['submit'])){
        $_SESSION["Electronic-Type"] = '%'.$_REQUEST["Type"].'%';
        $_SESSION["Electronic-Model"] = '%'.$_REQUEST["Model"].'%';
        $_SESSION["Electronic-Brand"] = '%'.$_REQUEST["Brand"].'%';
        $_SESSION["Electronic-Rental-From"] = $_REQUEST["Rental-From"];
        $_SESSION["Electronic-Rental-To"] = $_REQUEST["Rental-To"];
        $_SESSION["Electronic-Date-From"] = $_REQUEST["Date-From"];
        $_SESSION["Electronic-Date-To"] = $_REQUEST["Date-To"];
        $_SESSION["Limit"] = $_REQUEST['Limit'];
    }

    //Define Session Variables Inititally
    if(empty($_SESSION["Electronic-Type"])){$_SESSION["Electronic-Type"] = '%%';}
    if(empty($_SESSION["Electronic-Model"])){$_SESSION["Electronic-Model"] = '%%';}
    if(empty($_SESSION["Electronic-Brand"])){$_SESSION["Electronic-Brand"] = '%%';}
    if(empty($_SESSION["Electronic-Rental-To"])){$_SESSION["Electronic-Rental-To"] = '';}
    if(empty($_SESSION["Electronic-Rental-From"])){$_SESSION["Electronic-Rental-From"] = '';}
    if(empty($_SESSION["Electronic-Date-From"])){$_SESSION["Electronic-Date-From"] = '';}
    if(empty($_SESSION["Electronic-Date-To"])){$_SESSION["Electronic-Date-To"] = '';}
    if(empty($_SESSION["Limit"])){$_SESSION["Limit"] = '';}

    //Initialize Dynamic SQL Statements
    $Output = '';
    $Variables = '';
    $SessionVars = array();
    $Limitby = '10';

    //Initialize Datalist entries for duplicates
    $DataArray = array();

    //Build Dynamic SQL Statements
    if($_SESSION["Electronic-Type"] != '%%'){
        $Output = $Output .' AND Electronic_type LIKE ?';
        $Variables = $Variables .'s';
        $SessionVars[] = $_SESSION["Electronic-Type"];
    }
    if($_SESSION["Electronic-Model"] != '%%'){
        $Output = $Output .' AND Model LIKE ?';
        $Variables = $Variables .'s';
        $SessionVars[] = $_SESSION["Electronic-Model"];
    }
    if($_SESSION["Electronic-Brand"] != '%%'){
        $Output = $Output .' AND Brand_name LIKE ?';
        $Variables = $Variables .'s';
        $SessionVars[] = $_SESSION["Electronic-Brand"];
    }

    //If the electronic only inputs olny one entry in a to-from, autocomplete it to search for a single exact entry
    if(!empty($_SESSION["Electronic-Rental-From"]) || !empty($_SESSION["Electronic-Rental-To"])){
        if(!empty($_SESSION["Electronic-Rental-From"]) && empty($_SESSION["Electronic-Rental-To"])){
            $Output = $Output .' AND Rental_status BETWEEN ? AND 1000000';
            $Variables = $Variables .'s';
            $SessionVars[] = $_SESSION["Electronic-Rental-From"];
        }
        elseif(empty($_SESSION["Electronic-Rental-From"]) && !empty($_SESSION["Electronic-Rental-To"])){
            $Output = $Output .' AND Rental_status BETWEEN 1 AND ?';
            $Variables = $Variables .'s';
            $SessionVars[] = $_SESSION["Electronic-Rental-To"];
        }
        else{
            $Output = $Output .' AND Rental_status BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Electronic-Rental-From"];
            $SessionVars[] = $_SESSION["Electronic-Rental-To"];
        }
    }
    if(!empty($_SESSION["Electronic-Date-From"]) || !empty($_SESSION["Electronic-Date-To"])){
        if(!empty($_SESSION["Electronic-Date-From"]) && empty($_SESSION["Electronic-Date-To"])){
            $Output = $Output .' AND Release_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Electronic-Date-From"];
            $SessionVars[] = date("Y-m-d");
        }
        elseif(empty($_SESSION["Electronic-Date-From"]) && !empty($_SESSION["Electronic-Date-To"])){
            $Output = $Output .' AND Release_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = date("1-1-1");
            $SessionVars[] = $_SESSION["Electronic-Date-To"];
        }
        else{
            $Output = $Output .' AND Release_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Electronic-Date-From"];
            $SessionVars[] = $_SESSION["Electronic-Date-To"];
        }
    }
    if(!empty($_SESSION["Limit"])){
        $Limitby = $_SESSION["Limit"];
    }
?>
        <div class="content">
            <head2> <title>Electronics</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css"></head2>
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
            <button class="add-item" onclick="location.href='electronic/add';">
                Add Electronic
            </button>
            <button class="add-item" style="margin-bottom: 1%;"  onclick="location.href='key/type';">Add Type</button>
            <button class="add-item" style="margin-bottom: 1%;" onclick="location.href='key/brand';">Add Brand</button>
            <form class="admin-form">
                <h2 style = "text-align:center;">Electronics</h2>
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
                        $_SESSION["sortbyorder"] = 'Electronic_id';
                        $sortby = 'Electronic_id';
                        $_SESSION["sortorder"] = 'ASC'; 
                        $sort = 'ASC';
                        $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>'; 
                    }
                ?>
                <label class="admin-label">Type:</label>
                    <input list="listType" name="Type" placeholder="Type..." class="admin-list"
                    <?php 
                        if($_SESSION["Electronic-Type"] != '%%'){ $Value =  'value = "'.substr($_SESSION["Electronic-Type"], 1, -1).'"'; echo $Value; } ?>>
                        <datalist id="listType">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT * FROM etype";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Electronic_type'];
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
                <label class="admin-label">Model:</label>
                    <input list="listLModel" name="Model" placeholder="Model..." class="admin-list"
                    <?php if($_SESSION["Electronic-Model"] != '%%'){ $Value =  'value = "'.substr($_SESSION["Electronic-Model"], 1, -1).'"'; echo $Value; } ?>>
                        <datalist id="listLModel">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT Model, Deleted_id FROM electronic WHERE Deleted_id = 0";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Model'];
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


                <label class="admin-label">Brand:</label>
                    <input list="listBrand" name="Brand" placeholder="Brand..." class="admin-list"
                    <?php if($_SESSION["Electronic-Brand"] != '%%'){ $Value =  'value = "'.substr($_SESSION["Electronic-Brand"], 1, -1).'"'; echo $Value; } ?>>
                        <datalist id="listBrand">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT * FROM brand";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Brand_name'];
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
                
                <label class="admin-label">Realeased From:</label>
                    <input type="date" name="Date-From" class="admin-list"
                        <?php if(!empty($_SESSION["Electronic-Date-From"])){ $Value =  'value = "' .$_SESSION["Electronic-Date-From"].'"'; echo $Value; } ?>>
                    </input>
                    <label class="admin-label">To</label>
                    <input type="date" name="Date-To" class="admin-list"
                        <?php if(!empty($_SESSION["Electronic-Date-To"])){ $Value =  'value = "' .$_SESSION["Electronic-Date-To"].'"'; echo $Value; } ?>>
                    </input>
                <br><br><label class="admin-label">Rental Amount From:</label>
                    <input type="text" name="Rental-From" placeholder = '#...' class="admin-list"
                         <?php if(!empty($_SESSION["Electronic-Rental-From"])){ $Value =  'value = "' .$_SESSION["Electronic-Rental-From"].'"'; echo $Value; } ?>>
                    </input>
                    <label class="admin-label">To</label>
                    <input type="text" name="Rental-To" placeholder = '#...' class="admin-list"
                        <?php if(!empty($_SESSION["Electronic-Rental-To"])){ $Value =  'value = "' .$_SESSION["Electronic-Rental-To"].'"'; echo $Value; } ?>>
                    </input>
                <label class="admin-label">Limit Results:</label>
                <input type="text" name="Limit" placeholder="#..." class="admin-list"
                    <?php 
                        if(!empty($_SESSION["Limit"])){ $Value =  'value = "'.$_SESSION["Limit"].'"'; echo $Value; } ?>>
                </input><br> <br>   
                <div class="admin-button-line">                   
                    <label class="admin-button">
                        <button type="submit" name ="submit">Search</button>
                    </label>
                    <label class="admin-button">
                        <button type="submit" name ="reset">Reset</button>
                    </label><br><br>      
                </div> 
            </form>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">           
        <table class = "content-table">
            <thread>
                <tr style = "font-size:18px;">
                    <th style = "width:1%;">#</th>
                    <th onclick="location.href='?sort=Electronic_id';" onmouseover="" style="cursor: pointer;">ID
                        <?php if($sortby == 'Electronic_id'){echo $icon;}?>
                    </th>
                    <th onclick="location.href='?sort=Name';" onmouseover="" style="cursor: pointer;">Name
                        <?php if($sortby == 'Name'){echo $icon;}?>
                    </th>
                    <th onclick="location.href='?sort=Type';" onmouseover="" style="cursor: pointer;">Type
                        <?php if($sortby == 'Type'){echo $icon;}?>
                    </th>
                    <th onclick="location.href='?sort=Model';" onmouseover="" style="cursor: pointer;">Model
                        <?php if($sortby == 'Model'){echo $icon;}?>
                    </th>
                    <th onclick="location.href='?sort=Brand';" onmouseover="" style="cursor: pointer;">Brand
                        <?php if($sortby == 'Brand'){echo $icon;}?>
                    </th>
                    <th onclick="location.href='?sort=Rental_status';" onmouseover="" style="cursor: pointer;">Rental
                        <?php if($sortby == 'Rental_status'){echo $icon;}?>
                    </th>
                    <th onclick="location.href='?sort=Release_date';" onmouseover="" style="cursor: pointer;">Released
                        <?php if($sortby == 'Release_date'){echo $icon;}?>
                    </th>
                    <th>Actions</th>
                </tr>
            </thread>

                <?php
                    $sql = '';
                    $NumResults = 0;
                    $num = 0;

                    //Get Page Count -----------------------------------------------------------------------------
                    $sql="SELECT electronic.Electronic_id, electronic.Type, electronic.Model, electronic.Brand, electronic.Rental_status, electronic.Release_date, electronic.Name,
                                electronic.Img, etype.ET_id, etype.Electronic_type, brand.Brand_id, brand.Brand_name
                                FROM electronic
                                INNER JOIN etype ON etype.ET_id = electronic.Type
                                INNER JOIN brand ON brand.Brand_id = electronic.Brand
                                WHERE Deleted_id=0 $Output";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){ echo "SQL statement failed"; }
                    else{
                        if(!empty($Variables)){
                            //Pass an array for paremeters
                            mysqli_stmt_bind_param($stmt, $Variables, ...$SessionVars);
                            mysqli_stmt_execute($stmt);
                            $result=mysqli_stmt_get_result($stmt);
                        }
                        else{ $result = mysqli_query($con,$sql);}
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
                    $sql="SELECT electronic.Electronic_id, electronic.Type, electronic.Model, electronic.Brand, electronic.Rental_status, electronic.Release_date, electronic.Name,
                                electronic.Img, etype.ET_id, etype.Electronic_type, brand.Brand_id, brand.Brand_name
                            FROM electronic
                            INNER JOIN etype ON etype.ET_id = electronic.Type
                            INNER JOIN brand ON brand.Brand_id = electronic.Brand
                            WHERE Deleted_id=0 $Output
                            ORDER BY $sortby $sort
                            LIMIT $FirstResult, $PageResults";
                //Prepared Statement to prevent SQL Injection
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){ echo "SQL statement failed"; }
                else{
                    if(!empty($Variables)){
                        //Pass an array for paremeters
                        mysqli_stmt_bind_param($stmt, $Variables, ...$SessionVars);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                    }
                    else{ $result = mysqli_query($con,$sql);}
    
                    while($row=mysqli_fetch_assoc($result)){
                        $ID=$row['Electronic_id'];
                        $Name=$row['Name'];
                        $Type=$row['Electronic_type'];
                        $Model=$row['Model'];
                        $Brand=$row['Brand_name'];
                        $Rental=$row['Rental_status'];
                        $Released=$row['Release_date'];
                        $Img=$row['Img'];
                        
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
                                <td id = "'.$num.'" onclick ="content()">
                                    <b style = "color: #3091C1; font-size: 18px;">'.$Name.'</b><br>
                                </td>
                                <td id = "'.$num.'" onclick ="content()">'.$Type.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Model.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Brand.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Rental.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Released.'</td>
                                <td id = "'.$num.'" onclick ="content()">
                                    <button class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: #38B023; font-size: 18px;">Change</button><br>
                                </td>
                            </tr>
                            <div class="modal" id="modal'.$num.'">
                                <div class="modal-header">
                                    <div class="title">'.$Name.'</div>
                                        <button data-close-button class="close-button">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class = "modal-body-image" style = "display:inline-block;">
                                            <img src="../img/'.$Img.'" width=160 height=240 style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; border: 3px solid rgba(0,0,0,.25); border-radius: 5px;">
                                        </div>
                                        <div class = "modal-body-text">
                                            <div style ="display:inline-block;"> 
                                                <div style = "color: rgba(0,0,0,.50); display:inline-block;"> 
                                                    <b>Details</b> 
                                                    <hr style="width:400px; border-color: rgba(0,0,0,.15); display:inline-block; position: relative; top: -3px;"> </hr>
                                                </div> <br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Name:</b> '.$Name.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Type:</b> '.$Type.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Brand:</b> '.$Brand.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Released:</b> '.$Released.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Available Copies:</b> '.$Rental.'
                                                </div><br><br>
                                                <div style = "display:inline-block; margin: 5px auto; max-width: 460px;">
                                                    <button type="button" class = "button-reserve" style="font-size: 25px;" onclick="location.href=\'electronic/update?electronicid='.$ID.'\'">Update Item</button>
                                                    <button type="button" class = "button-delete" style="font-size: 25px;" onclick="location.href=\'electronic/delete?deleteid='.$ID.'\'">Delete Item</button>
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