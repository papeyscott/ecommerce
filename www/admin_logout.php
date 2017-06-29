<?php

		unset($_SESSION['id']);
		unset($_SESSION['email']);

		header("Location:admin_login.php");
?>
