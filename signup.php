<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.techtarget.com/favicon.ico">
    <title>Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    include 'header.php';
    ?>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Signup Form</h2>
                <form action="include/signup_process.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="xyz@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter your Password">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                </form>
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyinput"){
                            echo "<p class='text-danger mt-3'>Please fill the all details!</p>";
                        }
                        else if($_GET['error'] == "invalidemail"){
                            echo "<p class='text-danger mt-3'>Please fill the valid Email-Id!</p>";
                        }
                        else if($_GET['error'] == "invalidusername"){
                            echo "<p class='text-danger mt-3'>Please fill the valid Username!</p>";
                        }
                        else if($_GET['error'] == "passwordlengthnotmatch"){
                            echo "<p class='text-danger mt-3'>Please fill the password 6-8 characters!</p>";
                        }
                        else if($_GET['error'] == "passworddidnotnatch"){
                            echo "<p class='text-danger mt-3'>Please fill the same password as above!</p>";
                        }
                        else if($_GET['error'] == "userexist"){
                            echo "<p class='text-danger mt-3'>Username already exist!</p>";
                        }
                        else if($_GET['error'] == "none"){
                            echo "<p class='text-success mt-3'>You Signed-Up Successfully!</p>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
