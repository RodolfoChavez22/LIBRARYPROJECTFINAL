<?php
    include_once 'adminpanel.php';
    //Reset Search Fields
    if(isset($_REQUEST['reset'])){
        $_SESSION["Journal-Name"] = '%%';
        $_SESSION["Journal-AuthorFirst"] = '%%';
        $_SESSION["Journal-AuthorLast"] = '%%';
        $_SESSION["Journal-Genre"] = '%%';
        $_SESSION["Journal-ISSN"] = '%%';
        $_SESSION["Journal-Publisher"] = '%%';
        $_SESSION["Journal-Date-From"]= '';
        $_SESSION["Journal-Date-To"] = '';
        $_SESSION["Journal-Rental-From"] = '';
        $_SESSION["Journal-Rental-To"] = '';
        $_SESSION["Journal-Pages-From"] = '';
        $_SESSION["Journal-Pages-To"] = '';
        $_SESSION["Limit"] = '';
    }
    
    //Define Search Fields in Session
    if(isset($_REQUEST['submit'])){
        $_SESSION["Journal-Name"] = '%'.$_REQUEST["Name"].'%';
        $_SESSION["Journal-AuthorFirst"] = '%'.$_REQUEST["AuthorFirst"].'%';
        $_SESSION["Journal-AuthorLast"] = '%'.$_REQUEST["AuthorLast"].'%';
        $_SESSION["Journal-Genre"] = '%'.$_REQUEST["Genre"].'%';
        $_SESSION["Journal-ISSN"] = '%'.$_REQUEST["ISSN"].'%';
        $_SESSION["Journal-Publisher"] = '%'.$_REQUEST["Publisher"].'%';
        $_SESSION["Journal-Date-From"]= $_REQUEST['Date-From'];
        $_SESSION["Journal-Date-To"] = $_REQUEST['Date-To'];
        $_SESSION["Journal-Rental-From"] = $_REQUEST['Rental-From'];
        $_SESSION["Journal-Rental-To"] = $_REQUEST['Rental-To'];
        $_SESSION["Journal-Pages-From"] = $_REQUEST['Pages-From'];
        $_SESSION["Journal-Pages-To"] = $_REQUEST['Pages-To'];
        $_SESSION["Limit"] = $_REQUEST['Limit'];
    }

    //Define Session Variables Inititally
    if(empty($_SESSION["Journal-Name"])){$_SESSION["Journal-Name"] = '%%';}
    if(empty($_SESSION["Journal-AuthorFirst"])){$_SESSION["Journal-AuthorFirst"] = '%%';}
    if(empty($_SESSION["Journal-AuthorLast"])){$_SESSION["Journal-AuthorLast"] = '%%';}
    if(empty($_SESSION["Journal-Genre"])){$_SESSION["Journal-Genre"] = '%%';}
    if(empty($_SESSION["Journal-ISSN"])){$_SESSION["Journal-ISSN"] = '%%';}
    if(empty($_SESSION["Journal-Publisher"])){$_SESSION["Journal-Publisher"] = '%%';}
    if(empty($_SESSION["Journal-Date-From"])){$_SESSION["Journal-Date-From"] = '';}
    if(empty($_SESSION["Journal-Date-To"])){$_SESSION["Journal-Date-To"] = '';}
    if(empty($_SESSION["Journal-Rental-From"])){$_SESSION["Journal-Rental-From"] = '';}
    if(empty($_SESSION["Journal-Rental-To"])){$_SESSION["Journal-Rental-To"] = '';}
    if(empty($_SESSION["Journal-Pages-From"])){$_SESSION["Journal-Pages-From"] = '';}
    if(empty($_SESSION["Journal-Pages-To"])){$_SESSION["Journal-Pages-To"] = '';}
    if(empty($_SESSION["Limit"])){$_SESSION["Limit"] = '';}

    //Initialize Dynamic SQL Statements
    $Output = '';
    $Variables = '';
    $SessionVars = array();
    $OutputGenre = '';
    $VariablesGenre = '';
    $SessionVarsGenre = array();
    $OutputAuthor = '';
    $VariablesAuthor = '';
    $SessionVarsAuthor = array();
    $Limitby = '10';
    //Initialize Datalist entries for duplicates
    $DataArray = array();

    //Build Dynamic SQL Statements
    if($_SESSION["Journal-Name"] != '%%'){
        $Output = $Output .' AND Name LIKE ?';
        $Variables = $Variables .'s';
        $SessionVars[] = $_SESSION["Journal-Name"];
    }
    if($_SESSION["Journal-AuthorFirst"] != '%%'){
        if($_SESSION["Journal-AuthorLast"] != '%%'){
            $OutputAuthor = $OutputAuthor .' HAVING GROUP_CONCAT(author.FName) LIKE ? AND GROUP_CONCAT(author.LName) LIKE ?';
            $VariablesAuthor = $VariablesAuthor .'ss';
            $SessionVarsAuthor[] = $_SESSION["Journal-AuthorFirst"];
            $SessionVarsAuthor[] = $_SESSION["Journal-AuthorLast"];
        }
        else{
            $OutputAuthor = $OutputAuthor .' HAVING GROUP_CONCAT(author.FName) LIKE ?';
            $VariablesAuthor = $VariablesAuthor .'s';
            $SessionVarsAuthor[] = $_SESSION["Journal-AuthorFirst"];
        }
    }
    if($_SESSION["Journal-AuthorLast"] != '%%'){
        if($_SESSION["Journal-AuthorFirst"] == '%%'){
            $OutputAuthor = $OutputAuthor .' HAVING GROUP_CONCAT(author.LName) LIKE ?';
            $VariablesAuthor = $VariablesAuthor .'s';
            $SessionVarsAuthor[] = $_SESSION["Journal-AuthorLast"];
        }
    }
    if($_SESSION["Journal-Genre"] != '%%'){
        $OutputGenre = $OutputGenre .' HAVING GROUP_CONCAT(genre.Genre_type) LIKE ?';
        $VariablesGenre = $VariablesGenre .'s';
        $SessionVarsGenre[] = $_SESSION["Journal-Genre"];
    }
    if($_SESSION["Journal-ISSN"] != '%%'){
        $Output = $Output .' AND ISSN LIKE ?';
        $Variables = $Variables .'s';
        $SessionVars[] = $_SESSION["Journal-ISSN"];
    }
    if($_SESSION["Journal-Publisher"] != '%%'){
        $Output = $Output .' AND Publisher_name LIKE ?';
        $Variables = $Variables .'s';
        $SessionVars[] = $_SESSION["Journal-Publisher"];
    }
    //If the user only inputs olny one entry in a to-from, autocomplete it to search for a single exact entry
    if(!empty($_SESSION["Journal-Date-From"]) || !empty($_SESSION["Journal-Date-To"])){
        if(!empty($_SESSION["Journal-Date-From"]) && empty($_SESSION["Journal-Date-To"])){
            $Output = $Output .' AND Publish_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Journal-Date-From"];
            $SessionVars[] = date("Y-m-d");
        }
        elseif(empty($_SESSION["Journal-Date-From"]) && !empty($_SESSION["Journal-Date-To"])){
            $Output = $Output .' AND Publish_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = date("1-1-1");
            $SessionVars[] = $_SESSION["Journal-Date-To"];
        }
        else{
            $Output = $Output .' AND Publish_date BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Journal-Date-From"];
            $SessionVars[] = $_SESSION["Journal-Date-To"];
        }
    }
    if(!empty($_SESSION["Journal-Rental-From"]) || !empty($_SESSION["Journal-Rental-To"])){
        if(!empty($_SESSION["Journal-Rental-From"]) && empty($_SESSION["Journal-Rental-To"])){
            $Output = $Output .' AND Rental_status BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Journal-Rental-From"];
            $SessionVars[] = '1000000000';
        }
        elseif(empty($_SESSION["Journal-Rental-From"]) && !empty($_SESSION["Journal-Rental-To"])){
            $Output = $Output .' AND Rental_status BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = '1';
            $SessionVars[] = $_SESSION["Journal-Rental-To"];
        }
        else{
            $Output = $Output .' AND Rental_status BETWEEN ? AND ?';
            $Variables = $Variables .'ss';
            $SessionVars[] = $_SESSION["Journal-Rental-From"];
            $SessionVars[] = $_SESSION["Journal-Rental-To"];
        }
    }
    if(!empty($_SESSION["Journal-Pages-From"]) || !empty($_SESSION["Journal-Pages-To"])){
        if(!empty($_SESSION["Journal-Pages-From"]) && empty($_SESSION["Journal-Pages-To"])){
            $Output = $Output .' AND Pages BETWEEN ? AND ?';
            $Variables = $Variables .'ii';
            $SessionVars[] = $_SESSION["Journal-Pages-From"];
            $SessionVars[] = '1000000000';
        }
        elseif(empty($_SESSION["Journal-Pages-From"]) && !empty($_SESSION["Journal-Pages-To"])){
            $Output = $Output .' AND Pages BETWEEN ? AND ?';
            $Variables = $Variables .'ii';
            $SessionVars[] = '1';
            $SessionVars[] = $_SESSION["Journal-Pages-To"];
        }
        else{
            $Output = $Output .' AND Pages BETWEEN ? AND ?';
            $Variables = $Variables .'ii';
            $SessionVars[] = $_SESSION["Journal-Pages-From"];
            $SessionVars[] = $_SESSION["Journal-Pages-To"];
        }
    }
    if(!empty($_SESSION["Limit"])){
        $Limitby = $_SESSION["Limit"];
    }
