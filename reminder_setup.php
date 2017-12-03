<?php
include('database.inc.php'); // Our database connectivity file
if($_POST['step'] != '1')
{
?>
<html>
<head><title>Dodaj dogodek</title></head>
<body>
<form name="setup_reminder" action="reminder_setup.php" method="post">
<table border='0' align='center'>
<tr>
<td>Ime in priimek stranke:</td>
<td>
<input name="reminder_name" type="text" maxlength="255" />
</td>
</tr>
<tr>
<td>Telefonska Ĺˇtevilka:</td>
<td>
<input name="reminder_number" type="text" maxlength="20" />
</td>
</tr>
<tr>
<td>Description</td>
<td>
<textarea name="reminder_desc" rows="5" /></textarea>
</td>
</tr>
<tr>
<td>Trigger Date</td>
<td>
<select name="reminder_year">
<?php
$current_year = date("Y");
for($counter=$current_year;$counter<=$current_year+2;$counter++)
{
echo("\n<option>$counter</option>");
}
?>
</select>
<select name="reminder_month">
<?php
for($counter=1;$counter<=12;$counter++)
{
if($counter < 10)
$prefix = "0";
else
$prefix = "";
echo("\n<option>$prefix$counter</option>");
}
?>
</select>
<select name="reminder_date">
<?php
for($counter=1;$counter<=31;$counter++)
{
if($counter < 10)
$prefix = "0";
echo("\n<option>$prefix$counter</option>");
}
?>
</select>
</td>
</tr>
<tr>
<td> </td>
<td>
<input name="step" type="hidden" value="1" />
<input name="submit" type="submit" value="add" />
</td>
</tr>
</table>
</form>
</body>
</html>
<?php
}
else
{
$error_list = "";
$todays_date = date( "Ymd" );
$reminder_date = $_POST['reminder_year'].$_POST['reminder_month'].$_POST['reminder_date'];
if( empty($_POST['reminder_name']) )
$error_list .= "No Reminder Name<br />";
if( !checkdate( $_POST['reminder_month'], $_POST['reminder_date'], $_POST['reminder_year'] ))
$error_list .= "Reminder Date is invalid<br />";
else if( $reminder_date <= $todays_date )
$error_list .= "Reminder Date is not a future date<br />";
if( empty( $error_list ) )
{
// No error let's add the entry
mysql_query( "INSERT INTO reminder_events(`reminder_name`,`reminder_number`, `reminder_desc`, `reminder_date`) VALUES('".addslashes($_POST['reminder_name'])."','".addslashes($_POST['reminder_number'])."', '".addslashes($_POST['reminder_desc'])."', '".addslashes($reminder_date)."')" );
// Let's go to the Reminder List page
Header("Refresh: 1;url=reminder_list.php");
echo <<< _HTML_END_
Reminder Added, redirecting ...
_HTML_END_;
}
else
{
// Error occurred let's notify it
echo( $error_list );
}
}
?>
