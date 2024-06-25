<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class='container'>
    <?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        require_once "database.php";

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $results = mysqli_Query($connection ,$sql);
        $user = mysqli_fetch_array($results, MYSQLI_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Add session
                session_start();
                $_SESSION['user']="logedin";
                //  redirect to login page
                header('Location: index.php');
                die();
            }else{
                echo "<div class='alert alert-danger'>Wrong password.</div>";
            }
        }else{
            echo "<div class='alert alert-danger'>The email does not exist.</div>";
        }
         
}

?>
    

    <form  action="login.php" method="post">
            
            <div class ="form-group">
                <input type="email" class ="form-control" name="email" placeholder="Enter email:">
            </div>
            <div class ="form-group">
                <input type="password" class ="form-control" name="password" placeholder="Password:">
            </div>
            
            <div class ="form-btn">
                
                    <input class= "btn btn-primary" type="submit" name="login" value="Login">
            
            </div>
            <div>
                <p>Not registered yet? <a href="registration.php">Register here.</a></p>
            </div>

        </form>
    </div>
    
</body>
</html>