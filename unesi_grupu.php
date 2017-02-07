<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 5.2.2017.
 * Time: 21:10
 */
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}
include_once './Baza.php';
$baza = new Baza();
$razmak=" ";
$naziv="";
$mjesto="";
$vrijemeDatum="";
$trener="";
$sport="";
$broj="";
$provjera=false;
if(isset($_POST["submit"])){
    $naziv=$_POST["naziv"];
    $mjesto=$_POST["mjesto"];
    $trener=$_POST["trener"];
    $broj=$_POST["broj"];
    $sport=$_POST["sport"];
    $vrijemeDatum=$_POST["vrijeme"];
    if($naziv=="" || $mjesto=="" || $trener=="" || $sport=="" || $vrijemeDatum=="" || $broj==0){
        $provjera=true;
        $ispisAlerta="Niste upisali sve podatke";
    }
    else{
        $pieces = explode(" ", $vrijemeDatum);
        $upit="INSERT INTO grupa VALUES(default, '$naziv', $trener, $sport, ROW('$mjesto','$pieces[1]','$pieces[0]'),'$broj')";
        $baza->queryDB($upit);
    }

}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Nova grupa</title>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link href="jquery.datetimepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <?php if($provjera==true){?>
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $ispisAlerta ?>
        </div>
    <?php }?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal" name="novaGrupa">
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Naziv grupe</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="naziv" placeholder="Naziv">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Mjesto</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="mjesto" placeholder="Mjesto">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Broj mjesta</label>
            <div class="col-sm-10">
                <input type="text" id="password1" class="form-control" name="broj" placeholder="Broj ljudi koje grupa prima">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="sel1">Sport</label>
            <div class="col-sm-10">
                <select class="form-control" id="sport" name="sport">
                    <?php
                    $upit = "SELECT id,naziv from sport";
                    $rezultat = $baza->queryDB($upit);
                    while ($row = pg_fetch_array($rezultat)){
                        $id=$row['id'];
                        $ispis="<option value='$id'>".$row["naziv"]."</option>";
                        echo $ispis;
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="sel1">Trener</label>
            <div class="col-sm-10">
                <select class="form-control" id="sel1" name="trener">
                    <?php
                    $upit = "SELECT id, ime, prezime from trener";
                    $rezultat = $baza->queryDB($upit);
                    while ($row = pg_fetch_array($rezultat)){
                        $id=$row['id'];
                        $ispis="<option value='$id'>".$row["ime"].$razmak.$row["prezime"]."</option>";
                        echo $ispis;
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Vrijeme i datum</label>
            <div class="col-sm-10">
        <input type="text" id="datetimepicker" class="form-control" name="vrijeme">
        </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg" id="submit" />
            </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="jquery.datetimepicker.full.js"></script>
<script>
    $("#datetimepicker").datetimepicker();
</script>
</body>
</html>
