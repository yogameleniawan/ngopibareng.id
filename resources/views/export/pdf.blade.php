<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <table>
        <tr>
            <td>Name</td>
            <td>Email</td>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
