<?php
session_start();

#include functions file
include 'includes/functions.php';

#check if user is logged in.
Utils::checkLogin();

#page title

$title = "Store: Dashboard";

#include dashboard header
include 'includes/dashboard_header.php';

#connect to database
 include 'includes/db.php';

 
?>


	<div class="wrapper">
		<div id="stream">
		
			<strong>
					
						WEBSITE STATISTICS
						
						
				</strong>
			<table id="tab">
		
				<thead>
					<tr>
						<th></th>
						<th><strong>Number</strong></th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong>Total Number of Categories</strong></td>
						<td><strong><?php echo Utils::rowCount($conn,'category'); ?></strong></td>
						
					</tr>
					<tr>
						<td><strong>Total Number of Products</strong></td>
						<td><strong><?php echo Utils::rowCount($conn,'book'); ?></strong></td>
						
					</tr>
					<tr>
						<td><strong>Total Number of Registers Users</strong></td>
						<td><strong><?php echo Utils::rowCount($conn,'users'); ?></strong></td>
						
					</tr>
					
          		</tbody>
			</table>
		</div>

	</div>
<?php
	
	include 'includes/footer.php';

?>
<?php
	session_start();

	# title
	$title = "Store: Dashboard";

	# include header
	include 'includes/dashboard_header.php';

	# include connection
	include 'includes/db.php';

	# import functions...
	include 'includes/functions.php';
