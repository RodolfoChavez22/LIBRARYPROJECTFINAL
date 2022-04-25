<?php
    include_once '../../header.php';
    //Redirect if the user is not a admin
    if($_SESSION['User_Status'] != 'admin'){header("Location: ../../homepage");}
    //Initialize Datalist entries for duplicates
    $DataArray = array();
    //Initialize Dynamic Selection variables
    $_SESSION['author1'] = '';
    $_SESSION['genre1'] = '';
    unset($_SESSION['Amount']);
    unset($_SESSION['GenreAmount']);
    //Record User input for dynamic variables
    if(isset($_POST["amount"]) || isset($_POST["genre-amount"]) || isset($_REQUEST['button-submit'])){
        $_SESSION['Amount'] = $_POST["amount"];
        $_SESSION['GenreAmount'] = $_POST["genre-amount"];
        for($x = 1; $x <= $_SESSION['Amount']; $x+=1){
            if(empty($_SESSION['author'.$x.''])){$_SESSION['author'.$x.''] = '';}
            if(!empty($_REQUEST['author'.$x.''])){$_SESSION['author'.$x.''] = $_REQUEST['author'.$x.''];}
            else{$_SESSION['author'.$x.''] = '';}
        }
        for($x = 1; $x <= $_SESSION['GenreAmount']; $x+=1){
            if(empty($_SESSION['genre'.$x.''])){$_SESSION['genre'.$x.''] = '';}
            if(!empty($_REQUEST['genre'.$x.''])){$_SESSION['genre'.$x.''] = $_REQUEST['genre'.$x.''];}
            else{$_SESSION['genre'.$x.''] = '';}
        }
        //Record User input for non-dynamic inputs
        $Name = $_REQUEST['name'];
        $ISSN = $_REQUEST['issn'];
        $Pages = $_REQUEST['pages'];
        $Publisher = $_REQUEST['publisher'];
        $Date = $_REQUEST['publishdate'];
        $Rental = $_REQUEST['rental'];
        if (isset($_POST['description'])) {$Description = $_POST['description'];}
        //Error Handles
        if(isset($_REQUEST['button-submit'])){
            //Check Dynamic Authors
            for($x = 1; $x <= $_SESSION['Amount']; $x+=1){
                if(empty($_SESSION['author'.$x.''])){
                    $errorMsg[0] = 'Fill all author fields or reduce authors';
                }
                //Checks all matches by lowercasing and removing spacing
                for($c = 1; $c <= $_SESSION['Amount']; $c+=1){
                    $input1 = str_replace(' ','',strtolower($_SESSION['author'.$x.'']));
                    $input2 = str_replace(' ','',strtolower($_SESSION['author'.$c.'']));
                    if($x != $c &&  $input1 == $input2 ){
                        $errorMsg[1] = 'Do not include duplicate authors';
                    }
                }
            }
            //Check Dynamic Genres
            for($x = 1; $x <= $_SESSION['GenreAmount']; $x+=1){
                if(empty($_SESSION['genre'.$x.''])){
                    $errorMsg[2] = 'Fill all genre fields or reduce genres';
                }
                //Checks all matches by lowercasing and removing spacing
                for($c = 1; $c <= $_SESSION['GenreAmount']; $c+=1){
                    $input1 = str_replace(' ','',strtolower($_SESSION['genre'.$x.'']));
                    $input2 = str_replace(' ','',strtolower($_SESSION['genre'.$c.'']));
                    if($x != $c &&  $input1 == $input2 ){
                        $errorMsg[3] = 'Do not include duplicate genres';
                    }
                }
            }
            if(empty($Name)){$errorMsg[4] = 'Name Required';}
            //ISSN must be 13 in length exactly
            if(empty($ISSN)){$errorMsg[5] = 'ISSN Required';}
            if(!empty($ISSN)) {
                if(strlen($ISSN) < 8 || strlen($ISSN) > 8){
                    $errorMsg[6] = 'ISSN Must Be 8 Numbers';
                }
                $sql = "SELECT * FROM journal WHERE ISSN = $ISSN";
                $result = mysqli_query($con, $sql);
                //Check if the ISSN has already been registered
                if(mysqli_num_rows($result) > 0){
                    $errorMsg[6] = 'ISSN already in use';
                }
            }
            if(empty($Publisher)){$errorMsg[7] = 'Publisher Required';}
            if(empty($Date)){$errorMsg[8] = 'Publish Date Required';}
            if($Date > date("Y-m-d")){$errorMsg[8] = 'Valid Date Required';}
            if(empty($Rental) && $Rental != 0){$errorMsg[9] = 'Quantity Required';}
            if(empty($Pages)){$errorMsg[12] = 'Page Count Required';}

            //Record User input for image
            if(isset($_FILES['file'])){
                $File = $_FILES['file'];
                $FileName = $_FILES['file']['name'];
                $FileTemp = $_FILES['file']['tmp_name'];
                $FileSize = $_FILES['file']['size'];
                $FileError = $_FILES['file']['error'];
                $FileType = $_FILES['file']['type'];
                //Break apart file name
                $fileExtensionName = explode('.', $FileName);
                $fileExtensionType = strtolower(end($fileExtensionName));
                //Allow only acceptable img formats
                $Allow = array('jpg', 'jpeg', 'png');
                //Set unique id for file
                if(in_array($fileExtensionType, $Allow)){
                    if($FileError == 0){
                        if($FileSize < 1000000){
                            $fileNameNew = uniqid('', true).".". $fileExtensionType;
                            $FilePath = '../../img/' . $fileNameNew;
                            move_uploaded_file($FileTemp, $FilePath);
                        }
                        else{$errorMsg[10] = 'Filesize To Large';}
                    }
                    else{$errorMsg[10] = 'Error Uploading File';}
                }
                else{$errorMsg[10] = 'Invalid File Type';}
            }
            //Prepared SQL Statements
            if(empty($errorMsg)){
                $AuthorList = '';
                $sql = "SELECT FName, LName, Author_id FROM author WHERE CONCAT(FName,' ',LName)=?";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                else{
                    //If the author does not exist in DB, check if its correctly formatted, if so then create a new author
                    for($x = 1; $x <= $_SESSION['Amount']; $x+=1){
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['author'.$x.'']);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) == 0){
                            //Seperate Input into segments
                            $FullName = explode(' ', trim($_SESSION['author'.$x.'']));
                            //If formatted correctly create new author
                            if(sizeof($FullName) == 2){
                                $FirstName = current($FullName);
                                $LastName = end($FullName);
                                $sql2 = "INSERT INTO author (FName,LName) VALUES(?,?)";
                                $stmt2 = mysqli_stmt_init($con);
                                if(!mysqli_stmt_prepare($stmt2,$sql2)){echo "SQL statement failed";}
                                else{
                                    mysqli_stmt_bind_param($stmt2, "ss", $FirstName, $LastName);
                                    mysqli_stmt_execute($stmt2);
                                }
                                $AuthorId = mysqli_insert_id($con);
                                $AuthorList = $AuthorList . $AuthorId . ',';
                            }
                            //If not formatted correctly send error
                            else{$errorMsg[11] = 'Invalid author name: use "FirstName LastName"';}
                        }
                        else{
                            $row=mysqli_fetch_assoc($result);
                            $AuthorId = $row['Author_id'];
                            $AuthorList = $AuthorList . $AuthorId . ',';
                        }                       
                    }
                    $AuthorList = substr($AuthorList, 0, -1);
                    $AuthorList = explode(',',$AuthorList);
                }

                if(empty($errorMsg)){
                    $GenreList = '';
                    $sql = "SELECT Genre_type, Genre_id FROM genre WHERE Genre_type=?";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{
                        //If the genre does not exist in DB, check if its correctly formatted, if so then create a new genre
                        for($x = 1; $x <= $_SESSION['GenreAmount']; $x+=1){
                            mysqli_stmt_bind_param($stmt, "s", $_SESSION['genre'.$x.'']);
                            mysqli_stmt_execute($stmt);
                            $result=mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result) == 0){
                                //Remove any whitespace
                                $Genre = trim($_SESSION['genre'.$x.'']);
                                $sql2 = "INSERT INTO genre (Genre_type) VALUES(?)";
                                $stmt2 = mysqli_stmt_init($con);
                                if(!mysqli_stmt_prepare($stmt2,$sql2)){echo "SQL statement failed";}
                                else{
                                    mysqli_stmt_bind_param($stmt2, "s", $Genre);
                                    mysqli_stmt_execute($stmt2);
                                }
                                $GenreId = mysqli_insert_id($con);
                                $GenreList = $GenreList . $GenreId . ',';
                            }
                            else{
                                $row=mysqli_fetch_assoc($result);
                                $GenreId = $row['Genre_id'];
                                $GenreList = $GenreList . $GenreId . ',';
                            }
                        }
                        $GenreList = substr($GenreList, 0, -1);
                        $GenreList = explode(',',$GenreList);
                    }

                    $sql = "SELECT Publisher_name, Publisher_id FROM publisher WHERE Publisher_name=?";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{
                        //If the publisher does not exist in DB, check if its correctly formatted, if so then create a new publisher
                        mysqli_stmt_bind_param($stmt, "s", $Publisher);
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) == 0){
                            //Remove any whitespace
                            $Publisher = trim($Publisher);
                            $sql2 = "INSERT INTO publisher (Publisher_name) VALUES(?)";
                            $stmt2 = mysqli_stmt_init($con);
                            if(!mysqli_stmt_prepare($stmt2,$sql2)){echo "SQL statement failed";}
                            else{
                                mysqli_stmt_bind_param($stmt2, "s", $Publisher);
                                mysqli_stmt_execute($stmt2);
                            }
                        }
                        //Convert String Value to Id value from publisher table
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                        while($row=mysqli_fetch_assoc($result)){
                            $Publisher=$row['Publisher_id'];
                        }
                    }
                    //Insert into journal table
                    $sql = "INSERT INTO journal (Name,ISSN,Pages,Publisher,Publish_date,Rental_Status,Img,Description) VALUES (?,?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{
                        mysqli_stmt_bind_param($stmt, "ssississ", $Name, $ISSN, $Pages, $Publisher, $Date, $Rental, $fileNameNew, $Description);
                        mysqli_stmt_execute($stmt);
                    }
                    //Retrieve the journal id of from the previous insert
                    $InsertId = mysqli_insert_id($con);
                    //Set Multiple Authors to retrieved journal id
                    $sql = "INSERT INTO authorjournaljoin (Author_id,Journal_id) VALUES (?,?)";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{
                        for($x = 0; $x < sizeof($AuthorList); $x+=1){
                            mysqli_stmt_bind_param($stmt, "ii", $AuthorList[$x], $InsertId);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                    //Set Multiple Genres to retrieved journal id
                    $sql = "INSERT INTO genrejournaljoin (Genre_id,Journal_id) VALUES (?,?)";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{
                        for($x = 0; $x < sizeof($GenreList); $x+=1){
                            mysqli_stmt_bind_param($stmt, "ii", $GenreList[$x], $InsertId);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                    for($x = 1; $x <= $_SESSION['Amount']; $x+=1){unset($_SESSION['author'.$x.'']);}
                    unset($_SESSION['Amount']);
                    for($x = 1; $x <= $_SESSION['GenreAmount']; $x+=1){unset($_SESSION['genre'.$x.'']);}
                    unset($_SESSION['GenreAmount']);
                    header("location: ../journals?add");


                }
            }
        }
    }
