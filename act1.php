<html>
<body>
	<?php


	function sanityCheck($string, $type, $length){

		$type = 'is_'.$type;

		if(!$type($string))
		{
			return FALSE;
		}

		elseif(empty($string))
		{
			return FALSE;
		}

		elseif(strlen($string) > $length)
		{
			return FALSE;
		}
		else
		{

			return TRUE;
		}
	}



	function checkSet(){
		return isset($_POST['fullname'], $_POST['pno'], $_POST['eid']);
	}


	function checkNumber($num, $length){
		if($num > 0 && strlen($num) == $length)
		{
			return TRUE;
		}
	}

	if(checkSet() != FALSE)
	{

		if(empty($_POST['fullname'])==FALSE && sanityCheck($_POST['fullname'], 'string', 25) != FALSE)
		{

			$fullname = $_POST['fullname'];
		}
		else
		{

			echo 'Username is not set';
			exit();
		}



		if(sanityCheck($_POST['pno'], 'numeric', 10) != FALSE && checkNumber($_POST['pno'], 10) == TRUE)
		{

			$pno = $_POST['pno'];
		}
		else
		{

			$pno='';
		}


		if(empty($_POST['eid'])==FALSE && sanityCheck($_POST['eid'], 'string', 25) != FALSE)
		{

			$eid = $_POST['eid'];
		}
		else
		{

			echo 'Email is not set';
			exit();
		}



	}


	// Connect to the MySQL
	$link = mysql_connect('localhost', 'root', '');
	if (!$link)
	{
		die('Not connected : ' . mysql_error());
	}

	// select test as the current db
	$db_selected = mysql_select_db('prog1db', $link);
	if (!$db_selected)
	{
		die ("Database not selected : " . mysql_error());
	}

	// Build our query here and check each variable with mysql_real_escape_string()
	$query = sprintf("INSERT INTO people (fullname, pno, uid)
			VALUES( '%s', '%s','%s')",
			mysql_real_escape_string($fullname),
			mysql_real_escape_string($pno),
			mysql_real_escape_string($eid));

	// run the query
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
</body>
</html>
