<?php
    include_once 'header.php';
    //Reset Search Fields
    if(isset($_REQUEST['resetcatalog'])){
        $_SESSION["Catalog-Title"] = '';
        $_SESSION["Catalog-Author"] = '';
        $_SESSION["Catalog-ISBN"] = '';
        $_SESSION["Catalog-Publisher"] = '';
        $_SESSION["Catalog-Date-From"]= '';
        $_SESSION["Catalog-Date-To"] = '';
    }
    
    //Define Search Fields in Session
    if(isset($_REQUEST['submitcatalog'])){
        $_SESSION["Catalog-Title"] = $_REQUEST["Title"];
        $_SESSION["Catalog-Author"] = $_REQUEST["Author"];
        $_SESSION["Catalog-ISBN"] = $_REQUEST["ISBN"];
        $_SESSION["Catalog-Publisher"] = $_REQUEST["Publisher"];
        $_SESSION["Catalog-Date-From"]= $_REQUEST['Date-From'];
        $_SESSION["Catalog-Date-To"] = $_REQUEST['Date-To'];
    }

    //Define Session Variables Inititally
    if(empty($_SESSION["Catalog-Title"])){$_SESSION["Catalog-Title"] = '%%';}
    if(empty($_SESSION["Catalog-Author"])){$_SESSION["Catalog-Author"] = '%%';}
    if(empty($_SESSION["Catalog-ISBN"])){$_SESSION["Catalog-ISBN"] = '%%';}
    if(empty($_SESSION["Catalog-Publisher"])){$_SESSION["Catalog-Publisherr"] = '%%';}
    if(empty($_SESSION["Catalog-Date-From"])){$_SESSION["Catalog-Date-From"] = '';}
    if(empty($_SESSION["Catalog-Date-To"])){$_SESSION["Catalog-Date-To"] = '';}

    if(empty($_SESSION["books"])){$_SESSION["books"] = '';}
    if(empty($_SESSION["journals"])){$_SESSION["journals"] = '';}
    if(empty($_SESSION["disks"])){$_SESSION["disks"] = '';}
    if(empty($_SESSION["electronics"])){$_SESSION["electronics"] = '';}

    $TypeSelect = 0;
    if(isset($_REQUEST['simple-submit'])){
        $_SESSION["Catalog-Title"] ='';
        $_SESSION["Catalog-Title"] = $_REQUEST['ssearch'];
        $_SESSION["Catalog-Title"] = filter_var($_REQUEST['ssearch'],FILTER_SANITIZE_STRING);
        $_SESSION["books"] = '';
        $_SESSION["journals"] = '';
        $_SESSION["disks"] = '';
        $_SESSION["electronics"] = '';
        $tickchosen = true;
        if(!empty($_REQUEST['check'])) {
            foreach($_REQUEST['check'] as $lo) {           
                if($lo == 'books') {
                    $_SESSION["books"] = $lo;
                    $TypeSelect += 1;
                }
                if($lo == 'disks') {
                    $_SESSION["disks"] = $lo;
                    $TypeSelect += 1;
                }
                if($lo == 'journals') {
                    $_SESSION["journals"] = $lo;
                    $TypeSelect += 1;
                }
                if($lo == 'electronics') {
                    $_SESSION["electronics"] = $lo;
                    $TypeSelect += 1;
                }
            }
        } 
        else { $tickchosen = false;}
    }
    if($TypeSelect == 0){
        $_SESSION["books"] = 1;
        $_SESSION["disks"] = 1;
        $_SESSION["journals"] = 1;
        $_SESSION["electronics"] = 1;
    }


    $bookout = '';
    $bookoutAuthor = '';
    $journalout = '';
    $journaloutAuthor = '';
    $diskout = '';
    $diskoutAuthor = '';
    $electout = '';
    if(!empty($_SESSION["Catalog-Title"]) || trim($_SESSION["Catalog-Title"]) != '%%') {
        $bookout = $bookout .' AND book.Name LIKE \'%' .$_SESSION["Catalog-Title"] .'%\'';
        $journalout = $journalout .' AND journal.Name LIKE \'%' .$_SESSION["Catalog-Title"] .'%\'';
        $diskout = $diskout .' AND disk.Name LIKE \'%' .$_SESSION["Catalog-Title"] .'%\'';
        $electout = $electout .' AND electronic.Name LIKE \'%' .$_SESSION["Catalog-Title"] .'%\'';
    }
    if(!empty($_SESSION["Catalog-Author"]) && trim($_SESSION["Catalog-Author"]) != '%%') {
        $SearchName =  explode(" ",$_SESSION["Catalog-Author"]);
        if(!empty($SearchName[0])){
            $bookoutAuthor = "HAVING GROUP_CONCAT(author.FName) LIKE '%".$SearchName[0]."%' OR GROUP_CONCAT(author.LName) LIKE '%".$SearchName[0]."%'";
            $journaloutAuthor = "HAVING GROUP_CONCAT(author.FName) LIKE '%".$SearchName[0]."%' OR GROUP_CONCAT(author.LName) LIKE '%".$SearchName[0]."%'";
            $diskoutAuthor = "HAVING GROUP_CONCAT(author.FName) LIKE '%".$SearchName[0]."%' OR GROUP_CONCAT(author.LName) LIKE '%".$SearchName[0]."%'";
        }
        if(!empty($SearchName[1])){
            $bookoutAuthor = "HAVING GROUP_CONCAT(author.LName) LIKE '%".$SearchName[1]."%'";
            $journaloutAuthor = "HAVING GROUP_CONCAT(author.LName) LIKE '%".$SearchName[1]."%'";
            $diskoutAuthor = "HAVING GROUP_CONCAT(author.LName) LIKE '%".$SearchName[1]."%'";
        }
        $_SESSION["electronics"] = '';
    }
    if(!empty($_SESSION["Catalog-ISBN"]) && trim($_SESSION["Catalog-ISBN"]) != '%%') {
        $bookout = $bookout .' AND book.ISBN LIKE \'%' .$_SESSION["Catalog-ISBN"] .'%\'';
        $journalout = $journalout .' AND journal.ISSN LIKE \'%' .$_SESSION["Catalog-ISBN"] .'%\'';
        $_SESSION["disks"] = '';
        $_SESSION["electronics"] = '';
    }

    //HAVING GROUP_CONCAT(author.FName) LIKE ? AND GROUP_CONCAT(author.LName) LIKE ?
