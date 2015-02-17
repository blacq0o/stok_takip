<?php
require_once("header.php");
?>
<div class="col-md-12 col-xs-12">
    <form method="post" enctype="multipart/form-data" action="">
        <div class="panel panel-default" style="margin-top: 60px">
            <div class="panel-body" style="font-size: medium;">
                <h3><strong>Ürün Ekleme</strong></h3>
            </div>
        </div>
        <div class="row" style="display: none;" id="uyari">
            <div class="alert alert-danger" style="display: none;" align="center" role="alert"></div>
            <div class="alert alert-success" style="display: none;" align="center" role="alert"></div>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <td colspan="2" rowspan="1">
                    <div class="form-group">
                        <label>Ürün Birimi</label>
                        <br>
                        <?php
                        $birim=$db->query("SELECT * FROM product_birim ORDER BY birim ASC",PDO::FETCH_ASSOC);
                        if($birim->rowCount())
                        {
                            echo ' <select id="u_birim" name="u_birim" class="form-control">';
                            foreach($birim as $row)
                            {
                                echo "<option value='".$row['id']."'>".$row['birim']."</option>>";
                            }
                            echo '</select>';
                        }
                        else
                        {
                            echo "Kayit Yok";
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">
                    <div class="form-group">
                        <label>Ürün Adı</label>
                        <br>
                        <input type="text" class="form-control" id="u_adi" name="u_adi" required>
                    </div>
                </td>
                <td colspan="1" rowspan="1">
                    <label>Ürün Kodu</label>,
                    <br>
                    <input type="text" class="form-control" name="u_kodu">
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">
                    <label>Alış Fiyat</label>
                    <br>
                    <input type="number" id="u_alis" class="form-control" name="u_alis">
                </td>
                <td  colspan="1" rowspan="1">
                    <label>Satış Fiyat</label>
                    <br>
                    <input type="number" id="u_satis" class="form-control" name="u_satis">
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">
                    <label>Marka</label>
                    <br>
                    <input type="text" class="form-control" name="u_marka">
                </td>
                <td colspan="1" rowspan="1">
                    <label>Model</label>
                    <br>
                    <input type="text" class="form-control" name="u_model">
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">
                    <label>Alınan Yer</label>
                    <br>
                    <input type="text" class="form-control" name="u_alinan">
                </td>
                <td colspan="1" rowspan="1">
                    <label>Ürün Resim</label>
                    <br>
                    <span class="btn btn-warning fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Dosya Seç...</span>
                        <input name="file_resim[]" type="file" />
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">
                    <label>Ürün Açıklama</label>
                    <br>
                    <textarea class="form-control" rows="4" name="u_aciklama"></textarea>
                </td>
                <td colspan="1" rowspan="1" style="text-align: center;">
                    <br><br>
                    <input class="btn btn-lg btn-success" style="font-weight: bold;" type="submit" name="kaydet" value="Ürünü Kaydet">
                </td>
            </tr>
            </tbody>
    </form>
        </table>
        <?php
               if(isset($_POST['kaydet']))
               {
                   //Sayfadaki alınacak veriler...
                   $u_birim=$_POST['u_birim'];
                   $u_adi=$_POST['u_adi'];
                   $u_kodu=$_POST['u_kodu'];
                   $u_alinan=$_POST['u_alinan'];
                   $u_marka=$_POST['u_marka'];
                   $u_model=$_POST['u_model'];
                   $u_aciklama=$_POST['u_aciklama'];
                   $u_alis=$_POST['u_alis'];
                   $u_satis=$_POST['u_satis'];
                   $u_tarih=date("Y-m-d");

                    $sorgu=$db->prepare("INSERT INTO product (birimi,urun_adi,urun_kod,alinan_yer,marka,model,aciklama,alis_fiyat,satis_fiyat,tarih) VALUES (?,?,?,?,?,?,?,?,?,?)");
                    $kaydet=$sorgu->execute(array($u_birim,$u_adi,$u_kodu,$u_alinan,$u_marka,$u_model,$u_aciklama,$u_alis,$u_satis,$u_tarih));
                    if($kaydet)
                    {
                        $son_id = $db->lastInsertId();


                            if($_FILES['file_resim'])
                            {
                                $file = $_FILES['file_resim'];
                                include("resim_boyutla.php");
                                $resim_klasor="images/";
                                $resim_klasor1="images";

                                $buyuk_resim_en=800;
                                $buyuk_resim_boy=600;


                                function turkcekarakter($isim){
                                    $bulunacak = array('ç','Ç','ı','İ','ğ','Ğ','ü','ö','Ş','ş','Ö','Ü',',',' ','(',')','[',']');
                                    $degistir  = array('c','C','i','I','g','G','u','o','S','s','O','U','','_','','','','');

                                    $isim=str_replace($bulunacak, $degistir, $isim);
                                    return($isim);
                                }

                                $klasor="gonder";

                                $k = count($file['name']);
                                $desteklenenformatlar = array ("image/jpeg","image/pjpeg","image/gif","image/png");

                                for($i=0 ; $i < $k ; $i++)
                                {
                                    @$isim = split('/',urldecode($file['name'][$i]));
                                    $rand =time();//Burada zamanı alıyoz
                                    if(in_array ($file['type'][$i], $desteklenenformatlar))
                                    {
                                        $resim=$resim_klasor."/".$rand."_".turkcekarakter($isim[count($isim)-1]);
                                        $resim1=$resim_klasor1."/".$rand."_".turkcekarakter($isim[count($isim)-1]);

                                        move_uploaded_file($file['tmp_name'][$i], $resim);


                                        // buyuk resmi boyutlandiriyoruz
                                        $icerik = resample($resim,$buyuk_resim_en,$buyuk_resim_boy);
                                        $dosya  = fopen ($resim,"w+");
                                        fwrite($dosya,$icerik);
                                        fclose($dosya);

                                        // resim boyutlandirma bitti



                                        $say=$son_id;

                                        if($resim=="1"){
                                        }else{
                                            $sorgu=$db->prepare("INSERT INTO product_file (p_url,p_id) VALUES (?,?)");
                                            $kaydet=$sorgu->execute(array($resim1,$say));
                                            if($kaydet)
                                            {
                                                $r_id=$db->lastInsertId();
                                                $resim_update=$db->exec("UPDATE product SET resim='".$r_id."' WHERE id='".$say."'");
                                            }
                                        }
                                    }

                                }
                            }
                        /*echo "<script>
                                    $(function(){
                                        $('#uyari').show().fadeOut(3000);
                                    $('.alert-success').show().fadeOut(3000);
                                    $('.alert-success').html('Ürün Başarı İle Kaydedildi.');
                                });
                            </script>";*/
                    }
               }
        ?>
</div>

<script>
    /*
     formatNoMatches: function () { return "Sonuç bulunamadı"; },
     formatInputTooShort: function (input, min) { var n = min - input.length; return "En az " + n + " karakter daha girmelisiniz"; },
     formatInputTooLong: function (input, max) { var n = input.length - max; return n + " karakter azaltmalısınız"; },
     formatSelectionTooBig: function (limit) { return "Sadece " + limit + " seçim yapabilirsiniz"; },
     formatLoadMore: function (pageNumber) { return "Daha fazla…"; },
     formatSearching: function () { return "Aranıyor…"; }
    */
    jQuery(function($) {
        // select2 id ye göre
        /*$(document).ready(function() {
            $("#u_birim").select2({
                });
        });*/

    });
    //Number Format --Sadece Rakam ve nokta girdirme input id ye göre !!!
    $(document).ready(function() {
        $("#u_satis").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        $("#u_alis").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
</script>
<?php
require_once("footer.php");
?>