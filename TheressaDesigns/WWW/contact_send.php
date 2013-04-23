<html>
<head>
<title>Theressa Designs</title>
</head>
<body>
<?php
if(isset($_POST['email'])) {
	// The email to send the message to
    $email_to = "sales@theressadesigns.com.au";
	
	// error handler
    function died($error) {
		echo ("<script type='text/javascript'>
			window.alert('" . $error . "')
			window.location.href='contact.html';
			</script>");
		die();
    }
	
	// clean the string from unnecessary words
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
     
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $name = $_POST['name']; // required
    $email_subject = $_POST['subject']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // not required
    $message = $_POST['message']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp,$email_from)) {
    	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  	}
    
	$string_exp = "/^[A-Za-z .'-]+$/";
  	
	if(!preg_match($string_exp,$name)) {
    	$error_message .= 'The Name you entered does not appear to be valid.<br />';
  	}

	if(strlen($message) < 2) {
		$error_message .= 'The Comments you entered do not appear to be valid.<br />';
	}
	
	if(strlen($error_message) > 0) {
		died($error_message);
	}
    
	$email_message = "Form details below.\n\n";
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
     
     
	// create email headers
	$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
	if(!mail($email_to,  $email_subject, $email_message, $headers)) {
		echo ("<script type='text/javascript'>
		window.alert('Failed')
		window.location.href='contact.html';
		</script>");
	} else {
		echo ("<script type='text/javascript'>
		window.alert('Thanks for your email!')
		window.location.href='contact.html';
		</script>");
	}
	
	die();
}
?>
</body>
</html>
