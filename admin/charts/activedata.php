<?php
$connect = new mysqli('localhost', 'root', '', 'library');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
        $query = "SELECT User AS UID, COUNT(User) AS Total, Username FROM reservation 
                    INNER JOIN user ON User = User_id GROUP BY User ORDER BY Total DESC LIMIT 5";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'Active_type'		=>	$row["Username"],
				'total'			=>	$row["Total"],
				'color'			=>	'#960C22'
			);
		}

		echo json_encode($data);
	}
}


?>