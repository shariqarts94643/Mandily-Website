<?php
	if($_POST) {

		$to = "info@brandwillagency.com, majed@mandily.com"; // Your email here
		$subject = 'Mandily Website Feedback'; // Subject message here

	}

	//Send mail function
	function send_mail($to,$subject,$message,$headers){
		if(@mail($to,$subject,$message,$headers)){
			echo json_encode(array('info' => 'success', 'msg' => "لقد تمّ إرسال رسالتك بنجاح. شكراً"));
		} else {
			echo json_encode(array('info' => 'error', 'msg' => "خطأ، لم يتمّ إرسال رسالتك"));
		}
	}

	//Check e-mail validation
	function check_email($email){
		if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			return false;
		} else {
			return true;
		}
	}

	//Get post data
	if(isset($_POST['name']) and isset($_POST['mail']) and isset($_POST['comment'])){
		$name 	 = $_POST['name'];
		$mail 	 = $_POST['mail'];
		$website  = $_POST['website'];
		$comment = $_POST['comment'];

		if($name == '') {
			echo json_encode(array('info' => 'error', 'msg' => "الرجاء أدخل إسمك"));
			exit();
		} else if($mail == '' or check_email($mail) == false){
			echo json_encode(array('info' => 'error', 'msg' => "الرجاء إدخال بريد إلكتروني صحيح"));
			exit();
		} else if($comment == ''){
			echo json_encode(array('info' => 'error', 'msg' => "الرجاء إدخال رسالتك"));
			exit();
		} else {

			//Send Mail
			$headers = 'From: ' . $mail .''. "\r\n".
			'Reply-To: '.$mail.'' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

			send_mail($to, $subject, $comment . "\r\n\n"  .'Name: '.$name. "\r\n" .'Email: '.$mail, $headers);
		}

	} else {
		echo json_encode(array('info' => 'error', 'msg' => "الرجاء ملء جميع الحقول المطلوبة"));
	}
 ?>
