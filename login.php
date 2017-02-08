<?php include_once './izbornik.php';?>
<!DOCTYPE html>
<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 13.1.2017.
 * Time: 1:32
 */
include_once './Baza.php';
$baza = new Baza();

$username="";
$password="";
$greska="";
$row="";
$provjera=false;
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "" || $password == "") {
        $provjera = true;
        $greska = " Potrebno je upisati sve podatke";
    } else {
        $upit = "SELECT * from obicni_korisnik WHERE korisnicko='$username' and lozinka='$password'";
        $upit_administrator = "SELECT * from administrator WHERE korisnicko='$username' and lozinka='$password'";
        $upit_trener = "SELECT * from trener WHERE korisnicko='$username' and lozinka='$password'";
        $rezultat_adminitrator = $baza->queryDB($upit_administrator);
        if (pg_num_rows($rezultat_adminitrator) != 0) {
            $row = pg_fetch_array($rezultat_adminitrator);
            $_SESSION["vrsta_korisnika"]="Administrator";
        } else {
            $rezultat_trener = $baza->queryDB($upit_trener);
            if (pg_num_rows($rezultat_trener) != 0) {
                $row = pg_fetch_array($rezultat_trener);
                $_SESSION["vrsta_korisnika"]="Trener";
            } else {
                $rezultat = $baza->queryDB($upit);
                if (pg_num_rows($rezultat) != 0) {
                    $row = pg_fetch_array($rezultat);
                    $_SESSION["vrsta_korisnika"]="Obicni_korisnik";
                }
                else{
                    $provjera = true;
                    $greska = " Korisnik ne postoji u bazi ili ste unjeli krivu lozinku za korisnika";
                }
            }
        }
    }
    if($row!=""){
        $_SESSION["ime"] = $row["korisnicko"];
        $_SESSION["id"] = $row["id"];
        header('Location: index.php');
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal" data-toggle="validator" name="registracija">
        <?php if($provjera==true){?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?php echo $greska ?>
            </div>
        <?php }?>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Username</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Password</label>
            <div class="col-sm-10">
                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
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
