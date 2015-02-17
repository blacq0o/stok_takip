<?php
require_once("dbconnection.php");
session_start();
$user_nick=$_POST['user_id'];
$user_password=md5($_POST['user_password']);

if(!empty($user_nick) and !empty($user_password))
{
$user_control=$db->query("SELECT * FROM users WHERE user_nick='$user_nick' AND user_password='$user_password'",PDO::FETCH_ASSOC);
    if($user_control->rowCount())
    {
        foreach($user_control as $row)
        {
            $_SESSION['u_nick']=$row['user_nick'];
            $_SESSION['u_id']=$row['user_id'];
        }
        header("location:homepage.php");
    }
    else
    {
        header("location:index.php");
    }
}
else
{
    header("location:index.php");
}
ob_end_flush();
?>
