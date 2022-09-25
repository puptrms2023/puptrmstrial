<!DOCTYPE html>
<html>

<head>
    <title>ItsolutionStuff.com</title>
</head>

<body>

    <h1>Hi, {{ $user->users->first_name }}</h1>
    <p>{{ $user->users->email }}</p>

    <p>Thank you</p>
</body>

</html>
