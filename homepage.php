<?php
require_once("header.php");
    $user=$db->query("SELECT * FROM users WHERE user_id='$_SESSION[u_id]'",PDO::FETCH_ASSOC);
    if($user->rowCount())
    {
        foreach($user as $row)
        {
            $_SESSION['u_adi']=$row['user_name'];
        }
    }
?>
<div class="jumbotron" style="background-color: transparent;margin-top: 50px;">
    <h1 style="text-align: center;">Sisteme Hoş Geldiniz Sayın <?php echo strtoupper($_SESSION['u_adi']); ?></h1>
</div>
<?php
require_once("footer.php");
?>
