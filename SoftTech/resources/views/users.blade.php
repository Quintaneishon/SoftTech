<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
   <h1>Usuarios<h1>

   <ul>
        @foreach ($users as $user)
            <li>{{$user}}</li>
        @endforeach
   </ul>
</body>
</html>
