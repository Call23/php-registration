<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>User dashboard</title>
</head>
<body>
    <div class="container">
        <div>
        <h1>Welcome to your dashboard</h1>
</div>
<div>

        <a href = 'logout.php' class = "btn btn-warning">Logout</a>
        </div>
    </div>
    
</body>
</html>