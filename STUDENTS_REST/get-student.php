<?php
	include_once('db_connection.php');
	$admission_number = isset($_GET['admission_number']) ? mysqli_real_escape_string($conn, $_GET['admission_number']) :  "";
	//Select Student
	$sql = "SELECT * FROM `students`.`students` WHERE admission_number='{$admission_number}';";
	$get_data_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if(mysqli_num_rows($get_data_query)!=0){
		$result = array();
		
		while($r = mysqli_fetch_array($get_data_query)){
			extract($r);
			$result[] = array('admission_number'=>$admission_number,'student_name'=>$student_name,'course'=>$course,
			'year'=>$year,'semester'=>$semester,'email'=>$email,'phonenumber'=>$phonenumber,
			'address'=>$address,'code'=>$code,'entry_points'=>$entry_points);
		}
		$json = array("status" => 1, "info" => $result);
	}
	else{
		$json = array("status" => 0, "error" => "Student not found!");
	}
@mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);
?>