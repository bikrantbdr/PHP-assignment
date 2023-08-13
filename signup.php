<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Signup</title>
</head>

<body>
<?php
// require 'partials/_nav.php';
// Add your database connection and user registration logic here
require 'partials/_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO `users` (`sn`, `username`, `password`) VALUES (NULL, '$username', '$password');";

    $result = mysqli_query($conn, $sql);

    if ($result){
        header("Location: dashboard.php");
    }
    else{
        print("error");
    }
    // Process the form submission and insert new user data into the database
    // Redirect to a success page or display a message
}
?>

<!-- Include the Bootstrap layout for the signup form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Sign Up
                </div>
                <div class="card-body">
                    <form method="POST" action="signup.php">
                    <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>