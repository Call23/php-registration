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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
<?php
// print_r($_POST)
if (isset($_POST["submit"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeat-password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    $errors = array();

    if (empty($fullname) OR empty($email) OR empty($password) OR empty($repeatPassword)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if(strlen($password)<8){
        array_push($errors, "Password must be at least 8 characters long.");
    }
    if ($password !== $repeatPassword) {
        array_push($errors, "Password do not match");
    
    }


    // db connection
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $results = mysqli_Query($connection ,$sql);
    $rowCount = mysqli_num_rows($results);

    if($rowCount>0){
        array_push($errors, "Email already exists.");
    }


    if (count($errors)>0) {
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }else{
        // db connection
        // require_once "database.php";
        // push values
        $sql ="INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);

        if ($preparestmt) {
            mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$password_hash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are succefully registered.</div>";
            header('Location: index.php');
            die();
        }else{
            die("Something went wrong!");
        }
    }
}

?>

        <form  action="registration.php" method="post">
            <div class ="form-group">
                <input type="text" class ="form-control" name="fullname" placeholder="Full name:">
            </div>
            <div class ="form-group">
                <input type="email" class ="form-control" name="email" placeholder="Email:">
            </div>
            <div class ="form-group">
                <input type="password" class ="form-control" name="password" placeholder="Password:">
            </div>
            <div class ="form-group">
                <input type="password" class ="form-control" name="repeat-password" placeholder="Repeat password:">
            </div>
            <div class ="form-btn">
                
                    <input class= "btn btn-primary" type="submit" name="submit" value="Register">
            
            </div>

            <div>
                <p>Already registered?<a href='login.php'>Login here.</a></p>
            </div>


        </form>
    </div>
    
</body>
</html>