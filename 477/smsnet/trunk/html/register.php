<?php

echo "<p><a href='register.html'>HOME</a> </p>" ;
$username="root";//"dbread";
$password="";//"SMSnet3177";
$server="localhost";//"mydbinstance.cs0o7e6olqxx.us-east-1.rds.amazonaws.com";
$database="csci 477";//"SMSNet";




$pword=$_POST['paword'];
$uname = $_POST['usname'];
$phone=$_POST['phone'];
 

$con=mysql_connect($server,$username,$password);
if (!$con) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
else{
	if ( !mysql_select_db($database))
 	{
		echo "DB created <br/>";
		//$database = "CREATE DATABASE my_db1" ;
		mysql_query($database,$con);
		mysql_select_db($database);
	}
//$sql = "CREATE TABLE Info (First varchar(15),Last varchar(20), Phone varchar(15), Mobile varchar(15),Fax varchar(15),Email varchar(25),Web_Site varchar(30))";
//mysql_query($sql);
	$query = "INSERT INTO user_table (Phone, username, password) VALUES ('$phone','$uname','$pword')";
	mysql_query($query);

} 
$result = mysql_query("SELECT * FROM user_table ")or die(mysql_error());
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
echo "<br/> <br/>";
echo "<table border='1'>
 	<tr>
 		<th>ID number</th>
 		<th>Phone</th>
		<th>User Name</th>
		<th>Password</th>
 	</tr>";
 
while($row = mysql_fetch_array($result))
{
 	echo "<tr>";
   echo "<td>" . $row['ID'] . "</td>";
   echo "<td>" . $row['Phone'] . "</td>";
   echo "<td>" . $row['username'] . "</td>";
   echo "<td>" . $row['password'] . "</td>";
   echo "</tr>";
}	
mysql_close($con);
 
 echo "</table>";
?>

