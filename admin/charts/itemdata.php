<?php
session_start();
$connect = new mysqli('localhost', 'root', '', 'library');
$MonthCheck = "'".$_SESSION['DashAmount']."'";
if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
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

				$result = $connect->query($query);

				$data = array();

				foreach($result as $row)
				{
				if(!empty($row["Name"])){
					$data[] = array(
						'Item_type'		=>	$row["Name"],
						'total'			=>	$row["Total"],
						'color'			=>	'#960C22'
					);
				}
				}
				echo json_encode($data);
	}
}


?>