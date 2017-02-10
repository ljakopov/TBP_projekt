<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 25.1.2017.
 * Time: 2:18
 */
session_start();
include_once './izbornik.php';?>
<!DOCTYPE html>
<?php
include_once './Baza.php';
$baza = new Baza();

if(!isset($_SESSION["ime"])){
    header('Location: login.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grupe po sportovima</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <table class="table table-hover">
        <tr>
            <th>Sport</th>
            <th>Broj grupa</th>
            <th>Prikaz</th>
        </tr>
        <?php
        $upit="SELECT sport.naziv,sport.id,count(grupa.sport)FROM grupa,sport WHERE sport.id=grupa.sport GROUP BY sport.naziv,sport.id";
        $rezultat= $baza->queryDB($upit);
        while ($row = pg_fetch_array($rezultat)){
            $id=$row["id"];
            $ispis="<tr>";
            $ispis.="<td>".$row["naziv"]."</td>";
            $ispis.="<td>".$row["count"]."</td>";
            $ispis.="<td><a href='sve_grupe.php?id=$id' class='btn btn-danger'>Grupe</a></td>";
            $ispis.="</tr>";
            echo $ispis;
        }
        ?>
        </tbody>
    </table>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</html>
