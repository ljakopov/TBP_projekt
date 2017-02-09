<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 9.2.2017.
 * Time: 2:52
 */
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}

include_once './izbornik.php';
include_once './Baza.php';
$baza = new Baza();
if(isset($_GET["id"])){
    $_SESSION["id_grupe"]=$_GET["id"];
    echo $_SESSION["id_grupe"];
}
if(isset($_POST["submit"])){
    $naziv=$_POST["naziv"];
    $id_grupe=$_SESSION["id_grupe"];
    $_SESSION["id_grupe"]="";
    $upit="INSERT INTO post VALUES(default, '$naziv','$id_grupe')";
    $baza->queryDB($upit);
    header("Location:prikaz_grupe.php?id=".$id_grupe);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Novi post grupe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <form action="novi_post.php" method="POST" class="form-horizontal"  name="update">
        <div class="form-group">
            <label for="email"  class="col-sm-2 control-label">Naziv posta</label>
            <div class="col-sm-10">
                <input type="text" id="naziv" class="form-control"  placeholder="Naziv posta"  name="naziv">
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

