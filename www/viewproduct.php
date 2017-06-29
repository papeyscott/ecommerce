<?php
	session_start();
	
	# import functions lib..
	include 'includes/functions.php';

	# determine if user is logged in.
	Utils::checkLogin();

	# title
	$title = "Store: View Product";

	# include dashboard header
	include 'includes/dashboard_header.php';

	# include db connection
	include 'includes/db.php';
?>

<div class="wrapper">
	<div id="stream">
		<table id="tab">
				<thead>
					<tr>
						<th>Title</th>
						<th>author</th>
						<th>price</th>
						<th>year</th>
						<th>isbn</th>
						<th>cover</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					
					<?php 
						$listProducts = Utils::viewProducts($conn);
						echo $listProducts;
					?>
          		</tbody>
			</table>
	</div>
</div>

<?php
	
	include 'includes/footer.php';

?>
