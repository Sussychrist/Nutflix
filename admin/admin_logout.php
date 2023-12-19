<?php
session_start();

if(isset($_SESSION['auth']))
{
    unset($_SESSION['auth']);
    unset($_SESSION['auth_admin']);
    $_SESSION['message']="Logged out Successfully";
    
}
header('Location: ../index.php');



?>