<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Account</title>
</head>
<body>
    <p>Dear {{ $name }}</p>
    <p>Well come! Now, you can verify account: {{ $email }}</p>
    <br>
        You can verify account by click link here:
    <br>
    <a href="{{$action_links}}">Verify Account</a>
</body>
</html>