<?php
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['psw'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['psw']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM etudiants WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
            	$_SESSION['username'] = $row['username'];
            	header("Location: index1.html");
		        exit();
            }else{
            	header("Location: erreur.html");
		        exit();
			}
		}else{
			header("Location: erreur.html");
	        exit();
		}
	}
	

}else{
	header("Location: index1.html");
	exit();
}
?>