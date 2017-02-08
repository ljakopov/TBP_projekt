<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 8.2.2017.
 * Time: 14:26
 */
include_once './Baza.php';
$baza = new Baza();
if(isset($_GET["id"]) && isset($_GET["korisnik"])){
    $id=$_GET["id"];
    $korisnik=$_GET["korisnik"];

    $upit="DELETE FROM korisnik_grupa WHERE korisnik_id='$korisnik' AND grupa_id='$id'";
    $baza->queryDB($upit);
    header("Location:prikaz_grupe.php?id=".$id);
}
else if(isset($_GET["id"]) && isset($_GET["idkorisnik"])){
    $id=$_GET["id"];
    $idkorisnik=$_GET["idkorisnik"];

    $upit="DELETE FROM korisnik_grupa WHERE korisnik_id='$idkorisnik' AND grupa_id='$id'";
    $baza->queryDB($upit);
    header("Location:moje_grupe.php");
}
?>