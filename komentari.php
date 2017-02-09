<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 9.2.2017.
 * Time: 12:14
 */
session_start();
include_once './izbornik.php';
include_once './Baza.php';
$baza = new Baza();
if($_GET["id"]){
    $id=$_GET["id"];
    $_SESSION["id_post"]=$id;
    $upit_naziv="SELECT naziv FROM post WHERE id='$id'";
    $rezultat_naziv = $baza->queryDB($upit_naziv);
    $row_naziv = pg_fetch_array($rezultat_naziv);
    $naziv_posta=$row_naziv["naziv"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Komentari</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once './izbornik.php'; ?>
<div class="container">
    <h2><?php echo $naziv_posta?></h2>
    <?php
    $upit="SELECT id,tekst,korisnik FROM komentar WHERE post_id='$id'";
    $rezultat= $baza->queryDB($upit);
    while ($row = pg_fetch_array($rezultat)) {
        $tekst=$row["tekst"];
        $korisnik=$row["korisnik"];?>
        <div class="jumbotron">
            <h4><?php echo $tekst?></h4>
            <h6><?php echo $korisnik ?></h6>
        </div>
    <?php } ?>

    <form action="unesi_komentar.php" method="POST"  name="registracija">
        <textarea class="form-control" rows="3" name="komentar"></textarea>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg" id="submit" />
    </form>

        </div>
</body>
</html>