<?php
ob_start();
$username="root";//"dbread";
$password="";//"SMSnet3177";
$server="localhost";//"mydbinstance.cs0o7e6olqxx.us-east-1.rds.amazonaws.com";
$database="csci 477";//"SMSNet";

// Connect to server and select databse.
mysql_connect("localhost", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$database")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection 
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM user_table WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
header("location:loginsuccess.php");
}
else {
header("location:loginerror.php");
}
?>
