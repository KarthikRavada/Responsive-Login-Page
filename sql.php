<?php
$con=mysqli_connect('localhost:3308','root','','New');
if(!$con)
{
	echo "Failed";
}
else
{

	$sql1 = "CREATE TABLE Data(
			Username varchar(50) primary key,
			Name varchar(20) not null,
			Phone_Number varchar(10) not null  Unique,
			Email varchar(50) not null Unique,
			reg_date Timestamp Default current_timestamp on update current_timestamp,
			Password  varchar(32)
)";
	$sql2 = "INSERT INTO Data (Username,Name,Phone_Number,Email,Password) Values (?,?,?,?,?)";
	$stmt = $con->prepare($sql2);
	$stmt->bind_param("sssss",$username,$name,$Pn,$email,$pas);
	if($_POST)
	{
		$username = $_POST['Username'];
		$name = $_POST['Name'];
		$Pn = $_POST['Phone_Number'];
		$email = $_POST['Email'];
		$pas = md5($_POST['Password']);
		$stmt->execute();
		$qry = $con->query("SELECT * FROM Data");
		echo '<table style="width:80%">';
		echo "<tr>";
		echo "<th>Username</th>";
		echo "<th>Name</th>";
		echo "<th>Phone Number</th>";
		echo "<th>Email</th>";
		echo "<th> Time Created</th>";
		echo "</tr>";
		while($excute=$qry->fetch_assoc())
		{
			echo "<tr>";
			echo "<td>".$excute['Username']."</td>"."<td>".$excute['Name']."</td>"."<td>".$excute['Phone_Number']."</td>"."<td>".$excute['Email']."</td>"."<td>".$excute['Password']."</td>"."<td>".$excute['reg_date']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else
	{
		echo "Post not working";
	}
	}
mysqli_close($con);
?>