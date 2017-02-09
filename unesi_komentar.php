<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 9.2.2017.
 * Time: 12:52
 */
session_start();
$komentar="";
include_once './Baza.php';
$baza = new Baza();
if(isset($_POST["submit"])){
    $komentar=$_POST["komentar"];
    $id_post=$_SESSION["id_post"];
    $korisnik= $_SESSION["ime"];
    $upit="INSERT INTO komentar VALUES (default, '$komentar','$id_post','$korisnik')";
    $baza->queryDB($upit);
    header("Location:komentari.php?id=".$id_post);
}
?>