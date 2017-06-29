<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;  ?></title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
	<section>
		<div class="mast">
			<h1>T<span>SSB</span></h1>
		</div>
			<nav>
				<ul class="clearfix">
					<li><a href="addcategory.php" <?php Utils::curNav("addcategory.php"); ?>>add category</a></li>
					<li><a href="view_category.php" <?php Utils::curNav("view_category.php"); ?>>view category</a></li>
					<li><a href="addproduct.php" <?php Utils::curNav("addproduct.php"); ?>>add product</a></li>
					<li><a href="viewproduct.php" <?php Utils::curNav("viewproduct.php"); ?>>view product</a></li>
				</ul>
			</nav>
		</div>
	</section>

</body>
</html>
