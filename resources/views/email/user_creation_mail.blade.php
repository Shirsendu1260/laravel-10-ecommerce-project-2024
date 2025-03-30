<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! $mail_data['title'] !!}</title>
</head>

<body>
    <h3><b>{!! $mail_data['title'] !!}</b></h3>
    <br>
    {!! $mail_data['body'] !!}
    <br><br>
    {!! $mail_data['note'] !!}
    <p>Email: <b>{!! $mail_data['email'] !!}</b></p>
    <p>Password: <b>{!! $mail_data['password'] !!}</b></p>
</body>

</html>