?>

<head>
    <title>Create Journal</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<div class="page-content">
    <div class = "display-body">
        <form  action = "" method="POST" class="add-form" id="add-form" enctype="multipart/form-data">
            <h3 class="add-header">Create Journal</h3>
            <div class = "add-input">
                <div class = "add-authors">
                    <label class="add-label">Number of Authors</label>
                    <select name="amount" onchange="this.form.submit()">
                        <?php
                            for($x = 1; $x <= 5; $x+=1){
                                if($x == $_SESSION['Amount']){echo '<option selected>'.$x.'</option>';}
                                else{echo '<option>'.$x.'</option>';}
                            }
                        ?>
                    </select>
                    <?php 
                        if(isset($errorMsg[0])){echo "<p style='color:red; font-size:15px; margin-top: 5px;'>".$errorMsg[0]."</p>";}
                        if(isset($errorMsg[1])){echo "<p style='color:red; font-size:15px; margin-top: 5px;'>".$errorMsg[1]."</p>";}
                        if(isset($errorMsg[11])){echo "<p style='color:red; font-size:15px; margin-top: 5px;'>".$errorMsg[11]."</p>";}
                    ?>
                    <br><br>
                    <label class="label-single">Author 1:</label>
                    <input list="listAuthor" class = "datalist" name="author1" placeholder="Author name..."
                        <?php
                            echo 'value = "'.$_SESSION['author1'].'"';
                        ?>
                    >
                        <datalist id="listAuthor">
                            <?php
                                $DataArray = array_diff( $DataArray, $DataArray);
                                $sql = "SELECT CONCAT(FName,' ',LName) AS Full_name FROM author";
                                if($result = mysqli_query($con,$sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $temp = $row['Full_name'];
                                            if(!in_array($temp, $DataArray)){
                                                $DataArray[] = $temp;
                                                echo "<option>$temp</option>";
                                            }
                                        }
                                    }
                                }
                            ?>
                        </datalist>
                    </input><br>
                    <?php
                        if(isset($_SESSION['Amount'])){
                            for($x = 2; $x <= $_SESSION['Amount']; $x+=1){
                                $valPlace = $_SESSION['author'.$x.''];
                                echo '<label class="label-single">Author '.$x.':</label>';
                                echo '
                                    <input list="listAuthor" class = "datalist" name="author'.$x.'" placeholder="Author name..."
                                        value = "'.$valPlace.'"
                                    >
                                        <datalist id="listAuthor">
                                            <?php
                                                $DataArray = array_diff( $DataArray, $DataArray);
                                                $sql = "SELECT CONCAT(FName,\' \',LName) AS Full_name FROM author";
                                                if($result = mysqli_query($con,$sql)){
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($row = mysqli_fetch_array($result)){
                                                            $temp = $row[\'Full_name\'];
                                                            if(!in_array($temp, $DataArray)){
                                                                $DataArray[] = $temp;
                                                                echo "<option>$temp</option>";
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                        </datalist>
                                    </input><br>
                                            ';
                                        } 
                                    }   
                                ?>
                </div>
                <div class= "add-genre">
                    <div class="add-margin">
                        <label class="add-label">Number of Genres</label>
                        <select name="genre-amount" onchange="this.form.submit()" >
                            <?php
                                for($x = 1; $x <= 5; $x+=1){
                                    if($x == $_SESSION['GenreAmount']){echo '<option selected>'.$x.'</option>';}
                                    else{echo '<option>'.$x.'</option>';}
                                }
                            ?>
                        </select>
                        <?php 
                            if(isset($errorMsg[2])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[2]."</p>";}
                            if(isset($errorMsg[3])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[3]."</p>";}
                        ?>
                        <div class="add-genre-field">
                            <input list="listGenre" class = "datalist" name="genre1" placeholder="Genre Name..."
                                <?php
                                    echo 'value = "'.$_SESSION['genre1'].'"';
                                ?>
                            >
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
                            <?php
                                if(isset($_SESSION['GenreAmount'])){
                                    for($x = 2; $x <= $_SESSION['GenreAmount']; $x+=1){
                                        $valPlace = $_SESSION['genre'.$x.''];
                                        echo '<label class="label-single">, </label>';
                                        echo '
                                            <input list="listGenre" class = "datalist" name="genre'.$x.'" placeholder="Genre name..."
                                                value = "'.$valPlace.'"
                                            >
                                                <datalist id="listGenre">
                                                    <?php
                                                        $DataArray = array_diff( $DataArray, $DataArray);
                                                        $sql = "SELECT Genre_type FROM genre";
                                                        if($result = mysqli_query($con,$sql)){
                                                            if(mysqli_num_rows($result) > 0){
                                                                while($row = mysqli_fetch_array($result)){
                                                                    $temp = $row[\'Genre_type\'];
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
                                        ';
                                    } 
                                }   
                            ?><br>
                        </div>
                        <div class = "add-form-types">
                            <label class="label-single">Name of Journal</label><br>
                            <?php if(isset($errorMsg[4])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[4]."</p>";}?>
                            <input type="text" placeholder="Journal name..." class="input-single" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"><br>
                            <label class="label-single">ISSN</label><br>
                            <?php 
                                if(isset($errorMsg[5])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[5]."</p>";}
                                if(isset($errorMsg[6])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[6]."</p>";}
                            ?>
                            <input type="text" placeholder="ISSN..." class="input-single" name="issn" value="<?php echo isset($_POST['issn']) ? $_POST['issn'] : '' ?>"><br>
                            <label class="label-single">Pages</label><br>
                            <?php 
                                if(isset($errorMsg[12])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[12]."</p>";}
                            ?>
                            <input type="text" placeholder="Page Count..." class="input-single" name="pages" value="<?php echo isset($_POST['pages']) ? $_POST['pages'] : '' ?>"><br>
                            <label class="label-single">Publisher</label><br>
                            <?php if(isset($errorMsg[7])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[7]."</p>";}?>
                            <input list="listPublisher" class = "datalist" name="publisher" placeholder="Publisher Name..."
                                <?php
                                    if(!empty($_POST['publisher'])){
                                        echo 'value = "'.$_POST['publisher'].'"';
                                    }
                                ?>
                            >
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
                                </datalist><br>
                            </input>
                            <label class="label-single">Published Date</label><br>
                            <?php if(isset($errorMsg[8])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[8]."</p>";}?>
                            <input type="date" class="input-single" name="publishdate" value="<?php echo isset($_POST['publishdate']) ? $_POST['publishdate'] : '' ?>"><br>
                            <label class="label-single">Rental Amount</label><br>
                            <?php if(isset($errorMsg[9])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[9]."</p>";}?>
                            <input type="text" placeholder="1..." class="input-single" name="rental" value="<?php echo isset($_POST['rental']) ? $_POST['rental'] : '' ?>"><br>
                        </div>
                        <div class = "add-image">
                            <?php if(isset($errorMsg[10])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[10]."</p>";}?>
                            <input type="file" name="file" class = "ImageUpload">
                        </div>
                        <label class="label-single">Description</label><br><br>
                        <textarea  id="description" name="description" cols="30" rows="10" style="width:500px; height:300px;" placeholder="Description of book..."><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                        <div class = "signup-button">
                            <button type="submit" name ="button-submit" style = "margin-left: 5%;">CREATE JOURNAL</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    include_once '../../footer.php';
?>