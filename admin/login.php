<?php
	session_start();
	include 'includes/conn.php';
	function debug_to_console($data) {
		$output = $data;
		if (is_array($output))
			$output = implode(',', $output);
	
		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}
	debug_to_console("Test");
	
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM admin WHERE username = '$username'";
		debug_to_console("Test");
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			debug_to_console("Test");
			$_SESSION['error'] = 'Cannot find account with the username';
		}
		else{
			debug_to_console("Test");
			$row = $query->fetch_assoc();
			debug_to_console("Test");
			echo $password;
			echo $row['password'];
			if(str_contains($password, settype($row['password'],"string"))){
				$_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}

	header('location: index.php');

?>