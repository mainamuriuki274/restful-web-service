<?php
include_once('db_connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Get data from the REST client
	$admission_number = isset($_POST['admission_number']) ? mysqli_real_escape_string($conn, $_POST['admission_number']) : "";
	$student_name = isset($_POST['student_name']) ? mysqli_real_escape_string($conn, $_POST['student_name']) : "";
	$course = isset($_POST['course']) ? mysqli_real_escape_string($conn, $_POST['course']) : "";
	$year = isset($_POST['year']) ? mysqli_real_escape_string($conn, $_POST['year']) : "";
	$semester = isset($_POST['semester']) ? mysqli_real_escape_string($conn, $_POST['semester']) : "";
	$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : "";
	$phonenumber = isset($_POST['phonenumber']) ? mysqli_real_escape_string($conn, $_POST['phonenumber']) : "";
	$address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : "";
	$code = isset($_POST['code']) ? mysqli_real_escape_string($conn, $_POST['code']) : "";
	$entry_points = isset($_POST['entry_points']) ? mysqli_real_escape_string($conn, $_POST['entry_points']) : "";

	// Insert data into database
	$sql = "INSERT INTO `students`.`students` (`admission_number`, `student_name`, `course`, `year`, `semester`, `email`, `phonenumber`, `address`, `code`, `entry_points`) 
	VALUES ('$admission_number','$student_name','$course','$year','$semester','$email','$phonenumber','$address','$code','$entry_points');";
	$post_data_query = mysqli_query($conn, $sql);
	if($post_data_query){
		$json = array("status" => 1, "Success" => "Student has been added successfully!");
	}
	else{
		$json = array("status" => 0, "Error" => "Error adding Student! Please try again!");
	}
}
else{
	$json = array("status" => 0, "Info" => "Request method not accepted!");
}
@mysqli_close($conn);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);
?>