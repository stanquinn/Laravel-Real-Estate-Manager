<!DOCTYPE html>
<html>
<head>
	<title>Message From Contact Form</title>
</head>

<body>
	<p><strong>From:</strong> {{ $from }}</p>
	<p><strong>Email:</strong> {{ $email }}</p>
	<p><strong>Message:</strong></p>
	 <p>{{ nl2br(strip_tags($msg)) }}</p>
</body>
</html>