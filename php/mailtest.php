
<?php
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use vendor\PHPMailer\PHPMailer\PHPMailer;
	use vendor\PHPMailer\PHPMailer\Exception;


	//Load composer's autoloader
	require 'vendor/autoload.php';

	try{
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions	
	}catch(Exception $e){
		echo($e);
	}

	try {


	    //Server settings
	    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'aspmx.l.google.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'test@gmail.com';                 // SMTP username
	    $mail->Password = 'testpassword%';                           // SMTP password
	    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 25;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('test@gmail.com', "Test");
	    $mail->addAddress('test@gmail.com', 'TEst');     // Add a recipient	    
	    

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Here is the subject';
	    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

	}

?>