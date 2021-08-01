<?php
require_once 'utils.php';
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$con = connection();
	if ($con) {
		$hourAgo = time() - 60 * 60;
		$res = sqlSelect($con, 'SELECT id,password FROM users WHERE email=?', 's', $email);

		if ($res && $res->num_rows === 1) {
			$user = $res->fetch_assoc();
			if (password_verify($password, $user['password'])) {
				// Log user in
				$_SESSION['loggedin'] = true;
				$_SESSION['userID'] = $user['id'];
				echo 0;
			} else {
				echo 1;
			}
			$res->free_result();
		} else {
			echo 1;
		}
		$con->close();
	} else {
		echo 2;
	}
} else {
	echo 1;
}
