<?php 
include('../functions/myfunctions.php');

if(isset($_SESSION['auth']))
{
    if($_SESSION['role_id'] != 1)
    {
        
        redirect("../index.php","You are not authorized to access this page");
    }
}
else
{
    redirect("../admin/admin_login.php","Login to continue");
}
?>