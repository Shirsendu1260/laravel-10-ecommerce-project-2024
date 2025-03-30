<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! $mail_data['mail_subject'] !!}</title>
</head>

<body>
    <h3><b>{!! $mail_data['mail_subject'] !!}</b></h3>
    <br>
    <p><strong>Name:</strong> {!! $mail_data['name'] !!}</p>
    <p><strong>Email:</strong> {!! $mail_data['email'] !!}</p>
    <p><strong>Subject:</strong> {!! $mail_data['subject'] !!}</p>
    <p><strong>Message:</strong> {!! $mail_data['message'] !!}</p>
    <br>
    <p>Please respond to the sender as soon as possible.</p>
</body>

</html>
