<?php
	session_start();

	# import functions lib..
	include 'includes/functions.php';

	# determine if user is logged in.
	Utils::checkLogin();

	# include db connection
	include 'includes/db.php';

	# expect incoming request to come with an id..
	if(isset($_GET['bid'])) {
		$bookID = $_GET['bid'];
	}

	# handle delete
	Utils::deleteProduct($conn, $bookID);

	# redirect 
	Utils::redirect('viewproduct.php', "");
