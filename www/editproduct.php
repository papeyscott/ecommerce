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

	# check or query string in incoming request
	if(isset($_GET['bid'])) {
		$bookID = $_GET['bid'];
	}

	# get a book obj
	$item = Utils::getBookByID($conn, $bookID);

	# get the category for this item
	$category = Utils::getCategoryByID($conn, $item['category_id']);

	# track errors
	$errors = [];

	# be sure if the user clicked the submit button
	if(array_key_exists('edit', $_POST)) {
		if(empty($_POST['title'])) {
			$errors['title'] = "please enter a book title";
		}

		if(empty($_POST['author'])) {
			$errors['author'] = "please enter author name";
		}

		if(empty($_POST['price'])) {
			$errors['price'] = "please enter a price";
		}

		if(empty($_POST['year'])) {
			$errors['year'] = "Enter Year Of Publication";
		}

		if(empty($_POST['isbn'])) {
			$errors['isbn'] = "Enter Book's ISBN";
			}

	 	if(empty($_POST['cat'])){

	 			$errors['cat'] = "please select a category";

	 	}
		
		# if everything is OK...
		if(empty($errors)) {

			$clean = array_map('trim', $_POST);

			$clean['bid'] = $bookID;


			# do insert and redirect...
			Utils::doAddProduct($conn, $clean);

			Utils::redirect('viewproduct.php', "");
		}
	}

?>

<div class="wrapper">
	<div id="stream">
		
		<h1 id="register-label">Edit Product</h1>
		<hr>
		<form id="register"  action ="<?php echo "editproduct.php?bid=".$bookID; ?>" method ="POST" ">
			<div>
				<?php Utils::displayError('title', $errors); ?>
				<label>title:</label>
				<input type="text" name="title" placeholder="title" value="<?php echo $item['title']; ?>">
			</div>

			<div>
				<?php Utils::displayError('author', $errors); ?>
				<label>Author:</label>
				<input type="text" name="author" placeholder="Author" value="<?php echo $item['author']; ?>">
			</div>

			<div>
				<?php Utils::displayError('price', $errors); ?>
				<label>Price:</label>
				<input type="text" name="price" placeholder="Price" value="<?php echo $item['price']; ?>">
			</div>

			<div>
				<?php Utils::displayError('year', $errors); ?>
				<label>Year Of Publication</label>
					<input type="text" name="year" placeholder="Enter Year of Publication" value="<?php echo $item['year']; ?>">
			</div>

			<div>
			<?php Utils::displayError('isbn', $errors); ?>
			<label>ISBN</label>
				<input type="text" name="isbn" placeholder="Enter Book's ISBN" value="<?php echo $item['isbn']; ?>">
			</div>

			<div>
				<?php Utils::displayError('cat', $errors); ?>
				<label>Select Category:</label>
				<select name="cat">
				<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
					<?php
						Utils::fetchCategories($conn, null, function($data) {
							$result = "";

							while ($row = $data->fetch(PDO::FETCH_BOTH)) {
								$result .= '<option value="'.$row[0].'">'.$row[1].'</option>';
							}

							echo $result;
						});
					?>
				</select>
			</div>

			<input type="submit" name="edit" value="edit">

		</form>
			<h4 class="jumpto">Upload new image: <a href="<?php echo "changeimage.php?bid=".$item['book_id'];?>">change</a></h4>

	</div>
</div>


<?php
	
	include 'includes/footer.php';

?>
