<?php
function resample($resim,$max_en,$max_boy)
{

    # Icerik icin kesi baslat ...
    ob_start();

    # Ilk boyutlar
    $boyut = getimagesize($resim);
    $en    = $boyut[0];
    $boy   = $boyut[1];

    # Yeni boyutlar
    $x_oran = $max_en  / $en;
    $y_oran = $max_boy / $boy;

    if (($en <= $max_en) and ($boy <= $max_boy)){
        $son_en  = $en;
        $son_boy = $boy;
    }
    else if (($x_oran * $boy) < $max_boy){
        $son_en  = $max_en;
        $son_boy = ceil($x_oran * $boy);
    }
    else {
        $son_en  = ceil($y_oran * $en);
        $son_boy = $max_boy;
    }

    # Eski ve yeni resimler
    $eski = imagecreatefromjpeg($resim);
    $yeni = imagecreatetruecolor($son_en,$son_boy);

    # Eski resmi yeniden orneklendir
    imagecopyresampled(
        $yeni,$eski,0,0,0,0,
        $son_en,$son_boy,$en,$boy);

    # Yeni resmi bas ve icerigi cek
    imagejpeg($yeni,null,-1);
    $icerik = ob_get_contents();

    # Resimleri yoket ve icerigi cikart
    ob_end_clean();
    imagedestroy($eski);
    imagedestroy($yeni);

    return $icerik;

}
?>