<?php
$connect = new mysqli('localhost', 'root', '', 'library');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
        $query = "SELECT User_id , Balance AS Total, Username FROM user GROUP BY User_id ORDER BY Total DESC LIMIT 5";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'Fine_type'		=>	$row["Username"],
				'total'			=>	$row["Total"],
				'color'			=>	'#960C22'
			);
		}

		echo json_encode($data);
	}
}


?>