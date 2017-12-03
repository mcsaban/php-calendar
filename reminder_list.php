<?php
include('database.inc.php'); // Our database connectivity file
if( empty($_GET['reminder_id']) )
{
?>
<html>
<head><title>List of Reminders</title></head>
<body>
<table width="90%" border="0" align="center">
<tr>
<td colspan='3'><a href='reminder_setup.php'>Add new Reminder</a></td>
</tr>
<?php
$result = mysql_query( "SELECT * FROM reminder_events" );
$nr = mysql_num_rows( $result );
if(empty($nr))
{
echo("
<tr>
<td colspan='3'>No Reminders setup</td>
</tr>
");
}
while( $row = mysql_fetch_array( $result ))
{
$reminder_name = $row["reminder_name"];
$reminder_number = $row["reminder_number"];
$reminder_date = $row["reminder_year"]."-".$row["reminder_month"]."-".$row["reminder_date"];
$reminder_id = $row["reminder_id"];
echo("
<tr>
<td width='60%'>$reminder_name</td>
<td width='60%'>$reminder_number</td>
<td width='30%'>$reminder_date</td>
<td width='10%'><a href='reminder_list.php?reminder_id=$reminder_id'>delete</a></td>
</tr>
");
}
mysql_free_result( $result );
?>
</table>
</body>
</html>
<?php
}
else
{
mysql_query( "DELETE FROM reminder_events WHERE reminder_id='".addslashes($_GET['reminder_id'])."'" );
// Let's go back to the Reminder List page
Header("Refresh: 1;url=reminder_list.php");
echo <<< _HTML_END_
Reminder Deleted, redirecting...
_HTML_END_;
}
?>
