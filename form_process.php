<?php


	$email = $_REQUEST['email'];
	$name = $_REQUEST['name'];
	$subject = $_REQUEST['subject'];

	$to = "gerasimosstefatos@gmail.com";

	$subject = 'First attemp';
	$message = 'malaka se parakalw piase';

	$headers = "From: The Sender Name <gerasimosstefatos@gmail.com\r\n>";
	$headers .= "Content-type: text/html\r\n";

	mail($to,$subject,$message,$headers);
	echo "mail sended";

	?>