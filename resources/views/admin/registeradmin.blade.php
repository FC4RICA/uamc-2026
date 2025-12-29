<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Registrator</title>
</head>

<body>
    <form method="POST" action='{{ url("admin/reg") }}'>
        {{ csrf_field() }}
        <!-- @csrf
        @method('POST') -->
        <label>username : </label>
        <input id="username" name="username" type="text"><br>
        <label>password : </label>
        <input id="password" name="password" type="password"><br>
        <label>email : </label>
        <input id="email" name="email" type="email"><br>
        <label>name : </label>
        <input id="name" name="name" type="text"><br>
        <button type="submit">OK</button>

    </form>
</body>

</html>