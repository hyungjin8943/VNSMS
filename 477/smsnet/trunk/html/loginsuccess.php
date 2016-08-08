
<? 
session_start();
if(!session_is_registered(myusername)){
header("location:index.php");
}
?>

<html>
<head>
	<meta http-equiv="refresh" content="2; url=main.html">
	<meta name="keywords" content="automatic redirection">
</head>
<body >

<div align="center">
<br/><br/><br/>
	</div>	
	<div align="center">
	<font size = "10">
	Login was successful <br/>
	
	</font></div>
	
</body>
</html>
