<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 9.2.2017.
 * Time: 11:46
 */
session_start();
include_once './izbornik.php';
include_once './Baza.php';
$baza = new Baza();
$ispis="";
if($_GET["id"]){
    $id=$_GET["id"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forum grupe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once './izbornik.php'; ?>
<div class="container">
    <?php
    $upit="SELECT id,naziv FROM post WHERE grupa_id='$id'";
    $rezultat= $baza->queryDB($upit);
    while ($row = pg_fetch_array($rezultat)) {
        $id_post=$row["id"];
        $naziv=$row["naziv"];?>
    <div class="jumbotron">
        <a href="komentari.php?id=<?php echo $id_post?>" target='_blank'><?php echo $naziv ?></a>
    </div>

   <?php } ?>

</div>

</body>
</html>
