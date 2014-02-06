<!DOCTYPE html>
<html>
<head>
    <title>New Password</title>
</head>
<body>
<p>Hello {{ ucwords($user->first_name) }},</p>
<p>You have requested to have a new password assigned to your account in our website.</p>
<p>If you didn't request this or if you don't want to change your password you should just ignore this message.</p>
<p>Only if you visit the activation page below will your password be changed.</p>
<h4><strong>Login Information:</strong></h4>
<p><strong>Email: </strong>{{$user->email}}<br>
	<strong>Password: </strong>{{ $password }}</p>
</body>
</html>