<?php
$connect = new mysqli('localhost', 'root', '', 'library');
$query = "SELECT MONTH(Created) AS Month, COUNT(User_id) AS Total, MONTHNAME(Created) AS MonthName FROM user GROUP BY Month";

$result = $connect->query($query);

while($row=mysqli_fetch_assoc($result)){




    $month = $row['MonthName'];
    echo $month;
    $user = $row['Total'];
        echo $user . '<br>';
}









//$mydate = "2010-05-12 13:57:01";
//$month = date("m",strtotime($mydate));
//echo $month;
?>