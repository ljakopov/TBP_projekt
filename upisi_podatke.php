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
$radioButton="";
$korisnicko="";
$spol="";
$pravi_username=$_SESSION["user_korisnik"];
if (isset($_POST['submit'])) {
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
        $upit_administrator = "UPDATE administrator SET ime='$ime', prezime='$prezime',korisnicko='$username',informacije=ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'), radno_vrijeme='$radno_vrijeme', cijena='$cijena' WHERE korisnicko='$username'";
        $rezultat=$baza->queryDB($upit_administrator);
        header('Location: ispis_svih_korisnika.php');
    }
    else if($_POST["vrsta_korisnika"]=="Trener"){
        $upit_trener = "UPDATE trener SET ime='$ime', prezime='$prezime',korisnicko='$username',informacije=ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela') WHERE korisnicko='$username'";
        $rezultat=$baza->queryDB($upit_trener);
        if($_SESSION["vrsta_korisnika"]=="Administrator"){
            header('Location: ispis_svih_korisnika.php');
        }
        else{
            header('Location: index.php');
        }

    }
    else{
        $spol=$_POST['inlineRadioOptions'];
        $upit = "UPDATE obicni_korisnik SET ime='$ime', prezime='$prezime',korisnicko='$username',informacije=ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'), spol='$spol' WHERE korisnicko='$username'";
        $rezultat=$baza->queryDB($upit);
        if($_SESSION["vrsta_korisnika"]=="Administrator"){
            header('Location: ispis_svih_korisnika.php');
        }
        else{
            header('Location: index.php');
        }
    }
}