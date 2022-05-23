<?php
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = filter_input(INPUT_POST, 'username');
	$passwd = filter_input(INPUT_POST, 'passwd');
	$remember = filter_input(INPUT_POST, 'remember');

	//echo password_verify('admin', '$2y$10$RnDwpen5c8.gtZLaxHEHDOKWY77t/20A4RRkWBsjlPuu7Wmy0HyBu'); exit;

	$db = getDbInstance();

	$db->where("user_name", $username);

	$row = $db->get('admin_accounts');

	if ($db->count >= 1) {

		$db_password = $row[0]['password'];
		$user_id = $row[0]['id'];

		if (password_verify($passwd, $db_password)) {

			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['admin_type'] = $row[0]['admin_type'];
			$_SESSION['username'] = $username;

			$query = ("SELECT id FROM admin_accounts WHERE user_name = '" . $username . "'");
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)) {

				$_SESSION['id'] = $row['id'];
			}
			if ($remember) {

				$series_id = randomString(16);
				$remember_token = getSecureRandomToken(20);
				$encryted_remember_token = password_hash($remember_token, PASSWORD_DEFAULT);


				$expiry_time = date('Y-m-d H:i:s', strtotime(' + 30 days'));

				$expires = strtotime($expiry_time);

				setcookie('series_id', $series_id, $expires, "/");
				setcookie('id', $id, $expires, "/");
				setcookie('remember_token', $remember_token, $expires, "/");

				$db = getDbInstance();
				$db->where('id', $user_id);

				$update_remember = array(
					'series_id' => $series_id,
					'remember_token' => $encryted_remember_token,
					'expires' => $expiry_time
				);
				$db->update("admin_accounts", $update_remember);
			}

			header('Location:index.php');
		} else {

			$_SESSION['login_failure'] = "Username ou palavra-passe incorreto!";
			header('Location:login.php');
		}

		exit;
	} else {
		$_SESSION['login_failure'] = "Username ou palavra-passe incorreto!";
		header('Location:login.php');
		exit;
	}
} else {
	die('Method Not allowed');
}
