<?php
    include_once '../../header.php';
    //Redirect if the user is not a admin
    if($_SESSION['User_Status'] != 'admin'){header("Location: ../../homepage");}
    //Initialize Datalist entries for duplicates
    $DataArray = array();
    //Record User input for dynamic variables
    if(isset($_REQUEST['button-submit'])){
        //Record User input for non-dynamic inputs
        $Name = $_REQUEST['name'];
        $Brand = $_REQUEST['brand'];
        $Model = $_REQUEST['model'];
        $Type = $_REQUEST['type'];
        $Date = $_REQUEST['releasedate'];
        $Rental = $_REQUEST['rental'];
        if (isset($_POST['description'])) {$Description = $_POST['description'];}
        //Error Handles
        if(isset($_REQUEST['button-submit'])){
            if(empty($Name)){$errorMsg[4] = 'Name Required';}
            if(empty($Brand)){$errorMsg[7] = 'Brand Required';}
            if(empty($Model)){$errorMsg[5] = 'Model Required';}
            if(empty($Type)){$errorMsg[6] = 'Type Required';}
            if(empty($Date)){$errorMsg[8] = 'Release Date Required';}
            if($Date > date("Y-m-d")){$errorMsg[8] = 'Valid Date Required';}
            if(empty($Rental) && $Rental != 0){$errorMsg[9] = 'Quantity Required';}

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
                $sql = "SELECT * FROM etype WHERE Electronic_type=?";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                else{
                    //If the publisher does not exist in DB, check if its correctly formatted, if so then create a new publisher
                    mysqli_stmt_bind_param($stmt, "s", $Type);
                    mysqli_stmt_execute($stmt);
                    $result=mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) == 0){
                        //Remove any whitespace
                        $Type = trim($Type);
                        $sql2 = "INSERT INTO etype (Electronic_type) VALUES(?)";
                        $stmt2 = mysqli_stmt_init($con);
                        if(!mysqli_stmt_prepare($stmt2,$sql2)){echo "SQL statement failed";}
                        else{
                            mysqli_stmt_bind_param($stmt2, "s", $Type);
                            mysqli_stmt_execute($stmt2);
                        }
                    }
                        //Convert String Value to Id value from publisher table
                        mysqli_stmt_execute($stmt);
                        $result=mysqli_stmt_get_result($stmt);
                        while($row=mysqli_fetch_assoc($result)){
                            $Type=$row['ET_id'];
                        }
                    }

                $sql = "SELECT * FROM brand WHERE Brand_name=?";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                else{
                    //If the publisher does not exist in DB, check if its correctly formatted, if so then create a new publisher
                    mysqli_stmt_bind_param($stmt, "s", $Brand);
                    mysqli_stmt_execute($stmt);
                    $result=mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) == 0){
                        //Remove any whitespace
                        $Brand = trim($Brand);
                        $sql2 = "INSERT INTO brand (Brand_name) VALUES(?)";
                        $stmt2 = mysqli_stmt_init($con);
                        if(!mysqli_stmt_prepare($stmt2,$sql2)){echo "SQL statement failed";}
                        else{
                            mysqli_stmt_bind_param($stmt2, "s", $Brand);
                            mysqli_stmt_execute($stmt2);
                        }
                    }
                        //Convert String Value to Id value from publisher table
                    mysqli_stmt_execute($stmt);
                    $result=mysqli_stmt_get_result($stmt);
                    while($row=mysqli_fetch_assoc($result)){
                        $Brand=$row['Brand_id'];
                    }
                 }

                    //Insert into disk table
                    $sql = "INSERT INTO electronic (Type,Model,Brand,Rental_Status,Img,Description,Release_date) VALUES (?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{
                        mysqli_stmt_bind_param($stmt, "isiisss", $Type, $Model, $Brand, $Rental, $fileNameNew, $Description,$Date);
                        mysqli_stmt_execute($stmt);
                    }


                    header("location: ../electronics?add");
                
            }
        }
    }
?>

<head>
    <title>Create Electronic</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<div class="page-content">
    <div class = "display-body-electronic" >
        <form  action = "" method="POST" class="add-form-electronic" id="add-form" enctype="multipart/form-data" style = "width: 60%;">
            <h3 class="add-header" style = "text-align:center;">Create Electronic</h3>
            <div class = "add-input">
                <div class= "add-genre">
                    <div class="add-margin">
                        <div class = "add-form-types">
                            <label class="label-single">Name of Device</label><br>
                            <?php if(isset($errorMsg[4])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[4]."</p>";}?>
                            <input type="text" placeholder="Device name..." class="input-single" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"><br>
                            
                            <label class="label-single">Brand</label><br>
                            <?php if(isset($errorMsg[7])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[7]."</p>";}?>
                            <input list="listBrand" class = "datalist" name="brand" placeholder="Brand Name..."
                                <?php
                                    if(!empty($_POST['brand'])){
                                        echo 'value = "'.$_POST['brand'].'"';
                                    }
                                ?>
                            >
                                <datalist id="listBrand">
                                    <?php
                                        $DataArray = array_diff( $DataArray, $DataArray);
                                        $sql = "SELECT Brand_name FROM brand";
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
                                </datalist><br>
                            </input>
                            <label class="label-single">Model</label><br>
                            <?php if(isset($errorMsg[5])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[5]."</p>";}?>
                            <input type="text" placeholder="Model type..." class="input-single" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>"><br>
                            
                            <label class="label-single">Type</label><br>
                            <?php if(isset($errorMsg[6])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[6]."</p>";}?>
                            <input list="listType" class = "datalist" name="type" placeholder="Type..."
                                <?php
                                    if(!empty($_POST['type'])){
                                        echo 'value = "'.$_POST['type'].'"';
                                    }
                                ?>
                            >
                                <datalist id="listType">
                                    <?php
                                        $DataArray = array_diff( $DataArray, $DataArray);
                                        $sql = "SELECT Electronic_type FROM etype";
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
                                </datalist><br>
                            </input>
                            <label class="label-single">Release Date</label><br>
                            <?php if(isset($errorMsg[8])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[8]."</p>";}?>
                            <input type="date" class="input-single" name="releasedate" value="<?php echo isset($_POST['releasedate']) ? $_POST['releasedate'] : '' ?>"><br>
                            <label class="label-single">Rental Amount</label><br>
                            <?php if(isset($errorMsg[9])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[9]."</p>";}?>
                            <input type="text" placeholder="1..." class="input-single" name="rental" value="<?php echo isset($_POST['rental']) ? $_POST['rental'] : '' ?>"><br>
                        </div>
                        <div class = "add-image" style = "margin-left: 40px;">
                            <?php if(isset($errorMsg[10])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[10]."</p>";}?>
                            <input type="file" name="file" class = "ImageUpload">
                        </div><br>
                        <label class="label-single" style = "margin-left: 40px;">Description</label><br><br>
                        <textarea  id="description" name="description" cols="30" rows="10" style="width:500px; height:300px;margin-left: 40px;" placeholder="Description of device..."><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                        <div class = "signup-button">
                            <button type="submit" name ="button-submit" style = "margin-left: 5%;">CREATE ELECTRONIC</button>
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