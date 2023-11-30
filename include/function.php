<?php
function emptyInputSignup($name, $email, $uname, $pass, $cpass){
    $result;
    if(empty($name) || empty($email) || empty($uname) || empty($pass) || empty($cpass)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidUname($uname){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uname)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pswd_length($pass, $cpass){
    $result;
    if(strlen($pass) <= 6 || strlen($cpass) <= 6){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pswd_match($pass, $cpass){
    $result;
    if($pass == $cpass){
        $result = false;
    }else{
        $result = true;
    }
    return $result;
}

function userExist($conn ,$uname, $email){
    $result;
    $sql = "SELECT * FROM user_info WHERE username = ? OR email =?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        // echo "STMT FAILED";
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uname, $email);
    mysqli_stmt_execute($stmt);

    $result_data = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result_data)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $uname, $pass){
    $result;
    $sql = "INSERT INTO user_info (name, email, username, pswd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        // echo "STMT FAILED";
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $encrypt_pswd = password_hash($pass, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $uname, $encrypt_pswd);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    // echo "USER CREATE SUCCESSFULLY!";
    header("Location: ../login.php");
    exit();

}

function emptyInputLogin($name, $pass){
    $result;
    if(empty($name) || empty($pass)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidUnamelogin($name){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pswd_lengthlogin($pass){
    $result;
    if(strlen($pass) <= 6){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loggedin($conn, $name, $pass){
    $user_exist = userExist($conn ,$name, $name);

    if($user_exist === false){
        // echo "User doesn't exist";
        header("Location: ../login.php?error=usernamenotexist");
    }

    $pswd_hashed = $user_exist['pswd'];
    $check_pswd = password_verify($pass, $pswd_hashed);

    if($check_pswd === false){
        // echo "You enter wrong Password";
        header("Location: ../login.php?error=wrongpassword");
    }
    else if( $check_pswd === true){
        session_start();
        $_SESSION['u_id'] = $user_exist['id'];
        $_SESSION['u_name'] = $user_exist['username'];
        // echo "USER LOGGED-IN SUCCESSFULLY!";
        header("Location: ../index.php");
        exit(); 
    }

}

?>