 <?php 

 $servername = "database-1.chtyezzmtnbf.us-east-1.rds.amazonaws.com";

 $username = "admin"; 

 $password = "admin1234"; 

 $dbname = "ClientDB"; 
 
 $dbport = 3306;

 $conn = new mysqli($servername, $username, $password, $dbname, $dbport);

 if ($conn->connect_error) {

     die("Database Connection failed: " . $conn->connect_error);

 }
 else
 {
	 echo "DB Connection Successful.<br>";
 }

   if (isset($_POST['submit'])) {

     $name = $_POST['name'];

     $address = $_POST['address'];

     $sql = "INSERT INTO `CLIENT_DATA`(`name`, `address`) VALUES ('$name','$address')";

     $result = $conn->query($sql);

     if ($result == TRUE) {
       echo "Record added successfully.";
     }else{
       echo "Error:". $sql . "<br>". $conn->error;
     } 
     
   } 


	$sql = "SELECT ID, Name, Address FROM CLIENT_DATA";

	$result = $conn->query($sql);
	
	$conn->close(); 

 ?>
<!DOCTYPE html>
<html>
<head>
	<style>
		table, th, td {
		  border: 1px dashed black;
		  
		}
	</style>
</head>
  <body>
      <h2>PHP Form</h2>
    <form action="" method="POST">
      <fieldset>
        <legend>Add New</legend>
        Name:
        <input type="text" name="name">        
        Address:
        <input type="text" name="address">
        
        <input type="submit" name="submit" value="Add">
      </fieldset>
    </form>
	<fieldset>
        <legend>View:</legend>
		
		<table style="width:50%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Address</th>
			</tr>
			</thead>
			<tbody>
			<?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

			?>
			<tr>
				<td><?php echo $row['ID']; ?></td>
				<td><?php echo $row['Name']; ?></td>
				<td><?php echo $row['Address']; ?></td>
			</tr>
			 <?php  
				}
            }
			?> 
			</tbody>
		</table>	
		
	</fieldset>
	
  </body>
</html>