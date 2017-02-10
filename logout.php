<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 9.2.2017.
 * Time: 16:47
 */
session_start();
$_SESSION["id"]="";
$_SESSION["ime"]="";
$_SESSION["vrsta_korisnika"]="";
session_destroy();
header("Location:index.php")
?>