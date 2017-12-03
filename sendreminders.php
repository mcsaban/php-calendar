<?php
include('database.inc.php'); // Our database connectivity file
// Values you need set
$number_of_days_before = 1;
$email = "youremail@yourserver.com";
$reminder_details = "";
$todays_date = date( "Ymd" );
$year = substr($todays_date, 0, 4);
$month = substr($todays_date, 4, 2);
$date = substr($todays_date, 6, 2);
$trigger_date = date("Ymd", mktime (0,0,0,$month,$date-$number_of_days_before,$year));
$result = mysql_query( "SELECT * FROM reminder_events WHERE reminder_date <= $trigger_date ORDER BY reminder_date ASC" );
$nr = mysql_num_rows( $result );
while( $row = mysql_fetch_array( $result ) )
{
$year = substr($row["reminder_date"], 0, 4);
$month = substr($row["reminder_date"], 4, 2);
$date = substr($row["reminder_date"], 6, 2);
$reminder_date = date("M j, Y", mktime (0,0,0,$month,$date,$year));
$reminder_details .= "Event: ".$row["reminder_name"]."\n";
$reminder_details .= "Date: ".$reminder_date."\n";
$reminder_details .= $row["reminder_desc"]."\n\n";
}
mysql_free_result( $result );
if( !empty( $nr ) )
{
// Send out Reminder mail
$mailheader = "From: Reminder System <$email>\nX-Mailer: Reminder\nContent-Type: text/plain";
mail("$email","Reminder","$reminder_details","$mailheader");
// Delete the sent reminders
mysql_query("DELETE FROM reminder_events WHERE reminder_date <= $trigger_date" );
}
?>
