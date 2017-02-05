<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 5.2.2017.
 * Time: 0:15
 */
session_start();
include_once './Baza.php';
$baza = new Baza();
$username="";
$id=0;
$ime="";
$prezime="";
$grad="";
$ulica="";
$postanski_broj="";
$broj_mobitela="";
$inlineRadioOptions="";
$broj_grupa=0;
$radno_vrijeme="";
$cijena="";
$sport=0;
$radioButton="";
$korisnicko="";
$spol="";
$pravi_username=$_SESSION["user_korisnik"];
echo $_SESSION["user_korisnik"];
$vrsta_korisnika="";
if (isset($_POST['submit'])) {
    //if($_SESSION["drugi_korisnik"]==$_POST["vrsta_korisnika"]){
    $ime=$_POST["ime"];
    $prezime=$_POST['prezime'];
    $grad=$_POST['grad'];
    $ulica=$_POST['ulica'];
    $postanski_broj=$_POST['postanski_broj'];
    $username=$_POST['username'];
    $broj_mobitela=$_POST['broj_mobitela'];
        if($_POST["vrsta_korisnika"]=="Administrator"){
            $radno_vrijeme=$_POST['radno_vrijeme'];
            $cijena=$_POST['cijena'];
            $upit_administrator = "UPDATE administrator SET ime='$ime', prezime='$prezime',korisnicko='$username',informacije=ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'), radno_vrijeme='$radno_vrijeme', cijena='$cijena' WHERE korisnicko='$$pravi_username'";
            $rezultat=$baza->queryDB($upit_administrator);
            $_SESSION["ime"] = $username;
            header('Location: ispis_svih_korisnika.php');
        }
        else if($_POST["vrsta_korisnika"]=="Trener"){
            $sport=$_POST['sport'];
            $upit_trener = "UPDATE trener SET ime='$ime', prezime='$prezime',korisnicko='$username',informacije=ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'), sport='$sport' WHERE korisnicko='$pravi_username'";
            $rezultat=$baza->queryDB($upit_trener);
            $_SESSION["ime"] = $username;
            header('Location: ispis_svih_korisnika.php');
        }
         else{
             $spol=$_POST['inlineRadioOptions'];
             $upit = "UPDATE obicni_korisnik SET ime='$ime', prezime='$prezime',korisnicko='$username',informacije=ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'), spol='$spol' WHERE korisnicko='$pravi_username'";
             $rezultat=$baza->queryDB($upit);
             $_SESSION["ime"] = $username;
             header('Location: ispis_svih_korisnika.php');
     }
}