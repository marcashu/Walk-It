<?php
	if (isset($_POST['login-submit'])) {

		require 'databasehandler.inc.php';

		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) || empty($password)) {
			header("Location: ../login.php?error=emptyfields");
			exit();
		}
		else {
			$sql = "SELECT * FROM useraccount WHERE username=?;";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../index.php?error=sqlerror");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($result)) {
					$passwordcheck = password_verify($password, $row['password']);
					if($passwordcheck == false) {
						header("Location: ../login.php?error=wrongpassword");
						exit();
					}
					elseif ($passwordcheck == true) {
						session_start();
						$_SESSION['userid'] = $row['userid'];
						$_SESSION['firstname'] = $row['firstname'];
						$_SESSION['lastname'] = $row['lastname'];
						
						header("Location: ../login.php?login=success");
						exit();
					}
					else {
						header("Location: ../login.php?error=wrongpassword2");
						exit();
					}
				}
				else {
					header("Location: ../login.php?error=invalidusername");
					exit();
				}
			}
		}
	}
	else {
		header("Location: ../index.php");
	}
?>