<?php
require_once("header.php");
if(!isset($_GET['product']) OR $_GET['product']<>"")
{
    $p_id=$_GET['product'];
    $p_getir=$db->query("SELECT * FROM product WHERE id='".$p_id."'");
    $p=$p_getir->fetch(PDO::FETCH_ASSOC);
    $birim=$db->query("SELECT * FROM product_birim WHERE id='".$p['birimi']."'");
    $b=$birim->fetch(PDO::FETCH_ASSOC);
    $file=$db->query("SELECT * FROM product_file WHERE id='".$p['resim']."'");
    $f=$file->fetch(PDO::FETCH_ASSOC);

}
else
{
    go("location:homepage.php");
}
?>
    <div class="col-md-12 col-xs-12">
        <div class="panel panel-default" style="margin-top: 60px">
            <div class="panel-body" style="font-size: medium;">
                <h3><strong><?php echo strtoupper($p['urun_adi']);?></strong></h3>
            </div>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Resim</label>
                    </td>
                    <td>
                        <?php
                            if(!empty($f['p_url']))
                            {
                                echo "<img src='".$f['p_url']."' width='300px' height='250px'>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Birimi</label>
                    </td>
                    <td>
                        <?php echo $b['birim'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Adı</label>
                    </td>
                    <td>
                        <?php echo $p['urun_adi'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Kodu</label>
                    </td>
                    <td>
                        <?php echo $p['urun_kod'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Marka</label>
                    </td>
                    <td>
                        <?php echo $p['marka'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Model</label>
                    </td>
                    <td>
                        <?php echo $p['model'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Açıklama</label>
                    </td>
                    <td>
                        <?php echo $p['aciklama'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Alınan Yer</label>
                    </td>
                    <td>
                        <?php echo $p['alinan_yer'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Alış Fiyat</label>
                    </td>
                    <td>
                        <?php echo $p['alis_fiyat'];?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <label>Ürün Satış Fiyat</label>
                    </td>
                    <td>
                        <?php echo $p['satis_fiyat'];?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
require_once("footer.php");
?>