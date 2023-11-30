<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];

    include 'function.php';
    include 'db.php';

    if (emptyInputSignup($name, $email, $uname, $pass, $cpass) !== false){
        // echo "Fill the empty details";
        header("Location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !== false){
        // echo "Please enter valid email address";
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }

    if(invalidUname($uname) !== false){
        // echo "Please Enter valid Username";
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }

    if(pswd_length($pass, $cpass) !== false){
        // echo "Please fill 6-8 characters<br>";
        // echo $pass . "<br>" . $cpass;
        header("Location: ../signup.php?error=passwordlengthnotmatch");
        exit();
    }

    if(pswd_match($pass, $cpass) !== false){
        // echo "Password didn't match<br>";
        // echo $pass . " = " . $cpass;
        header("Location: ../signup.php?error=passworddidnotnatch");
        exit();
    }

    if(userExist($conn ,$uname, $email)){
        // echo "User Already exist";
        header("Location: ../signup.php?error=userexist");
        exit();
    }
    
    createUser($conn, $name, $email, $uname, $pass);
}else{
    header("Location: ../signup.php?error=none");
}
// echo $name . "<br>";
// echo $email . "<br>";
// echo $uname . "<br>";
// echo $pass . "<br>";
// echo $cpass . "<br>";

?>