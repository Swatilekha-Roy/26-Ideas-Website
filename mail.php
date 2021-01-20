<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');
	set_error_handler("var_dump");	

	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$url = $_POST['url'];
	$formselect1 = $_POST['formselect1'];
	$formselect2 = $_POST['formselect2'];
	$formselect3 = $_POST['formselect3'];
	$formselect4 = $_POST['formselect4'];
	$message = $_POST['message'];
	$subject = $_POST['subject'];

	header('Content-Type: application/json');

	if ($name === '')
	{
		print json_encode(array('message' => 'Full Name cannot be empty', 'code' => 0));
		exit();
	}

	if($phone === '')
	{
		print json_encode(array('message' => 'Phone Number cannot be empty', 'code' => 0));
		exit();
	}
	else 
	{
		if (!filter_var($phone, FILTER_VALIDATE_INT))
		{
			print json_encode(array('message' => 'Phone Number format invalid.', 'code' => 0));
			exit();
		}
	}

	if ($email === '')
	{
		print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
		exit();
	} 
	else 
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
			exit();
		}
	}

	if (!filter_var($url, FILTER_VALIDATE_URL))
	{
		print json_encode(array('message' => 'LinkedIn Profile url invalid.', 'code' => 0));
		exit();
	}

	if ($subject === '')
	{
		print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
		exit();
	}

	if ($message === '')
	{
		print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
		exit();
	}

	$content="From: $name \n Phone: $phone \n Email: $email \n LinkedIn Profile: $url \n I am best described as: $formselect1 \n Sector I like: $formselect2 \n What expertise describes you best? $formselect3 \n What kind of entrepreneur? $formselect4";
	$recipient = "business@26ideas.com";
	$mailheader = "From: $email \r\n";
	mail($recipient, $subject, $content, $mailheader) or die("Error!");
	print json_encode(array('message' => 'Email successfully sent!', 'code' => 1));
	exit();
?>