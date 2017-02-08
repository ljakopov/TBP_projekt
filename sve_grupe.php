<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 8.2.2017.
 * Time: 2:47
 */
session_start();
include_once './Baza.php';
$baza = new Baza();
$sport=0;
include_once './izbornik.php';
if(isset($_GET["id"])){
    $sport=$_GET["id"];
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Popis grupa po sportu</title>
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
            <th>Naziv</th>
            <th>Ukupni broj mjesta</th>
            <th>Popunjenih mjesta</th>
            <th>Prikaz</th>
        </tr>
        <?php
        $upit="SELECT grupa.naziv,grupa.broj_mjesta, grupa.id,count(korisnik_grupa.grupa_id) FROM grupa LEFT JOIN korisnik_grupa ON korisnik_grupa.grupa_id=grupa.id WHERE grupa.sport='$sport' GROUP BY grupa.naziv,grupa.id";
        $rezultat= $baza->queryDB($upit);
        while ($row = pg_fetch_array($rezultat)){
            $id=$row["id"];
            $ispis="<tr>";
            $ispis.="<td>".$row["naziv"]."</td>";
            $ispis.="<td>".$row["broj_mjesta"]."</td>";
            $ispis.="<td>".$row["count"]."</td>";
            $ispis.="<td><a href='grupe_za_prijavu.php?naziv=$id' class='btn btn-danger'>Pogledaj grupu</a></td>";
            $ispis.="</tr>";
            echo $ispis;
        }
        ?>
        </tbody>
    </table>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</html>

