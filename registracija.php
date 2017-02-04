<?php include_once './izbornik.php';?>
<!DOCTYPE html>
<?php
include_once './Baza.php';
$baza = new Baza();

$provjera=false;
$ime="";
$prezime="";
$grad="";
$ulica="";
$postanski_broj="";
$username="";
$password="";
$broj_mobitela="";
$inlineRadioOptions="";
if (isset($_POST['submit'])) {
    $ime=$_POST["ime"];
    $prezime=$_POST['prezime'];
    $grad=$_POST['grad'];
    $ulica=$_POST['ulica'];
    $postanski_broj=$_POST['postanski_broj'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $broj_mobitela=$_POST['broj_mobitela'];
    if($ime=="" || $prezime=="" || $grad=="" || $ulica=="" || $username=="" || $password=="" || $broj_mobitela=="" || empty($_POST['inlineRadioOptions'])){
        $provjera=true;
        $ispisAlerta="Niste upisali sve podatke";
    }
    else {
        $upit = "SELECT korisnicko from korisnik WHERE korisnicko='$username'";
        $inlineRadioOptions=$_POST['inlineRadioOptions'];
        $rezultat = $baza->queryDB($upit);
        if (pg_num_rows($rezultat) != 0) {
            $provjera=true;
            $ispisAlerta="Korisničko ime već postoji";
        } else {
            $unos_korisnika = "INSERT INTO obicni_korisnik VALUES('$ime', '$prezime', '$username', '$password', ROW('$grad', '$ulica', '$postanski_broj', '$broj_mobitela'), default, 0,'$inlineRadioOptions')";
            $baza->queryDB($unos_korisnika);
            header('Location: index.php');
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
</head>
<body>
<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal" data-toggle="validator" name="registracija">
        <?php if($provjera==true){?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?php echo $ispisAlerta ?>
            </div>
        <?php }?>
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
                <input type="text" id="password1" class="form-control" name="postanski_broj" placeholder="Poštanski broj">
            </div>
        </div>
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
            <label for="inputPassword3" class="col-sm-2 control-label">*Repassword</label>
            <div class="col-sm-10">
                <input type="password" id="Repassword" class="form-control" name="repassword" placeholder="Repassword" onkeyup="checkPass(); return false;">
                <span id="confirmMessage" class="confirmMessage"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">*Broj mobitela</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="broj_mobitela" placeholder="Broj mobitela" onkeyup="validatephone(this);">
            </div>
        </div>
        <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="M"> M
        </label>
        <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio2"  value="Z"> Z
        </label>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg" id="submit" />
            </div>
        </div>
    </form>
</div>
</body>
<script type="text/javascript">

    function checkPass()
    {
        var pass = document.getElementById('password');
        var Repass = document.getElementById('Repassword');
        var message = document.getElementById('confirmMessage');
        var button=document.getElementById('submit');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        if(pass.value == Repass.value){
            Repass.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Passwords odgovara"
            button.disabled=false;
        }else{
            Repass.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Passwords ne odgovara!"
            button.disabled=true;
        }
    }
    function validatephone(phone)
    {
        var maintainplus = '';
        var numval = phone.value
        if ( numval.charAt(0)=='+' )
        {
            var maintainplus = '';
        }
        curphonevar = numval.replace(/[\\A-šŽžZa-z!"£$%^&\,*+_={};:'@#~,.Š\/<>?|`¬\]\[]/g,'');
        phone.value = maintainplus + curphonevar;
        var maintainplus = '';
        phone.focus;
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</html>


