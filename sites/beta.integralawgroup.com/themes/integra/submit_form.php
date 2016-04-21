<?php
	$toEmail = "bperry@integralawgroup.com";
//	$toEmail = "contact@mediadomino.com";
	$emailSubject = "Integra Law Group - Small Contact Us Form";

	function mail_utf8($to, $subject = '(Small Contact Us Form)', $message = '', $header = '') {
		$header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
		return mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header_ . $header);
	}

	$message =  "Name: " . $_POST["Name"] . "\n";
	$message .= "Phone: " . $_POST["Phone"] . "\n";
	$message .= "Email: " . $_POST["Email"] . "\n";
	$message .= "Message: " . $_POST["Message"] . "\n";
	$header = "From: Prospect" . " <" . $_POST["Email"] . ">\r\n"; //optional headerfields

//	ini_set('sendmail_from', $_POST["Email"]);

	$mailit = mail_utf8($toEmail, $emailSubject, $message, $header);

	if ( @$mailit ) {
		echo '<h2>Thank you!</h2><br /><div id="success">Form submitted successfully!</div>';
	} else {
		echo '<h2>Problem!</h2><br /><div id="fail">Cannot submit form! Please use the contact details on the Contacts page.</div>';
	}

?>