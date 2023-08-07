<?php 
if (isset($_POST['login'])){
	
	$email = $_POST['email'];
	$pass =$_POST['password'];
	
	if($email == 'admin@gmail.com' && $pass=='admin123' ){
		
		session_start();
		$_SESSION['login']= true;
		header('Location: ../admin/dashboard.php');
		
	} else{
		
		
	echo('invalid credentials');
		
		
	}
	
}
?>