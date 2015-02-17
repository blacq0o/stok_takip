<?php
require_once("header.php");
?>
<div class="col-md-12 col-xs-12">
    <div class="panel panel-default" style="margin-top: 60px">
        <div class="panel-body" style="font-size: medium;">
            <h3><strong>Sistemdeki Ürünler</strong></h3>
        </div>
    </div>
    <div class="alert alert-danger" style="display: none;" align="center" role="alert"></div>
    <table class="table table-bordered">
        <thread>
            <tr>
                <th></th>
                <td>Ürün Adı</td>
                <td>Marka</td>
                <td>Model</td>
                <td>Açıklama</td>
                <th></th>
            </tr>
        </thread>
        <tbody>
<?php

if(!isset($_GET['sayfa'])){
    $sayfa = 1;
} else {
    $sayfa = $_GET['sayfa'];
}
$kacar=5;
//Sayfada Kaç kayıt listeleyeceğimiz...

$kactan=(($sayfa*$kacar)-$kacar);

// Geçerli sayfadan itibaren kaç kayıt kaldığını buluyoruz...

    $kayitlar=$db->query("SELECT * FROM product ORDER BY id DESC LIMIT $kactan,$kacar",PDO::FETCH_ASSOC);

$sirano=1;
    if($kayitlar->rowCount())
    {
        foreach($kayitlar as $row)
        {
            echo
            "<tr>
            <th>&nbsp;</th>
            <td> ".$row['urun_adi']."</td>
            <td>".$row['marka']."</td>
            <td>".$row['model']."</td>
            <td>".$row['aciklama']."</td>
            <td style='width:90px'>
            <a href='all_product.php?sil=".$row['id']."&Product_Name=".$row['urun_adi']."' onclick='return silOnayla();' class='btn btn-sm btn-danger' title='Sil'> <i class='glyphicon glyphicon-trash'></i></a>
            <a href='view_product.php?product=".$row['id']."' class='btn btn-sm btn-info' title='Ürün Detay'> <i class='glyphicon glyphicon-new-window'></i></a>
            </td>
            </tr>";

        }
        $sirano++;
    }
$toplam_kayit = $db->query("SELECT COUNT(*) AS total FROM product")->fetchColumn();
    if($toplam_kayit>0)
    {
        $toplam_sayfa=ceil($toplam_kayit/$kacar);
        echo "<tr><td>";
        if($sayfa > 1)
        {
            $prev = ($sayfa - 1);
            echo "<a href='".$_SERVER['PHP_SELF']."?sayfa=".$prev."'> Önceki Sayfa</a>";
        }
        else { echo "Önceki Sayfa";}
        for($i = 1; $i <= $toplam_sayfa; $i++)
        {
            if(($sayfa) == $i)
            {
                echo "</td><td > Aktif Sayfa: ";
                echo "<b>".$i."</b>";
            } else
            {
                echo "<a href='".$_SERVER['PHP_SELF']."?sayfa=".$i."'></a> ";
            }
            echo "</td>";
        }
// Sonraki Kayıtlarımızın Gösterileceği Linkimiz
        echo "<td>";
        if($sayfa < $toplam_sayfa){
            $next = ($sayfa + 1);
            echo "<a href='".$_SERVER['PHP_SELF']."?sayfa=".$next."'> Sonraki Sayfa</a></td>";}
        else { echo "Sonraki Sayfa";}
        echo "</td>";
        echo "<td>Toplam Kayıt : <b>".$toplam_kayit."</b> </td>";
        echo "<td>Toplam Sayfa : <b>".$toplam_sayfa."</b></td>";
        echo "</tr>";
    }
if(isset($_GET['sil']) and isset($_GET['Product_Name']))
{
    echo "<script>
                                $(function(){
                                $('.alert-danger').show().fadeOut(3000);
                                $('.alert-danger').html('".$_GET['Product_Name']." Adlı Ürün Siliniyor');
                            });
                        </script>";

            $delete = $db->exec("DELETE FROM product where id =$_GET[sil]");// Delete İşlemi

    echo "<meta http-equiv='refresh' content='3;URL=all_product.php'>";
}
?>
        </tbody>
    </table>

<script>
    function silOnayla()
    {
        return confirm("Silmek istediğinizden emin misiniz?");
    }
</script>
<?php
require_once("footer.php");
?>