<?php
if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $pass = $_POST['password'];

    include 'function.php';
    include 'db.php';

    if(emptyInputLogin($name, $pass) !== false){
        // echo "Please fill the details";
        header("Location: ../login.php?error=emptyinput");
        exit();
    }

    if(invalidUnamelogin($name) !== false){
        // echo "Please Enter valid Username";
        header("Location: ../login.php?error=invalidusername");
        exit();
    }

    if(pswd_lengthlogin($pass) !== false){
        // echo "Please fill 6-8 characters<br>";
        // echo $pass;
        header("Location: ../login.php?error=passwordlengthnotmatch");
        exit();
    }

    loggedin($conn, $name, $pass);
}   
// echo  $name . "<br>" . $pass;
?>