?>

<head2><title>Books</title></head2>
    <div class="content">
        <head2> <title>Journals</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css"></head2>
        <?php if(isset($_REQUEST['update'])){ echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Entry updated successfully</h4>'; }
                if(isset($_REQUEST['delete'])){ echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Deletion was successfull</h4>'; }
                if(isset($_REQUEST['add'])){ echo '<h4 style = "width: 100%; border-round: 10px;" class = "success">Entry was added successfully</h4>';}
        ?>
        <button class="add-item" style = "margin-bottom: 1%;" onclick="location.href='journal/add';">Add Journal</button>
        <button class="add-item" style = "margin-bottom: 1%;" onclick="location.href='key/author';">Add Author</button>
        <button class="add-item" style = "margin-bottom: 1%;" onclick="location.href='key/genre';">Add Genre</button>
        <button class="add-item" style = "margin-bottom: 1%;" onclick="location.href='key/publisher';">Add Publisher</button>
        <form class="admin-form">
            <h2 style = "text-align:center;">Journals</h2>
            <h4>Search by:</h4><br>
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
                    $_SESSION["sortbyorder"] = 'journal.Journal_id';
                    $sortby = 'journal.Journal_id';
                    $_SESSION["sortorder"] = 'ASC'; 
                    $sort = 'ASC';
                    $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>'; 
                }
            ?>
            <label class="admin-label">Name:</label>
                <input list="listName" name="Name" placeholder="Journal name..." class="admin-list"
                    <?php if($_SESSION["Journal-Name"] != '%%'){$Value =  'value = "'.substr($_SESSION["Journal-Name"], 1, -1).'"';echo $Value;}?>>
                        <datalist id="listName">
                        <?php
                            //Prevents duplicate entries from appearing in datalist
                            $DataArray = array_diff( $DataArray, $DataArray);
                            $sql = "SELECT Name, Deleted_id FROM journal WHERE Deleted_id = 0";
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
            <label class="admin-label">Author:</label>
                <input list="listAuthorFirst" name="AuthorFirst" placeholder="First name..." style="width:10%;" class="admin-list"
                <?php if($_SESSION["Journal-AuthorFirst"] != '%%'){$Value =  'value = "'.substr($_SESSION["Journal-AuthorFirst"], 1, -1).'"';echo $Value;}?>>
                        <datalist id="listAuthorFirst">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT FName FROM author";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['FName'];
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

                <input list="listAuthorLast" name="AuthorLast" placeholder="Last name..." style="width:10%;" class="admin-list"
                <?php if($_SESSION["Journal-AuthorLast"] != '%%'){$Value =  'value = "'.substr($_SESSION["Journal-AuthorLast"], 1, -1).'"';echo $Value;}?>>
                        <datalist id="listAuthorLast">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT LName FROM author";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['LName'];
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

            <label class="admin-label">Genre:</label>
                    <input list="listGenre" name="Genre" placeholder="Genre type..." style="width:10%;" class="admin-list"
                    <?php if($_SESSION["Journal-Genre"] != '%%'){$Value =  'value = "'.substr($_SESSION["Journal-Genre"], 1, -1).'"';echo $Value;}?>>
                        <datalist id="listGenre">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT Genre_type FROM genre";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Genre_type'];
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

            <label class="admin-label">ISSN:</label>
            <input list="listISSN" name="ISSN" placeholder="ISSN #..." style="width:10%;" class="admin-list"
            <?php if($_SESSION["Journal-ISSN"] != '%%'){$Value =  'value = "'.substr($_SESSION["Journal-ISSN"], 1, -1).'"';echo $Value;}?>>
                <datalist id="listISSN">
                    <?php
                        $DataArray = array_diff( $DataArray, $DataArray);
                        $sql = "SELECT ISSN, Deleted_id FROM journal WHERE Deleted_id = 0";
                        if($result = mysqli_query($con,$sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $temp = $row['ISSN'];
                                    if(!in_array($temp, $DataArray)){
                                        $DataArray[] = $temp;
                                        echo "<option>$temp</option>";
                                    }
                                }
                            }
                        }
                    ?>
                </datalist>
            </input>   <br><br>                 

            <label class="admin-label">Publisher:</label>
                <input list="listPublisher" name="Publisher" placeholder="Publisher name..." class="admin-list"
                    <?php if($_SESSION["Journal-Publisher"] != '%%'){$Value =  'value = "'.substr($_SESSION["Journal-Publisher"], 1, -1).'"';echo $Value;}?>>
                        <datalist id="listPublisher">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT Publisher_name FROM publisher";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Publisher_name'];
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

            <label class="label-space">Page Count From:</label>
                <input type="text" name="Pages-From" placeholder="#..." class="admin-list"
                    <?php if(!empty($_SESSION["Journal-Pages-From"])){$Value =  'value = "'.$_SESSION["Journal-Pages-From"].'"';echo $Value;}?>>
                </input>
            <label class="admin-label">To</label>
                <input type="text" name="Pages-To" placeholder="#..." class="admin-list"
                    <?php if(!empty($_SESSION["Journal-Pages-To"])){$Value =  'value = "'.$_SESSION["Journal-Pages-To"].'"';echo $Value;}?>>
                </input><br><br> 
            <label class="admin-label">Published From:</label>
                <input type="date" name="Date-From" class="admin-list"
                    <?php if(!empty($_SESSION["Journal-Date-From"])){$Value =  'value = "'.$_SESSION["Journal-Date-From"].'"';echo $Value;}?>>
                </input>
            <label class="admin-label">To</label>
                <input type="date" name="Date-To" class="admin-list"
                    <?php if(!empty($_SESSION["Journal-Date-To"])){$Value =  'value = "'.$_SESSION["Journal-Date-To"].'"';echo $Value;}?>>
                </input><br><br>
            <label class="label-space">Rental Amount From:</label>
                <input type="text" name="Rental-From" placeholder="#..." class="admin-list"
                    <?php if(!empty($_SESSION["Journal-Rental-From"])){$Value =  'value = "'.$_SESSION["Journal-Rental-From"].'"';echo $Value;}?>>
                </input>
            <label class="admin-label">To</label>
                <input type="text" name="Rental-To" placeholder="#..." class="admin-list"
                    <?php if(!empty($_SESSION["Journal-Rental-To"])){$Value =  'value = "'.$_SESSION["Journal-Rental-To"].'"';echo $Value;}?>>
                </input>
            <label class="admin-label">Limit Results:</label>
                <input type="text" name="Limit" placeholder="#..." class="admin-list"
                    <?php if(!empty($_SESSION["Limit"])){$Value =  'value = "'.$_SESSION["Limit"].'"';echo $Value;}?>>
                </input><br><br>
            <div class="admin-button-line">     
                <label class="admin-button">
                    <button type="submit" name ="submit">Search</button>
                </label>
                <label class="admin-button">
                    <button type="submit" name ="reset">Reset</button>
                </label>    
            </div>
        </form>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
        <table class = "content-table">
            <thread>
                <tr style = "font-size:18px;">
                    <th style = "width:1%;">#</th>
                    <th onclick="location.href='?sort=journal.Journal_id';" onmouseover="" style="cursor: pointer;">ID <?php if($sortby == 'journal.Journal_id'){echo $icon;}?></th>
                    <th onclick="location.href='?sort=Name';" onmouseover="" style="cursor: pointer;">Name<?php if($sortby == 'Name'){echo $icon;}?></th>
                    <th onclick="location.href='?sort=ISSN';" onmouseover="" style="cursor: pointer;">ISSN<?php if($sortby == 'ISSN'){echo $icon;}?></th>
                    <th onclick="location.href='?sort=Pages';" onmouseover="" style="cursor: pointer;">Volumes<?php if($sortby == 'Pages'){echo $icon;}?></th>
                    <th onclick="location.href='?sort=Publisher';" onmouseover="" style="cursor: pointer;">Publisher<?php if($sortby == 'Publisher'){echo $icon;}?></th>
                    <th onclick="location.href='?sort=Publish_date';" onmouseover="" style="cursor: pointer;">Published<?php if($sortby == 'Publish_date'){echo $icon;}?></th>
                    <th onclick="location.href='?sort=Rental_status';" onmouseover="" style="cursor: pointer;">Rental<?php if($sortby == 'Rental_status'){echo $icon;}?></th>
                    <th>Actions</th>
                </tr>
            </thread>
            <?php
                include '../connect.php';
                $sql = '';
                $NumResults = 0;
                $num = 0;
                $Genre = '';
                //Dynamic to receieve all data
                $sql="SELECT journal.Journal_id, journal.Name, journal.Rental_status, journal.ISSN, journal.Pages, journal.Publisher, journal.Publish_date, journal.Deleted_id,
                            publisher.Publisher_id, publisher.Publisher_name,
                            author.Author_id, GROUP_CONCAT(author.FName), GROUP_CONCAT(author.LName), authorjournaljoin.Author_id, authorjournaljoin.Journal_id
                            FROM journal
                            INNER JOIN publisher ON journal.Publisher = publisher.Publisher_id
                            INNER JOIN authorjournaljoin ON journal.Journal_id = authorjournaljoin.Journal_id 
                            INNER JOIN author ON authorjournaljoin.Author_id = author.Author_id
                            WHERE journal.Deleted_id=0 $Output
                            GROUP BY journal.Journal_id
                            $OutputAuthor
                            ORDER BY $sortby $sort";

                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                else{
                    $Variables = $Variables . $VariablesAuthor;
                    $SessionVars = array_merge($SessionVars,$SessionVarsAuthor);
                    if(!empty($Variables)){
                        //Pass an array for paremeters
                        mysqli_stmt_bind_param($stmt, $Variables, ...$SessionVars);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                    }
                    else{$result = mysqli_query($con,$sql);}
                }
                $NumResults = $NumResults + mysqli_num_rows($result);
                if(!isset($_GET['page'])){$page = 1;}
                else{$page = $_GET['page'];}
                $PageResults = $Limitby;
                $NumOfPages = ceil($NumResults/$PageResults);
                $FirstResult = ($page-1)*$PageResults;
                $num = $FirstResult;
                $sql = "";
                $result = "";
                //Dynamic to receieve all data
                $sql="SELECT journal.Journal_id, journal.Name, journal.Rental_status, journal.ISSN, journal.Pages, journal.Publisher, journal.Publish_date, journal.Deleted_id,
                            publisher.Publisher_id, publisher.Publisher_name, journal.Img,
                            author.Author_id, GROUP_CONCAT(author.FName), GROUP_CONCAT(author.LName), authorjournaljoin.Author_id, authorjournaljoin.Journal_id
                            FROM journal
                            INNER JOIN publisher ON journal.Publisher = publisher.Publisher_id
                            INNER JOIN authorjournaljoin ON journal.Journal_id = authorjournaljoin.Journal_id 
                            INNER JOIN author ON authorjournaljoin.Author_id = author.Author_id
                            WHERE journal.Deleted_id=0 $Output
                            GROUP BY journal.Journal_id
                            $OutputAuthor
                            ORDER BY $sortby $sort
                            LIMIT $FirstResult, $PageResults";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                else{
                    if(!empty($Variables)){
                    //Pass an array for paremeters
                    mysqli_stmt_bind_param($stmt, $Variables, ...$SessionVars);
                    mysqli_stmt_execute($stmt);
                    $result=mysqli_stmt_get_result($stmt);
                    }
                    else{$result = mysqli_query($con,$sql);}
                }
                while($row=mysqli_fetch_assoc($result)){
                    $ID = $row['Journal_id'];
                    $Name = $row['Name'];
                    $ISSN = $row['ISSN'];
                    $Pages = $row['Pages'];
                    $Publisher = $row['Publisher_name'];
                    $Published = $row['Publish_date'];
                    $Rental = $row['Rental_status'];
                    $Img = $row['Img'];
                    $sql2="SELECT journal.Journal_id, journal.Deleted_id,
                                publisher.Publisher_id, publisher.Publisher_name,
                                genre.Genre_id, GROUP_CONCAT(genre.Genre_type), genrejournaljoin.Genre_id, genrejournaljoin.Journal_id
                                FROM journal
                                INNER JOIN publisher ON journal.Publisher = publisher.Publisher_id
                                INNER JOIN genrejournaljoin ON journal.Journal_id = genrejournaljoin.Journal_id 
                                INNER JOIN genre ON genrejournaljoin.Genre_id = genre.Genre_id
                                WHERE journal.Deleted_id=0 AND journal.Journal_id = $ID
                                GROUP BY journal.Journal_id
                                $OutputGenre
                                ORDER BY  $sortby $sort";
                     $stmt2 = mysqli_stmt_init($con);
                     if(!mysqli_stmt_prepare($stmt2,$sql2)){echo "SQL statement failed";}
                     else{
                         if(!empty($VariablesGenre)){
                             //Pass an array for paremeters
                             mysqli_stmt_bind_param($stmt2, $VariablesGenre, ...$SessionVarsGenre);
                             mysqli_stmt_execute($stmt2);
                             $result2=mysqli_stmt_get_result($stmt2);
                         }
                         else{$result2 = mysqli_query($con,$sql2);}
                     }
                     while($row2=mysqli_fetch_assoc($result2)){ $Genre = $row2['GROUP_CONCAT(genre.Genre_type)'];}                       
                     $Flist = explode(',', $row['GROUP_CONCAT(author.FName)']);
                     $Llist = explode(',', $row['GROUP_CONCAT(author.LName)']);
                     $FullName = '';
                     $ListName = '';
                     for($x = 0; $x < sizeof($Flist); $x+=1){
                         $FullName = $FullName . $Flist[$x] .' '. $Llist[$x] . '<br> ';
                         $ListName = $ListName . $Flist[$x] .' '. $Llist[$x] . ', ';
                     }
                     $FullName = trim($FullName);
                     $FullName = substr($FullName, 0, -1);
                     $ListName = trim($ListName);
                     $ListName = substr($ListName, 0, -1);
                     if($Genre != ''){
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
                                <td id = "'.$num.'" onclick ="content()">'.$ISSN.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Pages.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Publisher.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Published.'</td>
                                <td id = "'.$num.'" onclick ="content()">'.$Rental.'</td>
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
                                                    <b>Authors:</b> '.$ListName.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Genre:</b> '.$Genre.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>ISBN:</b> '.$ISSN.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Publisher:</b> '.$Publisher.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Published:</b> '.$Published.'
                                                </div><br>
                                                <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                    <b>Available Copies:</b> '.$Rental.'
                                                </div><br><br>
                                                <div style = "display:inline-block; margin: 5px auto; max-width: 460px;">
                                                    <button type="button" class = "button-reserve" style="font-size: 25px;" onclick="location.href=\'journal/update?journalid='.$ID.'\'">Update Item</button>
                                                    <button type="button" class = "button-delete" style="font-size: 25px;" onclick="location.href=\'journal/delete?deleteid='.$ID.'\'">Delete Item</button>
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
                $Genre = '';          
            ?>
        </table>
        <div class = "PageCount">
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
        </div>
    </div>
</section>
</div>
<script type="text/javascript" src="../modal.js"></script> 
<?php include_once '../footer.php';?>                        