<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    <p>Name: {{ $data['name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Phone: {{ $data['phone'] }}</p>
    <p>Subject: {{ $data['subject'] }}</p>
    <p>Message: {{ $data['message'] }}</p>
</body>
</html>