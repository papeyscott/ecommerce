<?php
	session_start();

	# import functions lib..
	include 'includes/functions.php';

	# determine if user is logged in.
	Utils::checkLogin();

	# title
	$title = "Store: Edit Product";

	# include dashboard header
	include 'includes/dashboard_header.php';

	# include db connection
	include 'includes/db.php';


		if(isset($_GET['bid'])){
			$bkid = $_GET['bid'];
			}
			
		# error caching
		$errors = [];

		define("MAX_FILE_SIZE", "2097152");

		$ext = ["image/jpg", "image/jpeg", "image/png"];

		if(array_key_exists('save', $_POST)) {

			# was a file selected...?
		if(empty($_FILES['img']['name'])) {
			$errors['img'] = "Please select a file";
		}

		# is size OK...
		if($_FILES['img']['size'] > MAX_FILE_SIZE) {
			$errors['img'] = "File size too large. allowed:2mb";
		}

		# check format
		if(!in_array(strtolower($_FILES['img']['type']), $ext)) {
			$errors['img'] = "File format not supported.";
		}

		# upload the ffile
	    $check = Utils::uploadFile("uploads/", $_FILES, "img");

		if($check[0]){
			$destination = $check[1];
		} else {
			$errors['img'] = "Files not uploaded";
		}

 			if(empty($errors)){
 				$clean = array_map('trim', $_POST);
				$clean['loc'] = $destination;

 				Utils::editProductImage($conn, $clean, $destination);
 				utils::redirect("viewproduct.php");
 			}

 			
	}
?>		
		<div class="wrapper">
		<div id="stream">	
		
			<form id="register" action = "" method ="POST" enctype="multipart/form-data">
				
				<div>
				<?php Utils::displayError('img', $errors); ?>
				<label>Select an image:</label>
				<input type="file" name="img">
			</div>

				<input type="submit" name="save" value="Edit">
			</form>

			</div>
			</div>

<?php
		# inlude footer
		include 'includes/footer.php';
?>

