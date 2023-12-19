<?php
include('../config/dbcon.php');
include('../functions/myfunctions.php');
if (isset($_POST['register_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $check_email_query = "SELECT email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);
    if(mysqli_num_rows($check_email_query_run)>0){
        $_SESSION['message'] = "Email already registered";
        header('Location: ../genre_include/signup.php');
    }
    else{
    if ($password == $cpassword) {
        // Hash the user's password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        // Insert the hashed password into the database
        $insert_query = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', 
        '$email', '$hashedPassword')";
        $insert_query_run = mysqli_query($con, $insert_query);
    
        if ($insert_query_run) {
            $_SESSION['message'] = "Registered Successfully";
            header('Location: ../genre_include/login.php');
        } else {
            $_SESSION['message'] = "Oopsie Doopsie Something went wrong!";
            header('Location: ../genre_include/signup.php');
        }
    } else {
        $_SESSION['message'] = "Password does not match";
        header('Location: ../genre_include/signup.php');
    }

   } echo "Error: Something went wrong during registration."; // Echo an error message
    
}
else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email'";
    $login_query_run = mysqli_query($con, $login_query);
    if (mysqli_num_rows($login_query_run) > 0) 
    {
        $userdata = mysqli_fetch_array($login_query_run);
        $hashedPassword = $userdata['password'];

    if (password_verify($password, $hashedPassword)) 
    {
            // Password is correct
            $_SESSION['auth'] = true;
            $userid = $userdata['id'];

            $username = $userdata['name'];
            $useremail = $userdata['email'];
            $role_id = $userdata['role_id'];


            $_SESSION['auth_user']=[
                'user_id' => $userid,
                'name' => $username,
                'email' => $useremail,
                'role_id'=> $role_id
            ];

            $_SESSION['role_id'] = $role_id ;
            if($role_id == 0) 
            {
                redirect("../index.php","Welcome back " . $username);
            }
        }
    }else {
        $_SESSION['message'] = "LOL wrong email or password";
        header('Location: ../genre_include/login.php');
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
?>