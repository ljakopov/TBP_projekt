<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 4.2.2017.
 * Time: 22:03
 */
include_once './Baza.php';
session_start();
$baza = new Baza();
$username="";
$id=0;
$ime="";
$prezime="";
$grad="";
$ulica="";
$postanski_broj="";
$broj_mobitela="";
$radno_vrijeme="";
$cijena="";
$korisnicko="";
include_once './izbornik.php';
if(isset($_POST["submit"])) {
    $ime=$_POST["ime"];
    $prezime=$_POST['prezime'];
    $grad=$_POST['grad'];
    $ulica=$_POST['ulica'];
    $postanski_broj=$_POST['postanski_broj'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $broj_mobitela=$_POST['broj_mobitela'];
    $cijena=$_POST["cijena"];
    $radno_vrijeme=$_POST["radno_vrijeme"];
    $vrsta_korisnika=$_POST["vrsta_korisnika"];
    if($ime=="" || $prezime=="" || $grad=="" || $ulica=="" || $username=="" || $password=="" || $broj_mobitela=="" || $vrsta_korisnika==""){

    }else{
        if($vrsta_korisnika=="Administrator") {
            if($radno_vrijeme=="" || $cijena==""){}
            else {
                $upit = "INSERT INTO administrator VALUES('$ime', '$prezime', '$username', '$password', ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'),'$radno_vrijeme',$cijena,default)";
                $baza->queryDB($upit);
                header("Location:ispis_svih_korisnika.php");
            }
        }else{
            $upit = "INSERT INTO trener VALUES('$ime', '$prezime', '$username', '$password', ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'),null,default)";
            $baza->queryDB($upit);
            header("Location:ispis_svih_korisnika.php");
        }

    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unos trenera ili administratora</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <form action="dodaj_administratora.php" method="POST" class="form-horizontal"  name="update">
        <div class="form-group">
            <label for="email"  class="col-sm-2 control-label">*Ime</label>
            <div class="col-sm-10">
                <input type="text" id="email" class="form-control"  placeholder="Ime"  name="ime">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Prezime</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="prezime" placeholder="Prezime">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Grad</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="grad" placeholder="Grad">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Ulica</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="ulica" placeholder="Ulica">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Poštanski broj</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="postanski_broj"  placeholder="Poštanski broj">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Username</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="username"  placeholder="Username" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Password</label>
            <div class="col-sm-10">
                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Broj mobitela</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="broj_mobitela" ">
            </div>
        </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Radno vrijeme</label>
                <div class="col-sm-10">
                    <input type="text" id="Repassword" class="form-control" name="radno_vrijeme">
                    <span id="confirmMessage" class="confirmMessage"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Cijena</label>
                <div class="col-sm-10">
                    <input type="text" id="Repassword" class="form-control" name="cijena">
                    <span id="confirmMessage" class="confirmMessage"></span>
                </div>
            </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="sel1">Select list:</label>
            <div class="col-sm-10">
                <select class="form-control" id="sel1" name="vrsta_korisnika">
                    <option value="Administrator">Administrator</option>
                    <option value="Trener">Trener</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg" id="submit" />
            </div>
        </div>
    </form>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</html>
