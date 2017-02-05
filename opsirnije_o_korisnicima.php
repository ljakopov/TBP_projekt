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
$inlineRadioOptions="";
$broj_grupa=0;
$radno_vrijeme="";
$cijena="";
$sport=0;
$radioButton="";
$korisnicko="";
if(isset($_GET['username'])) {
    $username = $_GET['username'];
    $upit = "SELECT id,ime, prezime, korisnicko, (informacije).grad, (informacije).ulica, (informacije).postanski_broj, (informacije).broj_mobitela,spol,broj_grupa from obicni_korisnik WHERE korisnicko='$username'";
    $upit_administrator = "SELECT * from administrator WHERE korisnicko='$username'";
    $upit_trener = "SELECT id,ime, prezime, korisnicko, (informacije).grad, (informacije).ulica, (informacije).postanski_broj, (informacije).broj_mobitela,sport,broj_grupa from trener WHERE korisnicko='$username'";
    $rezultat_adminitrator = $baza->queryDB($upit_administrator);
    if (pg_num_rows($rezultat_adminitrator) != 0) {
        $row = pg_fetch_array($rezultat_adminitrator);
            $id=$row["id"];
            $ime=$row["ime"];
            $prezime=$row["prezime"];
            $grad=$row["grad"];
            $ulica=$row["ulica"];
            $postanski_broj=$row["postanski_broj"];
            $broj_mobitela=$row["broj_mobitela"];
            $radno_vrijeme=$row["radno_vrijeme"];
            $cijena=$row["cijena"];
            $radioButton="Administrator";
        }
     else {
        $rezultat_trener = $baza->queryDB($upit_trener);
        if (pg_num_rows($rezultat_trener) != 0) {
            $row = pg_fetch_array($rezultat_trener);
            $id=$row["id"];
            $ime=$row["ime"];
            $prezime=$row["prezime"];
            $grad=$row["grad"];
            $korisnicko=$row["korisnicko"];
            $ulica=$row["ulica"];
            $postanski_broj=$row["postanski_broj"];
            $broj_mobitela=$row["broj_mobitela"];
            $sport=$row["sport"];
            $broj_grupa=$row["broj_grupa"];
            $radioButton="Trener";
        } else {
            $rezultat = $baza->queryDB($upit);
            if (pg_num_rows($rezultat) != 0) {
                $row = pg_fetch_array($rezultat);
                $korisnicko=$row["korisnicko"];
                $ime=$row["ime"];
                $prezime=$row["prezime"];
                $grad=$row["grad"];
                $ulica=$row["ulica"];
                $postanski_broj=$row["postanski_broj"];
                $broj_mobitela=$row["broj_mobitela"];
                $inlineRadioOptions=$row["spol"];
                $broj_grupa=$row["broj_grupa"];
                $radioButton="Obicni_korisnik";
            }
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">



</head>
<body>
<div class="container">
    <form action="upisi_podatke.php" method="POST" class="form-horizontal"  name="update">
        <div class="form-group">
            <label for="email"  class="col-sm-2 control-label">*Ime</label>
            <div class="col-sm-10">
                <input type="text" id="email" class="form-control"  placeholder="Ime" value="<?php echo $ime ?>" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> name="ime">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Prezime</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="prezime" value="<?php echo $prezime ?>" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> placeholder="Prezime">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Grad</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="grad" value="<?php echo $grad ?>" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> placeholder="Grad">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Ulica</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="ulica" value="<?php echo $ulica ?>" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> placeholder="Ulica">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Poštanski broj</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="postanski_broj" value="<?php echo $postanski_broj ?>" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> placeholder="Poštanski broj">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Username</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="username" value="<?php echo $username ?>" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php } $_SESSION["user_korisnik"]=$username ?> placeholder="Username">
            </div>
        </div>
        <?php if($radioButton=="Trener"){?>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Sport</label>
            <div class="col-sm-10">
                <input type="text" id="sport" class="form-control" name="sport" value="<?php echo $sport ?>" <?php if($_SESSION["ime"]!=$korisnicko){?> disabled <?php }?>">
            </div>
        </div>
        <?php }?>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Broj grupa</label>
            <div class="col-sm-10">
                <input type="text" id="Repassword" class="form-control" name="repassword" disabled value="<?php echo $broj_grupa ?>">
                <span id="confirmMessage" class="confirmMessage"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Broj mobitela</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="broj_mobitela" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> value="<?php echo $broj_mobitela ?>");">
            </div>
        </div>
        <?php if($radioButton=="Administrator"){?>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Radno vrijeme</label>
            <div class="col-sm-10">
                <input type="text" id="Repassword" class="form-control" name="radno_vrijeme" value="<?php echo $radno_vrijeme ?>">
                <span id="confirmMessage" class="confirmMessage"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Cijena</label>
            <div class="col-sm-10">
                <input type="text" id="Repassword" class="form-control" name="cijena" value="<?php echo $cijena ?>">
                <span id="confirmMessage" class="confirmMessage"></span>
            </div>
        </div>
        <?php }?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="sel1">Select list:</label>
            <div class="col-sm-10">
                <select class="form-control" id="sel1" name="vrsta_korisnika" <?php if($_SESSION["vrsta_korisnika"]!="Administrator"){?>disabled <?php }?>>
                    <option value="Administrator" <?php if($radioButton == "Administrator")echo "selected";?>>Administrator</option>
                    <option value="Trener" <?php if($radioButton == "Trener")echo "selected";?>>Trener</option>
                    <option value="Obicni_korisnik" <?php if($radioButton == "Obicni_korisnik")echo "selected";?>>Obicni korisnik</option>
                    <?php ?>
                </select>
            </div>
        </div>
        <?php if($radioButton=="Obicni_korisnik"){?>
        <div class="form-group">
            <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> id="inlineRadio2" <?php if($inlineRadioOptions=="M"){?> checked  <?php } ?> value="M"> M
            </label>
        <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" <?php if($_SESSION["ime"]!=$korisnicko){?>disabled <?php }?> id="inlineRadio2" <?php if($inlineRadioOptions=="Z"){?> checked  <?php } ?> value="Z"> Z
        </label>
        </div>
        <?php } $_SESSION["drugi_korisnik"]=$radioButton;?>
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

