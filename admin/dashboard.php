<?php
    include_once 'adminpanel.php';
    if(isset($_POST["dashamount"])){
        $_SESSION['DashAmount'] = $_POST["dashamount"];
    }
    if(empty($_SESSION['DashAmount'])){
        $_SESSION['DashAmount'] = 'April';
    }
?>
    <head2>
        <title>Dashboard</title> <link rel="stylesheet" href="../style.css"> <link rel="stylesheet" href="astyle.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    </head2>
    <div class="content">
        <form class="admin-form">
            <h2 style = "text-align:center;">Dashboard</h2>
        </form>
        <?php
            $sql="SELECT COUNT(*) FROM user WHERE Deleted_id = 0";
            $result = mysqli_query($con,$sql);
            $size = mysqli_fetch_assoc($result)['COUNT(*)'];
        ?>
        <button class="dash-item" onclick="location.href='users';">
            <i><span style="font-size:50px; display: block;" class="material-icons-outlined" id ="icon" onclick="toggle()">group</span></i>
            Total Users: <?php echo $size ?>
        </button>
        <?php
            $sql="SELECT COUNT(*) FROM reservation WHERE Status = 1";
            $result = mysqli_query($con,$sql);
            $size = mysqli_fetch_assoc($result)['COUNT(*)'];
        ?>
        <button class="dash-item" onclick="location.href='request';">
            <i><span style="font-size:50px; display: block;" class="material-icons-outlined" id ="icon" onclick="toggle()">local_library</span></i>
            Current Requests: <?php echo $size ?>
        </button>
        <?php
            $sql="SELECT COUNT(*) FROM loan WHERE Returned = 0";
            $result = mysqli_query($con,$sql);
            $size = mysqli_fetch_assoc($result)['COUNT(*)'];
        ?>
        <button class="dash-item" onclick="location.href='loans';">
            <i><span style="font-size:50px; display: block;" class="material-icons-outlined" id ="icon" onclick="toggle()">auto_stories</span></i>
            Current Loans: <?php echo $size ?>
        </button>
        <?php
            $sql="SELECT COUNT(*) FROM loan WHERE Returned = 1";
            $result = mysqli_query($con,$sql);
            $size = mysqli_fetch_assoc($result)['COUNT(*)'];
        ?>
        <button class="dash-item" onclick="location.href='loanreport';">
            <i><span style="font-size:50px; display: block;" class="material-icons-outlined" id ="icon" onclick="toggle()">menu_book</span></i>
            Returned Loans: <?php echo $size ?>
        </button>
        <?php
            $size = 0;
            $sql="SELECT COUNT(*) FROM user WHERE Deleted_id = 0";
            $result = mysqli_query($con,$sql);
            $size += mysqli_fetch_assoc($result)['COUNT(*)'];
            $sql="SELECT COUNT(*) FROM book WHERE Deleted_id = 0";
            $result = mysqli_query($con,$sql);
            $size += mysqli_fetch_assoc($result)['COUNT(*)'];
            $sql="SELECT COUNT(*) FROM journal WHERE Deleted_id = 0";
            $result = mysqli_query($con,$sql);
            $size += mysqli_fetch_assoc($result)['COUNT(*)'];
            $sql="SELECT COUNT(*) FROM disk WHERE Deleted_id = 0";
            $result = mysqli_query($con,$sql);
            $size += mysqli_fetch_assoc($result)['COUNT(*)'];
        ?>
        <button class="dash-item" onclick="location.href='../find';">
            <i><span style="font-size:50px; display: block;" class="material-icons-outlined" id ="icon" onclick="toggle()">library_books</span></i>
            Total Items: <?php echo $size ?>
        </button>

        <style>
            .charts{
                width:30%;
                border: 3px solid rgba(0, 0, 0, .6);
                border-radius: 5px;
                margin-top: 20px;
                margin: 0px 10px;
                display: inline-block;
            }

            .chart-divider{
                border-top: 3px solid rgba(0, 0, 0, .1);
                width:100%;
                margin: 80px 0;
            }

            .chart-box{
                text-align: center;
            }
        </style>
        <div class = "chart-divider"></div>
        <div class ="chart-box">
            <div class = "charts">
                <?php include_once 'charts/userindex.php'; ?>
                <table class = "content-table">
                        <thread>
                            <tr>
                                <th>Month</th>
                                <th>User Registration</th>
                            </tr>
                        </thread>
                        <?php
                            $query = "SELECT MONTH(Created) AS Month, COUNT(User_id) AS Total, MONTHNAME(Created) AS MonthName FROM user GROUP BY Month";
                            $result = $con->query($query);
                            foreach($result as $row){
                                echo '                    
                                <tbody style = "font-size: 12px;">
                                    <tr>
                                        <td> <s style="padding:5px 7px; border-radius: 5px; border: none">'.$row['MonthName'].'</s> </td>
                                        <td> <s style="padding:5px 7px; border-radius: 5px; border: none">'.$row['Total'].'</s> </td>
                                    </tr>
                                </tbody>';
                            }
                        ?>
                </table>
            </div>
            
            <div class = "charts">
                <?php include_once 'charts/activeindex.php'; ?>
                <table class = "content-table">
                        <thread>
                            <tr>
                                <th>Username</th>
                                <th>Total Loans</th>
                            </tr>
                        </thread>
                        <?php
                            $query = "SELECT User AS UID, COUNT(User) AS Total, Username FROM reservation 
                                    INNER JOIN user ON User = User_id GROUP BY User ORDER BY Total DESC LIMIT 5";
                            $result = $con->query($query);
                            foreach($result as $row){
                                echo '                    
                                <tbody style = "font-size: 12px;">
                                    <tr>
                                        <td> <s style="padding:5px 7px; border-radius: 5px; border: none">'.$row['Username'].'</s> </td>
                                        <td> <s style="padding:5px 7px; border-radius: 5px; border: none">'.$row['Total'].'</s> </td>
                                    </tr>
                                </tbody>';
                            }
                        ?>
                </table>
            </div>

            <div class = "charts">
                <?php include_once 'charts/finesindex.php'; ?>
                <table class = "content-table">
                        <thread>
                            <tr>
                                <th>Username</th>
                                <th>Total Fines</th>
                            </tr>
                        </thread>
                        <?php
                            $query = "SELECT User_id , Balance AS Total, Username FROM user GROUP BY User_id ORDER BY Total DESC LIMIT 5";
                            $result = $con->query($query);
                            foreach($result as $row){
                                echo '                    
                                <tbody style = "font-size: 12px;">
                                    <tr>
                                        <td> <s style="padding:5px 7px; border-radius: 5px; border: none">'.$row['Username'].'</s> </td>
                                        <td> <s style="padding:5px 7px; border-radius: 5px; border: none">$'.$row['Total'].'</s> </td>
                                    </tr>
                                </tbody>';
                            }
                        ?>
                </table>
            </div>
            <br>
            <br>
            <div class = "charts" style="width:50%;">
                <form  action = "" method="POST" id="add-form" enctype="multipart/form-data" style="margin-top: 20px; font-size: 20px; margin-bottom: 20px;">
                    <label class="add-label"><b>Month Selected:<b></label>
                        <select name="dashamount" onchange="this.form.submit()" style="padding: 2px; width: 20%;">
                            <?php
                                for($x = 1; $x <= 12; $x+=1){
                                    $dateObj   = DateTime::createFromFormat('!m', $x);
                                    $monthName = $dateObj->format('F');
                                    if($monthName == $_SESSION['DashAmount']){echo '<option selected>'.$monthName.'</option>';}
                                    else{
                                        echo '<option>'.$monthName.'</option>';
                                    }
                                }
                            ?>
                        </select>
                </form>
                <?php include_once 'charts/itemindex.php'; $MonthCheck = "'".$_SESSION['DashAmount']."'"; ?>
                <table class = "content-table">
                        <thread>
                            <tr>
                                <th>Item Name</th>
                                <th>Total Reserves</th>
                            </tr>
                        </thread>
                        <?php
                            $query = "SELECT MONTH(Request_date) AS Month, MONTHNAME(Request_date) AS MonthName, Item,
                            Count(item.Book_id) AS Total, book.Name AS Name
                            FROM reservation 
                            LEFT JOIN item ON item.Item_id = reservation.Item
                            LEFT JOIN book ON item.Book_id = book.Book_id
                            WHERE MONTHNAME(Request_date) = $MonthCheck
                            GROUP BY book.Book_id
                            UNION
                            SELECT MONTH(Request_date) AS Month, MONTHNAME(Request_date) AS MonthName, Item,
                            Count(item.Journal_id) AS Total, journal.Name AS Name
                            FROM reservation 
                            LEFT JOIN item ON item.Item_id = reservation.Item
                            LEFT JOIN journal ON item.Journal_id = journal.Journal_id
                            WHERE MONTHNAME(Request_date) = $MonthCheck
                            GROUP BY journal.Journal_id
                            UNION
                            SELECT MONTH(Request_date) AS Month, MONTHNAME(Request_date) AS MonthName, Item,
                            Count(item.Disk_id) AS Total, disk.Name AS Name
                            FROM reservation 
                            LEFT JOIN item ON item.Item_id = reservation.Item
                            LEFT JOIN disk ON item.Disk_id = disk.Disk_id
                            WHERE MONTHNAME(Request_date) = $MonthCheck
                            GROUP BY disk.Disk_id
                            UNION
                            SELECT MONTH(Request_date) AS Month, MONTHNAME(Request_date) AS MonthName, Item,
                            Count(item.Electronic_id) AS Total, electronic.Name AS Name
                            FROM reservation 
                            LEFT JOIN item ON item.Item_id = reservation.Item
                            LEFT JOIN electronic ON item.Electronic_id = electronic.Electronic_id
                            WHERE MONTHNAME(Request_date) = $MonthCheck
                            GROUP BY electronic.Electronic_id 
                            ORDER BY Total DESC
                            LIMIT 10";

                            $result = $con->query($query);
                            foreach($result as $row){
                                if(!empty($row["Name"])){
                                    echo '                    
                                    <tbody style = "font-size: 12px;">
                                        <tr>
                                            <td> <s style="padding:5px 7px; border-radius: 5px; border: none">'.$row['Name'].'</s> </td>
                                            <td> <s style="padding:5px 7px; border-radius: 5px; border: none">'.$row['Total'].'</s> </td>
                                        </tr>
                                    </tbody>';
                                }
                            }
                        ?>
                </table>
            </div>
        </div>
        <div class = "chart-divider"></div>







        <form class="admin-form">
            <h2 style = "text-align:center;">Recent Changes</h2>
        </form>
        <?php
            //Sort by cols, ASC or DESC
            if(!empty($_GET['sort'])){
                if(!empty($_SESSION["sortby"])){
                    if(strpos($_SESSION["sortby"], 'ASC') !== false){
                        $_SESSION["sortby"] = 'DESC';
                        $sort = 'DESC';
                        $icon = '<i><span class="material-icons-outlined">arrow_drop_down</span></i>';
                    }
                    else{
                        $_SESSION["sortby"] = 'ASC';
                        $sort = 'ASC';
                        $icon = '<i><span class="material-icons-outlined">arrow_drop_up</span></i>';
                    }
                }
            }
            else{
                unset($_SESSION["sortby"]);
                unset($_SESSION['sort']);
                $_GET['sort'] = 'Audit_id';
                $sortby = 'Audit_id';
                $_SESSION["sortby"] = 'DESC'; 
                $sort = 'DESC';
                $icon = '<i><span class="material-icons-outlined">arrow_drop_down</span></i>';
            }
        ?>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
        <table class = "content-table">
        <thread>
                <!--- Moves and alternates the sorting symbol to the correct column --->
                <tr>
                    <th onclick="location.href='dashboard?sort=Audit_id';" onmouseover="" style="cursor: pointer;">ID
                        <?php if($_GET['sort'] == 'Audit_id'){echo $icon; $_SESSION["sort"] = 'Audit_id'; $sortby = $_SESSION["sort"];}?>
                    </th>
                    <th onclick="location.href='dashboard?sort=Type';" onmouseover="" style="cursor: pointer;">Table
                        <?php if($_GET['sort'] == 'Type'){echo $icon; $_SESSION["sort"] = 'Type'; $sortby = $_SESSION["sort"];}?>
                    </th>
                    <th onclick="location.href='dashboard?sort=Type_id';" onmouseover="" style="cursor: pointer;">Table ID
                        <?php if($_GET['sort'] == 'Type_id'){echo $icon; $_SESSION["sort"] = 'Type_id'; $sortby = $_SESSION["sort"];}?>
                    </th>
                    <th onclick="location.href='dashboard?sort=ACTION';" onmouseover="" style="cursor: pointer;">Action
                        <?php if($_GET['sort'] == 'ACTION'){echo $icon; $_SESSION["sort"] = 'ACTION'; $sortby = $_SESSION["sort"];}?>
                    </th>
                    <th onclick="location.href='dashboard?sort=Date';" onmouseover="" style="cursor: pointer;">Date
                        <?php if($_GET['sort'] == 'Date'){echo $icon; $_SESSION["sort"] = 'Date'; $sortby = $_SESSION["sort"];}?>
                    </th>
                </tr>
            <thread>

            <?php
                include '../connect.php';
                $sql="SELECT * FROM audit ORDER BY $sortby $sort LIMIT 15";
                $result = mysqli_query($con,$sql);

                    while($row=mysqli_fetch_assoc($result)){
                        $ID=$row['Audit_id'];
                        $Table=$row['Type'];
                        $TableId=$row['Type_id'];
                        $Action=$row['Action'];
                        if($Action == 'UPDATE'){$Color = 'Blue';}
                        if($Action == 'DELETE'){$Color = 'Red';}
                        if($Action == 'INSERT'){$Color = 'Green';}

                        $Date=$row['Date'];
                        echo '<tr style = "font-size: 25px;">
                            <td>'.$ID.'</td>
                            <td>'.$Table.'</td>
                            <td>'.$TableId.'</td>
                            <td style="color: '.$Color.'">'.$Action.'</td>
                            <td>'.$Date.'</td> 
                        </tr>';
                    }
            ?>
        </table>
    </div>
</section>
</div>

<?php
    include_once '../footer.php';
?>