?>

<style>
    h4 {
        font-size: 1.5rem;
    }

    .page-content{
        align-items: center;
    }

    .content-table{
        border-collapse: collapse;
        margin: 10px 0;
        font-size: 0.9em;
        width: 60%;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        margin-left: 20%;
        font-size: 15px;
    }

    .content-table thead tr{
        color: white;
        font-weight: bold; 
    }

    .content-table th, .content-table td{
        padding: 12px 15px;
        border-bottom: 3px solid rgba(0,0,0,.15);
        padding: 3px;
        background-color: #E2DFDF;
        text-align: center;
    }

    .content-table td s{
        border-color: rgba(0,0,0,.15);
        border-style: solid;
    }

    .page-content{
        flex-grow: 1;
    }

    *, *::after, *::before{
        box-sizing: border-box;
    }

    .modal{
        position:fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: 200ms ease-in-out;
        border: 1px solid black;
        border-radius: 10px;
        z-index: 10;
        background-color: #E2DFDF;
        width: 700px;
        max-width: 80%;
    }

    .modal.active {
        transform: translate(-50%, -50%) scale(1);
    }

    .modal-header{
        padding:  10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header .title{
        font-size: 1.25rem;
        font-weight: bold;
        width: 100%;
        text-align: center;
    }

    .modal-header .close-button{
        cursor: pointer;
        border: none;
        outline: none;
        background: none;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .modal-body{
        padding: 10px 15px;
        text-align:left;
    }
    .modal-body-image{
        display:inline;
        vertical-align:top;
    }

    .modal-body-text{
        display:inline;
        vertical-align:top;
        margin-left: 10px;
    }

    #overlay{
        position: fixed;
        opacity: 0;
        transition: 200ms ease-in-out;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, .5);
        pointer-events: none;
        z-index: 9;
    }

    #overlay.active{
        opacity: 1;
        pointer-events: all;
    }

    .modal-button-open{
        cursor: pointer;
        border: none;
        outline: none;
        background: none;
        font-weight: bold;
    }

    .PageCount{
        width: 100%;
        text-align: center;
        margin: 20px auto;
        bottom: 10%;
    }

    .PageCount a{
        font-size: 20px;
        padding: 10px;
        color: rgba(0, 0, 0, .6);
    }

    .PageCount a div{
        padding: 10px 15px;
    }

    .PageCount a div:hover{
        background: rgba(0, 0, 0, .1);
    }

    .Unselected-Page{
        border: 3px solid rgba(0, 0, 0, 0);
        border-radius: 5px;
        padding: 10px 15px;
    }

    .Selected-Page{
        border: 3px solid rgba(0, 0, 0, .6);
        border-radius: 5px;
        padding: 10px 15px;
    }

    .button-reserve{
        color: black; 
        font-size: 18px; 
        cursor: pointer; 
        background: #5bad4c; 
        font-weight: bold;
        padding: 5px;
        border-radius: 5px;
    }

    .button-reserve:hover{
        background: #529c44;
    }

    .error{
        width: 100%;
        background: red;
        text-align: center;
        padding: 20px;
        border-bottom: 3px solid rgba(0,0,0,.15);
    }

    .success{
        width: 100%;
        background: #38B023;
        text-align: center;
        border-bottom: 3px solid rgba(0,0,0,.15);
    }

    .warning{
        width: 100%;
        background: yellow;
        text-align: center;
        padding: 20px;
        border-bottom: 3px solid rgba(0,0,0,.15);
    }
