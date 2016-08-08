<html>
<body>
<?php
$username="dbread";
$password="SMSnet3177";
$server="mydbinstance.cs0o7e6olqxx.us-east-1.rds.amazonaws.com";
$database="SMSNet";

$query = "select Id, Project, Time, Location, Sender, TagStd, TagValue from Message_Table m join Tag_Table t on m.ID = t.Message;";

mysql_connect($server,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$result = mysql_query($query);
$num = mysql_numrows($result);
mysql_close();
?>

<table border="0" cellspacing="2" cellpadding="2">
<tr>
<td><font face="Arial, Helvetica, sans-serif">Id</font></td>
<td><font face="Arial, Helvetica, sans-serif">Project</font></td>
<td><font face="Arial, Helvetica, sans-serif">Time</font></td>
<td><font face="Arial, Helvetica, sans-serif">Location</font></td>
<td><font face="Arial, Helvetica, sans-serif">Sender</font></td>
</tr>

<?php
$i=0;
while ($i < $num) {

$f1=mysql_result($result,$i,"Id");
$f2=mysql_result($result,$i,"Project");
$f3=mysql_result($result,$i,"Time");
$f4=mysql_result($result,$i,"Location");
$f5=mysql_result($result,$i,"Sender");
$f6=mysql_result($result,$i,"TagValue");
?>

<tr>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f5; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><?php echo $f6; ?></font></td>
</tr>

<?php
$i++;
}
?>
</body>
</html>
