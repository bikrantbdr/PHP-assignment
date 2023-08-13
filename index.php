<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
<!-- <?php require 'partials/_nav.php' ?> -->

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // require 'partials/_dbconnect.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

        $sql = "select * from users where username = '$username' AND password= '$password'";
        $result = mysqli_query($conn, $sql);

        // if ($result === false) {
        //     echo "Query error: " . mysqli_error($conn);
        //     exit(); // Terminate script execution
        // }

        $num = mysqli_num_rows($result);

        if ($num == 1){
            header("Location: dashboard.php");
            exit;
        }
        else{
            echo "Invalid username or password. Please try again.";
        }

}
?>
 <script>
        function validateLoginForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var warningDiv1 = document.getElementById("warning1");
            var warningDiv2 = document.getElementById("warning2");
            
            if (username === "" || password === ""){
                warningDiv1.innerHTML = "Username cannot be empty"; 
                warningDiv2.innerHTML = "Password cannot be empty"; 
                return false;
            }

            if (username === "") {
                // alert("All fields are required.");
                warningDiv1.innerHTML = "Username cannot be empty"; 
                return false;
            }
            
            if (password === "") {
                warningDiv2.innerHTML = "Password cannot be empty"; 
                return false;
            }
            return true;
}
    </script>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <form method="POST" action="index.php" onsubmit="return validateLoginForm()" >
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="card-footer">
                    New user? <a href="signup.php">Sign up here</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>