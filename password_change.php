<?php
require_once("header.php");
error_reporting(0);
?>
    <form method="post" action="">
        <div class="row" style="margin-top: 60px">
            <div class="col-xs-2 col-md-3"></div>
            <div class="col-xs-10 col-md-6">
                <h2>Şifre Değiştirme</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="text-align:right;">
                <label class="yukardan-5">Eski Şifre:</label>
            </div>
            <div class="col-xs-6 col-md-4">
                <input type="text" name="txtSifre" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" align="right">
                <label class="yukardan-10">Yeni Şifre:</label>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="yukardan-5">
                    <input type="password" name="txtSifre_1" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" align="right">
                <label class="yukardan-10">Tekrar Yeni Şifre:</label>
            </div>
            <div class="col-xs-6 col-md-4">
                <div class="yukardan-5">
                    <input type="password" name="txt_sifre_2" class="form-control">
                </div>
            </div>
            <div class="col-xs-3 col-md-3">
                <div class="alert alert-danger" align="center" role="alert"
                     style="display: none;margin-bottom: 0px;padding: 8px;font-weight: bold;">
                </div>
                <div class="alert alert-success" align="center" role="alert"
                     style="display: none;margin-bottom: 0px;padding: 8px;font-weight: bold;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="text-align:right;"></div>
            <div class="col-xs-6 col-md-4">
                <div class="yukardan-5" style="text-align: center;">
                    <button type="submit" class="btn btn-lg btn-info" name="degistir">Değiştir</button>
                </div>
            </div>
        </div>
        <?php
        $eski_sifre=md5($_POST['txtSifre']);
        $yeni_sifre=md5($_POST['txtSifre_1']);
        $yeni_sifre_2=$_POST['txt_sifre_2'];

        if(isset($_POST['degistir']))
        {
            if(!empty($eski_sifre) and !empty($yeni_sifre) and !empty($yeni_sifre_2))
            {
                $sifre_getir=$db->query("SELECT * FROM users WHERE user_nick='$_SESSION[u_nick]' AND user_password='$eski_sifre'",PDO::FETCH_ASSOC);
                if($sifre_getir->rowCount())
                {
                    foreach($sifre_getir as $row)
                    {
                        $sifre_degistir=$db->prepare("UPDATE users SET user_password=? WHERE user_id=?");
                        $update=$sifre_degistir->execute(array($yeni_sifre,$_SESSION['u_id']));
                        if($update)
                        {
                            echo "Şifre değişti";
                        }
                    }
                }
            }
            else
            {
                echo "hata";
            }
        }
        ?>
    </form>
    <script>
        $(function(){
            $('input:password').keyup(function () {
                if ($('input').eq(4).val() != $('input').eq(5).val())
                {
                    $('.alert-danger').html('Şifreler Aynı Değil !');
                    $('.alert-danger').show();
                }
                else
                {
                    $('.alert-danger').html(null);
                    $('.alert-danger').hide();
                    $('.alert-success').html('Şifreler Doğru');
                    $('.alert-success').show().fadeOut(2000);
                }
            });
        });
    </script>

<?php
require_once("footer.php");
?>