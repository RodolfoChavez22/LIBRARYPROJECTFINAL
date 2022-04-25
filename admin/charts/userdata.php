<?php
$connect = new mysqli('localhost', 'root', '', 'library');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$query = "SELECT MONTH(Created) AS Month, COUNT(User_id) AS Total, MONTHNAME(Created) AS MonthName FROM user GROUP BY Month";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'Genre_type'		=>	$row["MonthName"],
				'total'			=>	$row["Total"],
				'color'			=>	'#960C22'
			);
		}

		echo json_encode($data);
	}
}


?>