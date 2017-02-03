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
$div_class='"alert alert-danger"';
$role='"alert"';
$span_class='"glyphicon glyphicon-exclamation-sign"';
$aria_hiden='"true"';
$spann_class1='"sr-only"';
$greska="";
$provjera=false;
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "" || $password == "") {
        $provjera=true;
        $greska="Potrebno je upisati sve podatke";
    }
    else {
        $upit = "SELECT * from korisnik WHERE korisnicko='$username' and lozinka='$password'";
        $rezultat = $baza->queryDB($upit);
        if (pg_num_rows($rezultat) != 0) {
            $row = pg_fetch_array($rezultat);
            $_SESSION["ime"] = $row["korisnicko"];
            $_SESSION["id"] = $row["id"];
            $upit_administrator = "SELECT id from administrator WHERE id='$row[id]'";
            $upit_trener = "SELECT id from trener WHERE id='$row[id]'";
            $rezultat_adminitrator = $baza->queryDB($upit_administrator);
            if (pg_num_rows($rezultat_adminitrator) != 0) {
                $_SESSION["tip_korisnika"] = "administrator";
            } else {
                $rezultat_trener = $baza->queryDB($upit_trener);
                if (pg_num_rows($rezultat_trener) != 0) {
                    $_SESSION["tip_korisnika"] = "trener";
                } else {
                    $_SESSION["tip_korisnika"] = "korisnik";
                }
            }
            header('Location: index.php');
        } else {
            $provjera = true;
            $greska = "Korisnik ne postoji u bazi ili ste unjeli krivu lozinku za korisnika";
    }
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <?php
    if($provjera==true) {
        $ispis = "<div class=" . $div_class . "role=" . $role . ">";
        $ispis .= "<span class=" . $span_class . "aria-hidden=" . $aria_hiden . "></span>";
        $ispis .= "<span class=" . $spann_class1 . "></span>";
        $ispis .= $greska;
        $ispis .= "</div>";
        echo $ispis;
    }
?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal" data-toggle="validator" name="registracija">
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

