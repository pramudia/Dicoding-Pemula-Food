<?php
include("config.php");
?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
 <head>
  <title>Ajax Table Editing</title>
  <script src="js/jquery.js"></script>	
  <script src="js/script.js"></script>	
  <script src="js/jquery-ui-1.8.17.custom.min.js"></script>	
  <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
 <br>
   <div style="margin-left: 20%;margin-top: 5%;">
	  <input type="button" value="Add Record" id="add_new"><p>
	  <table width="70%" border="0" cellpadding="0" cellspacing="0" class="table-list">
		<tr>
			<th width="20%">First Name</th>
			<th width="20%">Last Name</th>
			<th width="40%">Email</th>
			<th width="20%">Phone Number</th>
			<th width="20%">Delete</th>
		</tr>
		<?php
			$sql = "SELECT * FROM info";
			$q = $conn->prepare($sql);
			$q->execute(array($title));
			$q->setFetchMode(PDO::FETCH_BOTH);
			// fetch
			while($r = $q->fetch()){
				echo '<tr>
						<td>'.$r['fname'].'</td>
						<td>'.$r['lname'].'</td>
						<td>'.$r['email'].'</td>
						<td>'.$r['phone'].'</td>
						<td><a href="#" id="'.$r['id'].'" class="del">Delete</a></td>
					  </tr>';
			}
		?>
	  </table>
	</div>
	<div class="entry-form">
		<form name="userinfo" id="userinfo"> 
		<table width="100%" border="0" cellpadding="4" cellspacing="0">
			<tr>
				<td colspan="2" align="right"><a href="#" id="close">Close</a></td>
			</tr>
			<tr>
				<td>First Name</td>
				<td><input type="text" name="fname"></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type="text" name="lname"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td><input type="text" name="phone"></td>
			</tr>
			<tr>
				<td align="right"></td>
				<td><input type="button" value="Save" id="save"><input type="button" value="Cancel" id="cancel"></td>
			</tr>
		</table>
		</form>
	</div>
 </body>
</html>