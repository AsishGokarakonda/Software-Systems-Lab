<?php session_start(); /* Starts the session */
	
	if(isset($_POST['Submit'])){
        $correct_username='eval';
        $correct_password='eva';
		if(isset($_POST['Username'])){
            $Username=$_POST['Username'];
        }
        else{
            $Username='';
        }
        if(isset($_POST['Password'])){
            $Password=$_POST['Password'];
        }
        else{
            $Password='';
        }	
		if(($correct_username == $Username) && ($correct_password == $Password)){
			$_SESSION['Username']=$correct_username;
            $_SESSION['Password']=$correct_password;
			header("location:album.php");
			exit;
		} else {
			$msg ="<span style='color:white;text-align:center'>Invalid Login Details</span>";
		}
	}
?>