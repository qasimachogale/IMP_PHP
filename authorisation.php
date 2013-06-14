<?php

$link= mysql_connect('localhost','root','');
if(!$link){
	echo "Did not connect";
}

$db_select = mysql_select_db('prog1db', $link);

if(!$db_select){
	die("error!!!".mysql_error());
}

$pass=$_POST['PASS'];
$uid=$_POST['UID'];
$query=sprintf("INSERT INTO auth(UID, PSWD)
		VALUES('%s','%s') ",
		mysql_real_escape_string($uid),
		mysql_real_escape_string($pass));
if(!mysql_query($query))
{
	echo 'Query failed '.mysql_error();
	exit();
}
else
{
	// if all is well we mail off a little thank you email. We know it is
	// safe to do so because we have validated the email address.
	$subject = 'Submission';
	$msg= 'Thank you for submitting your information';

	echo $msg;

}

?>