</style>


<div class="page-content" style = " background: #E3E1E1;">
    <head2>
        <title>Search</title>
        <link rel="stylesheet" href="style.css">
    </head2>
<style>
    .catalog-header{
        background:#960C22; 
        width: 100%; 
        padding: 30px; 
        text-align: center;
        border-bottom: 3px solid rgba(0,0,0,.2);
    }

    .search-catalog{
        padding: 5px;
    }

    .admin-label{
        margin: auto .5%;
        color: white;
    }

    .admin-list{
        width: 15%;
        font-size: 15px;
        border: 1px solid rgba(0,0,0,.90);
        border-radius: 6px;
        padding: .2%;
        background:  #E2DFDF;
    }

    .admin-button-line{
        text-align: center;
    }

    .admin-button button{
        background:  #E2DFDF;
        padding: 5px;
        width: 10%;
        color: rgba(0,0,0,.90);
        border-radius: 10px;
        cursor: pointer;
        margin: auto 3%;
    }

</style>

    <div class = "catalog-header">
    <form class="admin-form">
        <label class="admin-label">Title:</label>
            <input type="text" name="Title" placeholder="Title..." class="admin-list"
                <?php if(!empty($_SESSION["Catalog-Title"]) && $_SESSION["Catalog-Title"] != '%%'){$Value =  'value = "'.$_SESSION["Catalog-Title"].'"';echo $Value;}?>>
            </input>
        <label class="admin-label">Creator:</label>
            <input type="text" name="Author" placeholder="Author..." class="admin-list"
                <?php if(!empty($_SESSION["Catalog-Author"]) && $_SESSION["Catalog-Author"] != '%%'){$Value =  'value = "'.$_SESSION["Catalog-Author"].'"';echo $Value;}?>>
            </input>
        <label class="admin-label">ISBN/ISSN:</label>
            <input type="text" name="ISBN" placeholder="ISBN / ISSN #..." class="admin-list"
                <?php if(!empty($_SESSION["Catalog-ISBN"]) && $_SESSION["Catalog-ISBN"] != '%%'){$Value =  'value = "'.$_SESSION["Catalog-ISBN"].'"';echo $Value;}?>>
            </input><br><br>
        <div class="admin-button-line"> 
            <label class="admin-button"> <button type="submit" name ="submitcatalog"><b>Search</b></button> </label>
            <label class="admin-button"> <button type="submit" name ="resetcatalog"><b>Reset</b></button> </label>
        </div> 
    </form>     
    </div>
    <?php
    //Check for errors coming from reservation page
        if(isset($_REQUEST['error'])){
            $Error = $_REQUEST['error'];
            if($Error == 1){echo '<h4 class = "error">You must be logged in to reserve books</h4>';}
            if($Error == 2){echo '<h4 class = "error">There was an error reserving your item</h4>';}
            if($Error == 3){echo '<h4 class = "warning">Limit 5 Requests! You cannot request any more items, please return or cancel a item before requesting anymore</h4>';}
            if($Error == 4){echo '<h4 class = "error">The item you requested is not available at this time</h4>';}
            if($Error == 5){echo '<h4 class = "warning">Limit 3 Requests! You cannot request any more items, please return or cancel a item before requesting anymore</h4>';}
            if($Error == 6){echo '<h4 class = "error">You have overdue loan payments. Please pay the amount due before requesting new items.</h4>';}
            
        }
        if(isset($_REQUEST['success'])){
            $Success = $_REQUEST['success'];
            echo '<h4 class = "success">Your request of: "'.$Success.'" was successful</h4>';
        }
    ?>
        <table class = "content-table">
            <thread>
                <tr>
                    <th style = "width:1%;">#</th>
                    <th></th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Type</th>
                    <th>Publisher</th>
                    <th>Status</th>
                </tr>
            </thread>
        <?php
            include 'connect.php';
            $sql = '';
            $NumResults = 0;
            $num = 0;
            $bookID = '';
            $DataArray = array();

            if(!empty($_SESSION["books"])) {
                    $sql = "SELECT * 
                    FROM book
                    INNER JOIN authorbookjoin ON book.Book_id = authorbookjoin.Book_id 
                    INNER JOIN author ON authorbookjoin.Author_id = author.Author_id
                    WHERE Deleted_id = 0 $bookout 
                    $bookoutAuthor";
                $result = mysqli_query($con,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    if(!in_array($row['Book_id'], $DataArray)){
                        $DataArray[] = $row['Book_id'];
                        $NumResults ++;
                    }
                }
            }
            $DataArray = array_diff( $DataArray, $DataArray);
            if(!empty($_SESSION["journals"])) {
                    $sql = "SELECT journal.Journal_id, authorjournaljoin.Author_id
                    FROM journal
                    INNER JOIN authorjournaljoin ON journal.Journal_id = authorjournaljoin.Journal_id 
                    INNER JOIN author ON authorjournaljoin.Author_id = author.Author_id
                    WHERE Deleted_id = 0 $journalout
                    $journaloutAuthor";
                $result = mysqli_query($con,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    if(!in_array($row['Journal_id'], $DataArray)){
                        $DataArray[] = $row['Journal_id'];
                        $NumResults ++;
                    }
                }
            }
            $DataArray = array_diff( $DataArray, $DataArray);
            if(!empty($_SESSION["disks"])) {
                    $sql = "SELECT * 
                    FROM disk
                    INNER JOIN authordiskjoin ON disk.Disk_id = authordiskjoin.Disk_id 
                    INNER JOIN author ON authordiskjoin.Author_id = author.Author_id 
                    WHERE Deleted_id = 0 
                    $diskout
                    $diskoutAuthor";
                $result = mysqli_query($con,$sql);
                while($row=mysqli_fetch_assoc($result)){
                    if(!in_array($row['Disk_id'], $DataArray)){
                        $DataArray[] = $row['Disk_id'];
                        $NumResults ++;
                    }
                }
            }
            if(!empty($_SESSION["electronics"])) {
                $sql = "SELECT * FROM electronic WHERE Deleted_id = 0 $electout";
                $result = mysqli_query($con,$sql);
                $NumResults = $NumResults + mysqli_num_rows($result);
            }
            $sql = '';

            if(!isset($_GET['page'])){$page = 1;}
            else{$page = $_GET['page'];}
            $PageResults = 10;
            $NumOfPages = ceil($NumResults/$PageResults);
            $FirstResult = ($page-1)*$PageResults;
            $num = $FirstResult;

            if(!empty($_SESSION["books"])) {
                $sql ="SELECT book.Book_id AS sID, book.Name AS sName, book.Rental_status AS sRental, book.ISBN AS sNum, book.Pages AS sPages, 
                            book.Publisher, book.Publish_date AS sPublished, book.Deleted_id AS dID, book.Img AS sImg, book.Description AS sDescription,
                            publisher.Publisher_id, publisher.Publisher_name AS sPublisher,
                            author.Author_id, GROUP_CONCAT(author.FName), GROUP_CONCAT(author.LName), authorbookjoin.Author_id, authorbookjoin.Book_id,
                            itemtype.Type_id, itemtype.Type_name AS sType, ('dummy') AS eType
                        FROM book
                        INNER JOIN itemtype ON book.Reference_type = itemtype.Type_id
                        INNER JOIN publisher ON book.Publisher = publisher.Publisher_id
                        INNER JOIN authorbookjoin ON book.Book_id = authorbookjoin.Book_id 
                        INNER JOIN author ON authorbookjoin.Author_id = author.Author_id
                        WHERE book.Deleted_id=0 $bookout
                        GROUP BY sID
                        $bookoutAuthor";
            }
            if(!empty($_SESSION["journals"])) {
                if(!empty($sql)){
                    $sql = $sql ." UNION ";
                }

                $sql = $sql ."SELECT journal.Journal_id AS sID, journal.Name AS sName, journal.Rental_status AS sRental, journal.ISSN AS sNum, journal.Pages AS sPages, 
                                journal.Publisher, journal.Publish_date AS sPublished, journal.Deleted_id AS dID, journal.Img AS sImg, journal.Description AS sDescription,
                                publisher.Publisher_id, publisher.Publisher_name AS sPublisher,
                                author.Author_id, GROUP_CONCAT(author.FName), GROUP_CONCAT(author.LName), authorjournaljoin.Author_id, authorjournaljoin.Journal_id,
                                itemtype.Type_id, itemtype.Type_name AS sType, ('dummy') AS eType
                            FROM journal
                            INNER JOIN itemtype ON journal.Reference_type = itemtype.Type_id
                            INNER JOIN publisher ON journal.Publisher = publisher.Publisher_id
                            INNER JOIN authorjournaljoin ON journal.Journal_id = authorjournaljoin.Journal_id 
                            INNER JOIN author ON authorjournaljoin.Author_id = author.Author_id
                            WHERE journal.Deleted_id=0 $journalout 
                            GROUP BY sID
                            $journaloutAuthor";
            }
            if(!empty($_SESSION["disks"])) {
                if(!empty($sql)){
                    $sql = $sql ." UNION ";
                }
                $sql = $sql ."SELECT disk.Disk_id AS sID, 
                                disk.Name AS sName, 
                                disk.Rental_status AS sRental, 
                                0 AS sNum, 
                                0 AS sPages,
                                
                                disk.Publisher, 
                                disk.Publish_date AS sPublished, 
                                disk.Deleted_id AS dID, 
                                disk.Img AS sImg, 
                                disk.Description AS sDescription,

                                publisher.Publisher_id, 
                                publisher.Publisher_name COLLATE utf8mb4_general_ci AS sPublisher,

                                author.Author_id, 
                                GROUP_CONCAT(author.FName), 
                                GROUP_CONCAT(author.LName), 
                                authordiskjoin.Author_id, 
                                authordiskjoin.Disk_id,

                                itemtype.Type_id, 
                                itemtype.Type_name AS sType,
                                ('dummy') AS eType
                                
                            FROM disk
                            INNER JOIN itemtype ON disk.Reference_type = itemtype.Type_id
                            INNER JOIN publisher ON disk.Publisher = publisher.Publisher_id
                            INNER JOIN authordiskjoin ON disk.Disk_id = authordiskjoin.Disk_id 
                            INNER JOIN author ON authordiskjoin.Author_id = author.Author_id
                            WHERE disk.Deleted_id=0 $diskout
                            GROUP BY sID
                            $diskoutAuthor";
            }
            if(!empty($_SESSION["electronics"])) {
                if(!empty($sql)){
                    $sql = $sql ." UNION ";
                }
                $sql = $sql ."SELECT electronic.Electronic_id AS sID, 
                                    electronic.Name AS sName, 
                                    electronic.Rental_status AS sRental, 
                                    electronic.Model AS sNum, 
                                    0 AS sPages,

                                    etype.ET_id, 
                                    electronic.Release_date AS sPublished,
                                    electronic.Deleted_id AS dID,
                                    electronic.Img AS sImg, 
                                    electronic.Description AS sDescription,

                                    brand.Brand_id,
                                    brand.Brand_name COLLATE utf8mb4_general_ci AS sPublisher, 

                                    electronic.Brand, 
                                    '(dummy data)', 
                                    '(dummy data)',
                                    '(1)',
                                    '(1)',

                                    itemtype.Type_id, 
                                    itemtype.Type_name AS sType,
                                    etype.Electronic_type AS eType
                                    
                                   
                            FROM electronic
                            INNER JOIN itemtype ON electronic.Reference_type = itemtype.Type_id
                            INNER JOIN etype ON etype.ET_id = electronic.Type
                            INNER JOIN brand ON brand.Brand_id = electronic.Brand
                            WHERE Deleted_id=0 $electout
                            GROUP BY sID";
            }
            if(!empty($sql)){
                $sql = $sql ." ORDER BY sName LIMIT $FirstResult, $PageResults";
            }
                                    
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{$result = mysqli_query($con,$sql);}

                    while($row=mysqli_fetch_assoc($result)){
                        $Type = $row['sType'];
                        $ID = $row['sID'];
                        $Name = $row['sName'];
                        $IDNum= $row['sNum'];
                        $Pages = $row['sPages'];
                        $Publisher = $row['sPublisher'];
                        $Published = $row['sPublished'];
                        $Rental = $row['sRental'];
                        $Img = $row['sImg'];
                        $Description = $row['sDescription'];
                        $Etype = $row['eType'];
                        $Genre = '';
                        if($Type == 'Electronic'){
                            $Genre = $row['eType'];
                            $FullName = $Publisher;
                            $ListName = $Publisher;
                        }
                        if($Type == 'Book'){
                            $sql2="SELECT book.Book_id, book.Deleted_id,
                            publisher.Publisher_id, publisher.Publisher_name,
                            genre.Genre_id, GROUP_CONCAT(genre.Genre_type SEPARATOR ', ') AS genres, genrebookjoin.Genre_id, genrebookjoin.Book_id
                            FROM book
                            INNER JOIN publisher ON book.Publisher = publisher.Publisher_id
                            INNER JOIN genrebookjoin ON book.Book_id = genrebookjoin.Book_id 
                            INNER JOIN genre ON genrebookjoin.Genre_id = genre.Genre_id
                            WHERE book.Deleted_id=0 AND book.Book_id = $ID
                            GROUP BY book.Book_id";
                        }

                        if($Type == 'Journal'){
                            $sql2="SELECT journal.Journal_id, journal.Deleted_id,
                            publisher.Publisher_id, publisher.Publisher_name,
                            genre.Genre_id, GROUP_CONCAT(genre.Genre_type SEPARATOR ', ') AS genres, genrejournaljoin.Genre_id, genrejournaljoin.Journal_id
                            FROM journal
                            INNER JOIN publisher ON journal.Publisher = publisher.Publisher_id
                            INNER JOIN genrejournaljoin ON journal.Journal_id = genrejournaljoin.Journal_id 
                            INNER JOIN genre ON genrejournaljoin.Genre_id = genre.Genre_id
                            WHERE journal.Deleted_id=0 AND journal.Journal_id = $ID
                            GROUP BY journal.Journal_id";
                        }

                        if($Type == 'Disk'){
                            $sql2="SELECT disk.Disk_id, disk.Deleted_id,
                            publisher.Publisher_id, publisher.Publisher_name,
                            genre.Genre_id, GROUP_CONCAT(genre.Genre_type SEPARATOR ', ') AS genres, genrediskjoin.Genre_id, genrediskjoin.Disk_id
                            FROM disk
                            INNER JOIN publisher ON disk.Publisher = publisher.Publisher_id
                            INNER JOIN genrediskjoin ON disk.Disk_id = genrediskjoin.Disk_id 
                            INNER JOIN genre ON genrediskjoin.Genre_id = genre.Genre_id
                            WHERE disk.Deleted_id=0 AND disk.Disk_id = $ID
                            GROUP BY disk.Disk_id";
                        }
                        if ($Type != 'Electronic'){
                            $stmt2 = mysqli_stmt_init($con);
                            if(!mysqli_stmt_prepare($stmt2,$sql2)){echo "SQL statement failed";}
                            else{$result2 = mysqli_query($con,$sql2);}
                            while($row2=mysqli_fetch_assoc($result2)){$Genre = $row2['genres'];}   
                            
                            $Flist = explode(',', $row['GROUP_CONCAT(author.FName)']);
                            $Llist = explode(',', $row['GROUP_CONCAT(author.LName)']);
                            $ListName = '';
                            $FullName = '';
                            for($x = 0; $x < sizeof($Flist); $x+=1){
                                $ListName = $ListName . $Flist[$x] .' '. $Llist[$x] . ', ';
                                $FullName = $FullName . $Flist[$x] .' '. $Llist[$x] . '<br> ';
                            }
                            $FullName = trim($FullName);
                            $FullName = substr($FullName, 0, -1);
                            $ListName  = trim($ListName );
                            $ListName  = substr($ListName , 0, -1);
                        }
                        if($Genre != ''){
                            $num += 1;
                            echo '<tbody>
                                    <tr id = '.$num.'>
                                        <td id = "'.$num.'" onclick ="content()">
                                            <s style="padding:5px 7px; border-radius: 5px;">'.$num.'</s>
                                        </td>
                                        <td style = " padding: 5px 5px; width: 1%;">
                                            <img id = "'.$num.'" onclick ="content()" src="img/'.$Img.'" width=80 height=120 style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; border: 3px solid rgba(0,0,0,.25); border-radius: 5px;">
                                        </td>
                                        <td id = "'.$num.'" onclick ="content()" style = "width:15%">
                                            <small>'.$Type.'</small><br>
                                            <button class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: 3091C1;">'.$Name.'</button>
                                        </td>
                                        <td id = "'.$num.'" onclick ="content()" style = "width:10%">'.$FullName.'</td>
                                        <td id = "'.$num.'" onclick ="content()" style = "width:15%;">'.$Genre.'</td>
                                        <td id = "'.$num.'" onclick ="content()" style = "width:10%; padding: 10px;"><small>'.$Publisher.'</small></td>
                                        <td id = "'.$num.'" onclick ="content()" style = "width:10%;">';
                                                if($Rental != 0){
                                                    echo '<button class = modal-button-open data-modal-target="#modal'.$num.'" style = "color: #38B023;">Available<br>Reserve Now</button><br>';
                                                }
                                                else{
                                                    echo '<div style = "color: #b02333; font-size:13px;"><b>Unavailable</b></div>';
                                                }
                            echo'
                                        </td>
                                    </tr>
                                    <div class="modal" id="modal'.$num.'">
                                        <div class="modal-header">
                                            <div class="title">'.$Name.'</div>
                                                <button data-close-button class="close-button">&times;</button>
                                            </div>
                                        <div class="modal-body">
                                            <div class = "modal-body-image">
                                                <img src="img/'.$Img.'" width=160 height=240 style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; border: 3px solid rgba(0,0,0,.25); border-radius: 5px;">
                                            </div>
                                            <div class = "modal-body-text">
                                                <div style ="display:inline-block;"> 
                                                    <div style = "color: rgba(0,0,0,.50); display:inline-block;"> 
                                                        <b>Details</b> 
                                                        <hr style="width:400px; border-color: rgba(0,0,0,.15); display:inline-block; position: relative; top: -3px;"> </hr>
                                                    </div> <br>
                                                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">';
                                                    if ($Type != 'Electronic'){
                                                        echo '<b>Authors:</b> '.$ListName.'';
                                                    }
                                                    else{
                                                        echo '<b>Type:</b> '.$Etype.'';
                                                    }
                                                    echo '
                                                    </div><br>
                                                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">';
                                                    if ($Type != 'Electronic'){
                                                        echo '<b>Publisher:</b> '.$Publisher.'';
                                                    }
                                                    else{
                                                        echo '<b>Brand:</b> '.$Publisher.'';
                                                    }

                                                    echo '
                                                    </div><br>
                                                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">';
                                                    if ($Type != 'Electronic'){
                                                        echo '<b>Published:</b> '.$Published.'';
                                                    }
                                                    else{
                                                        echo '<b>Released:</b> '.$Published.'';
                                                    }
                                                    echo '
                                                    </div><br>';
                                                    if($IDNum != 0){
                                                        if($Type == 'Electronic'){
                                                            echo'<div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                                <b>Model:</b> '.$IDNum.'
                                                            </div><br>';
                                                        }
                                                        if($Type == 'Book'){
                                                            echo'<div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                                <b>ISBN:</b> '.$IDNum.'
                                                            </div><br>
                                                            <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                                <b>Pages:</b> '.$Pages.'
                                                            </div><br>';
                                                        }
                                                        if($Type == 'Journal'){
                                                            echo'<div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                                <b>ISSN:</b> '.$IDNum.'
                                                            </div><br>
                                                            <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                                <b>Vol:</b> '.$Pages.'
                                                            </div><br>';
                                                        }
                                                    }
                                                    echo'
                                                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                        <b>Available Copies:</b> '.$Rental.'
                                                    </div><br>';

                                                    if ($Rental != 0){
                                                        echo '<div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                            <button type="button" class = "button-reserve" onclick="location.href=\'reserve?reserve='.$ID.'&type='.$Type.'\'">Reserve Now</button>
                                                        </div><br>';
                                                    }
                                                    echo'
                                                    <div style = "display:inline-block; margin: 5px auto; font-size: 15px; max-width: 460px;">
                                                        <b>Description:</b><br>
                                                        <div style="margin-left: 10px;display:inline-block;"><small>'.$Description.'</small></div>
                                                    </div><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="overlay"></div>
                                </tbody>';
                        }
                        $Genre = '';
                    }
                    echo '</table>';
                    echo '<div class = "PageCount">';
                    for($PageCount=1;$PageCount<=$NumOfPages;$PageCount++){
                        echo '<a href="find?page='.$PageCount.'">';
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
                    //echo '<div class = "Per-Page"> Results Per Page 
                                //<a href="find?page='.$PageCount.'">
                        //</div>';
            ?>
</div>
<?php
    include_once 'footer.php';
?>

<script>
    const openModalButtons = document.querySelectorAll('[data-modal-target]')
    const closeModalButtons = document.querySelectorAll('[data-close-button]')
    const overlay = document.getElementById('overlay')

    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.querySelector(button.dataset.modalTarget)
            openModal(modal)
        })
    })

    overlay.addEventListener('click', () => {
        const modals = document.querySelectorAll('.modal.active')
        modals.forEach(modal => {
            closeModal(modal)
        })
    })

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal')
            closeModal(modal)
        })
    })

    function openModal(modal) {
        if (modal == null) return
        modal.classList.add('active')
        overlay.classList.add('active')
    }

    function closeModal(modal) {
        if (modal == null) return
        modal.classList.remove('active')
        overlay.classList.remove('active')
    }

    function content(){
        const modal = document.querySelector('#modal' + event.srcElement.id)
        openModal(modal)
    }

    //const modal = document.querySelector('#modal' + num)
    //openModal(modal)

</script>