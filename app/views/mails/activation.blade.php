<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
</head>
<body>
<p>Hello {{ ucwords($user->first_name) }},</p>
<p>Thank you for registering. Before we can activate your account, please complete the registration process by clicking on the following link:</p>
<p><a href="{{ URL::to('clients/activate/'.$user->id.'/'.$user->activation_code)}}">Activate Your Account</a></p>
<p>In case your email program does not recognize the above link as, please direct your browser to the following URL and enter the activation code:</p>
<p><strong>Login Information:</strong></p>
<p><strong>Email: </strong>{{$user->email}}<br>
	<strong>Password: </strong>{{ $password }}
<p>Activation Code: {{ $user->activation_code }}</p>
</body>
</html>