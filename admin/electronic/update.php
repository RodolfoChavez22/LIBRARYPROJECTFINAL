<?php
    include_once '../../header.php';
    //Redirect if the user is not a admin
    if($_SESSION['User_Status'] != 'admin'){header("Location: ../../homepage");}
    //Initialize Datalist entries for duplicates
    $DataArray = array();
    //Select non-dynamic Variables from updateid
    $id=$_GET['electronicid'];
    $sql="SELECT electronic.Electronic_id, electronic.Brand, electronic.Name, electronic.Rental_status, electronic.Model, electronic.Release_date, electronic.Deleted_id, electronic.Img, electronic.Description,
                    brand.Brand_id, brand.Brand_name AS BrandName, electronic.Type,
                    etype.ET_id, etype.Electronic_type AS ElectronicType
                    FROM electronic 
                    INNER JOIN brand ON brand.Brand_id = electronic.Brand
                    INNER JOIN etype ON etype.ET_id = electronic.Type
                    WHERE Electronic_id=$id";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    $Name=$row['Name'];
    $Type=$row['ElectronicType'];
    $Rental=$row['Rental_status'];
    $Brand=$row['BrandName'];
    $Model=$row['Model'];
    $Date=$row['Release_date'];
    $Img=$row['Img'];
    $Description=$row['Description'];
    //Select Dynamic Variables from updateid

    //Record User input for dynamic variables
    if(isset($_REQUEST['button-submit'])){
        //Record User input for non-dynamic inputs
        $Name = $_REQUEST['name'];
        $Type = $_REQUEST['etype'];
        $Rental = $_REQUEST['rental'];
        $Brand = $_REQUEST['brand'];
        $Model = $_REQUEST['model'];
        $Date = $_REQUEST['date'];
        if (isset($_POST['description'])) {$Description = $_POST['description'];}
        //Error Handles
        if(isset($_REQUEST['button-submit'])){
            if(empty($Type)){$errorMsg[1] = 'Type Required';}
            if(empty($Type)){$errorMsg[2] = 'Brand Required';}
            if(empty($Type)){$errorMsg[3] = 'Model Required';}
            if(empty($Name)){$errorMsg[4] = 'Name Required';}
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
            }
            //Prepared SQL Statements
            if(empty($errorMsg)){
                if(empty($errorMsg)){
                    $sql = "SELECT Brand_name, Brand_id FROM brand WHERE Brand_name=?";
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

                    $sql = "SELECT Electronic_type, ET_id FROM etype WHERE Electronic_type=?";
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

                    //Update into electronic table
                    if(!empty($fileNameNew)){
                        $Img = '../../img/' . $Img;
                        unlink($Img);
                        $Img = $fileNameNew;
                    }

                    $sql = "UPDATE electronic SET Name = ?, Type = ?, Brand = ?, Model = ?, Release_date = ?, Rental_Status = ?, Img = ?, Description = ? WHERE Electronic_id = $id";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt,$sql)){echo "SQL statement failed";}
                    else{
                        mysqli_stmt_bind_param($stmt, "siisssss", $Name, $Type, $Brand, $Model, $Date, $Rental, $Img, $Description);
                        mysqli_stmt_execute($stmt);
                    }

                    header("location: ../electronics?update");
                }
            }
        }
    }
?>

<head>
    <title>Update Electronic</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<div class="page-content">
    <div class = "display-body">
        <form  action = "" method="POST" class="add-form" id="add-form" enctype="multipart/form-data" style = "width: 60%;">
            <h3 class="add-header">Update Electronic</h3>
            <div class = "add-input">
                <div class= "add-genre">
                    <div class="add-margin">
                        <div class = "add-form-types">
                            <label class="label-single">Name of Electronic</label><br>
                            <?php if(isset($errorMsg[4])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[4]."</p>";}?>
                            <input type="text" placeholder="Electronic name..." class="input-single" name="name" value="<?php echo $Name;?>"><br>
                            <label class="label-single">Type</label><br>
                            <?php if(isset($errorMsg[1])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[1]."</p>";}?>
                            <input list="listType" class = "datalist" name="etype" placeholder="Type..."
                                <?php
                                    if(!empty($Type )){
                                        echo 'value = "'.$Type.'"';
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

                            <label class="label-single">Brand</label><br>
                            <?php if(isset($errorMsg[2])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[2]."</p>";}?>
                            <input list="listBrand" class = "datalist" name="brand" placeholder="Brand..."
                                <?php
                                    if(!empty($Brand )){
                                        echo 'value = "'.$Brand.'"';
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
                            <?php if(isset($errorMsg[3])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[3]."</p>";}?>
                            <input type="text" class="input-single" name="model" value="<?php echo $Model; ?>"><br>

                            <label class="label-single">Release Date</label><br>
                            <?php if(isset($errorMsg[8])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[8]."</p>";}?>
                            <input type="date" class="input-single" name="date" value="<?php echo $Date; ?>"><br>
                            <label class="label-single">Rental Amount</label><br>
                            <?php if(isset($errorMsg[9])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[9]."</p>";}?>
                            <input type="text" placeholder="1..." class="input-single" name="rental" value="<?php echo $Rental; ?>"><br>
                        </div>
                        <div class = "add-image">
                            <?php if(isset($errorMsg[10])){echo "<p style='color:red; font-size:15px; margin-top: 5px; margin-left: 10px;'>".$errorMsg[10]."</p>";}?>
                            <input type="file" name="file" class = "ImageUpload">
                            <label class="label-single" style="margin-left: 150px;">Current Image</label>
                        </div>
                        <label class="label-single">Description</label><br>
                        <img src=../../img/<?php echo $Img; ?> width=200 height=320 style = "margin-left: 680px; margin-top: -40px; border: 3px solid #54585A; border-radius: 5px;"></img><br>
                        <textarea  id="description" name="description" cols="30" rows="10" style="width:500px; height:300px; margin-top: -260px;"><?php echo htmlspecialchars($Description); ?></textarea>
                        <div class = "signup-button">
                            <button type="submit" name ="button-submit" style = "margin-left: 5%;">UPDATE ELECTRONIC</button>
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