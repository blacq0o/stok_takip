<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=cozum_crmdb;charset=utf8", "cozum_crmdb", "s2ua35246");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>