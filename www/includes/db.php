<?php

	define("DBNAME", "ecommerce");
	define("DBUSER", "root");
	define("DBPASS", "root");
	define("DBHOST", "localhost");

	try{
		$conn = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASS);
	}catch(PDOException $e){
		echo $e->getMessage();
	}



