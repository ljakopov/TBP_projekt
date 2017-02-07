<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 7.2.2017.
 * Time: 2:48
 */
include_once './Baza.php';
$baza = new Baza();
$id=0;
$idKorisnika=0;
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $idKorisnika=$_SESSION["id"];
    $upit = "INSERT INTO korisnik_grupa VALUES(DEFAULT, '$id', $idKorisnika)";
    $baza->queryDB($upit);
    header("Location:index.php");
}