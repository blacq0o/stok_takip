<html>
<head>
    <title>SeFa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="js/bootstrap.min.js" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <form class="form-signin" action="system_control.php" method="post">
            <h2 class="form-signin-heading" style="text-align: center;">Giriş Yapınız...</h2>
            <label for="inputEmail" class="sr-only">Kullanıcı Adı</label>
            <input type="text" name="user_id" class="form-control" placeholder="Kullanıcı Adı..." required autofocus>
            <label for="inputPassword" class="sr-only">Şifre</label>
            <input type="password" name="user_password" class="form-control" placeholder="Şifre..." required>
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Giriş Yap">
        </form>
</div> <!-- /container -->



<script src="js/jquery.min.js"></script>
<script src="js/ie-emulation-modes-warning.js"></script>
<script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>