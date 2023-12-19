<?php
session_start();
include('../config/dbcon.php');
include('../functions/myfunctions.php');

if(isset($_POST['admin_login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query ="SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $login_query_run =mysqli_query($con, $login_query);
    if(mysqli_num_rows($login_query_run)>0)
    {
        $_SESSION['auth'] = true;
        
        $admindata = mysqli_fetch_array($login_query_run);
        $adminid  = $admindata['id'];
        $adminname = $admindata['name'];
        $adminemail = $admindata['email'];
        $role_id = $admindata['role_id'];


        $_SESSION['auth_admin']=[
            'admin_id' => $adminid,
            'name' => $adminname,
            'email' => $adminemail
        ];


        $_SESSION['role_id'] = $role_id ;
        if($role_id == 1)
        {
            redirect("../admin/index.php","Welcome back Administrator!");
        }
        else
        {
            $_SESSION['message']="You dont have permission to enter this panel.";
            header('Location: ../index.php');
        }
    }
    else
    {
        $_SESSION['message'] = "LOL wrong email or password";
        header('Location: ../admin/admin_login.php');
    }

}

?>