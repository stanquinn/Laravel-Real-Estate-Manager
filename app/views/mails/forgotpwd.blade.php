<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
</head>
<body>
<p>Hello {{ ucwords($user->first_name) }},</p>
<h2>Forgot your password or can't sign in?</h2>
<p>Can't remember your password? Don't worry, we can help.</p>
<p>Well send you a new password by clicking on the following link:</p>
<p><a href="{{ URL::to('clients/password-reset/'.$user->id.'/'.$code)}}">Reset Password</a></p>
<p>In case your email program does not recognize the above link as, please direct your browser to the following URL and enter the activation code:</p>
<p>Reset Code: {{ $code }}</p>
</body>
</html>