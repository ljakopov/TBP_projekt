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
$naziv="";
include_once './izbornik.php';
if(isset($_POST["submit"])) {
    $naziv=$_POST["naziv"];
    if($naziv==""){

    }
    else {
        $upit = "INSERT INTO sport VALUES(default, '$naziv')";
        $baza->queryDB($upit);
        header("Location:grupe_sport.php");
    }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unos sporta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <form action="unesi_sport.php" method="POST" class="form-horizontal"  name="update">
        <div class="form-group">
            <label for="naziv"  class="col-sm-2 control-label">Naziv sporta</label>
            <div class="col-sm-10">
                <input type="text" id="naziv" class="form-control"  placeholder="Naziv" name="naziv">
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