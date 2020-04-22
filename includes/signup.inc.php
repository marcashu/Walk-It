<?php
	if (isset($_POST['signup-submit'])) {
		
		require 'databasehandler.inc.php';

		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$passwordrepeat = $_POST['passwordrepeat'];
		$email = $_POST['email'];

		//mysqli_query($conn, $sql);

		if (empty($username) || empty($firstname) || empty($lastname) || empty($password) || empty($email) || empty($passwordrepeat)){

			header("Location: ../register.php?error=emptyfields");
			exit();
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../register.php?error=invalidmail");
			exit();
		}
		elseif ($password !== $passwordrepeat) {
			header("Location: ../register.php?error=passwordcheck");
			exit();
		}
		//prepared statement error handling as its safer as user cannot corrupt the code
		else {
			$sql = "SELECT username FROM useraccount WHERE username=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../register.php?error=sqlerror");
				exit();
			} 
			else {
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				if($resultcheck > 0) {
					header("Location: ../register.php?error=usertaken");
					exit();
				}
				else {
					$sql = "INSERT INTO useraccount(firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../register.php?error=sqlerror2");
					exit();
					}
					else {
						#password encryption/ hashing
						$hashedpassword = password_hash($password, PASSWORD_DEFAULT);

						mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $username, $hashedpassword, $email);
						mysqli_stmt_execute($stmt);
						header("Location: ../register.php?signup=success");
						exit();
					}
				}
			}
		}
		
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		}
		else {
			header("Location: ../register.php?error=usertaken");
			exit();
	}
?>