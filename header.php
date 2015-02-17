<?php
session_start();
require_once("dbconnection.php");
if(!isset($_SESSION['u_id']))
{
    go("location:index.php");
}
?>
<html>
<head>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript"  src="select2/dist/js/select2.min.js"></script>
    <script type="text/javascript"  src="select2/dist/js/select2.js"></script>
    <script type="text/javascript"  src="select2/dist/js/i18n/tr.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="csss/ez.css" rel="stylesheet">
    <link href="js/jquery.fileupload.css" rel="stylesheet">
    <link href="select2/dist/css/select2.min.css" rel="stylesheet">
    <title>Ana Sayfa</title>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="homepage.php">STOK-TAKİP</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="homepage.php">Ana Sayfa <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ürün Yönetimi<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="all_product.php">Tüm Ürünler</a></li>
                        <li class="divider"></li>
                        <li><a href="product_insert.php">Ürün Ekle</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Arama...">
                </div>
                <button type="submit" class="btn btn-warning">Arama</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo $_SESSION['u_nick'];?><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="password_change.php"><input type="submit" class="btn btn-success" value="Şifre Güncelle"></a></li>
                        <li class="divider"></li>
                        <li><a href="system_exit.php"><input type="submit"  class="btn btn-danger" value="Çıkış"></a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
