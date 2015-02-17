<?php
function po($par, $st=false){
    // $_POST[''] tek tırnak-' çift tırnak-" gibi şeylerde hata almamak için vs vs. Kulllanımı: $ornek=po("ornek",true);
    if($st){
        return htmlspecialchars(addslashes(trim($_POST[$par])));
    }
    else{
        return addslashes(trim($_POST[$par]));
    }
}
function go($url,$zaman=0){ //Kullanımı go("siteadi.com",1) ya da go("siteadi.com")
    if($zaman)
        header("refresh:{$zaman}; url={$url}");
    else
        header("Location:{$url}");
}
?>
