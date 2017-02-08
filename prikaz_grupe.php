<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 8.2.2017.
 * Time: 12:27
 */
session_start();
include_once './izbornik.php';
include_once './Baza.php';
$baza = new Baza();
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $upit="SELECT grupa.naziv,trener.korisnicko,trener.ime,trener.prezime,grupa.broj_mjesta,(grupa.odrzavanje).mjesto, (grupa.odrzavanje).vrijeme,(grupa.odrzavanje).datum,sport.naziv,count(korisnik_grupa.grupa_id) FROM grupa LEFT JOIN korisnik_grupa ON korisnik_grupa.grupa_id=grupa.id  LEFT JOIN trener ON grupa.trener=trener.id  LEFT JOIN sport on sport.id=grupa.sport WHERE grupa.id='$id' GROUP BY grupa.naziv,grupa.id, trener.korisnicko,trener.ime,trener.prezime,sport.naziv";
    $rezultat = $baza->queryDB($upit);
    $row = pg_fetch_array($rezultat);
    $naziv=$row[0];
    $ime_trenera=$row["ime"];
    $prezime_trenera=$row["prezime"];
    $ukupni_broj=$row["broj_mjesta"];
    $popunjeni_broj=$row["count"];
    $datum=$row["datum"];
    $vrijeme=$row["vrijeme"];
    $sport=$row[8];
    $mjesto=$row["mjesto"];
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moje grupe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .table{
            max-width: 80%;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Naziv grupe: <?php echo $naziv ?></h1>
    <h3>Ime i prezime trenera: <?php echo $ime_trenera."\n".$prezime_trenera?></h3>
    <h3>Sport: <?php echo $sport?></h3>
    <h3>Mjesto održavanja: <?php echo $mjesto?></h3>
    <h3>Vrijeme održavanja: <?php echo $vrijeme?></h3>
    <h3>Ukupni broj mjesta: <?php echo $ukupni_broj?></h3>
    <h3>Popunjena mjesta u grupi: <?php echo $popunjeni_broj?></h3>

    <?php if($_SESSION["vrsta_korisnika"]=="Trener"){?>
    <h2>Članovi grupe: </h2>
    <table class="table table-hover">
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Akcija</th>
        </tr>
        <?php
            $upit = "SELECT obicni_korisnik.id,obicni_korisnik.ime,obicni_korisnik.prezime,grupa.naziv FROM obicni_korisnik, korisnik_grupa, grupa WHERE obicni_korisnik.id=korisnik_grupa.korisnik_id AND grupa.id=korisnik_grupa.grupa_id AND grupa.id='$id'";
            $rezultat = $baza->queryDB($upit);
            while ($row = pg_fetch_array($rezultat)) {
                $korisnik = $row["id"];
                $ispis = "<tr>";
                $ispis .= "<td>" . $row["ime"] . "</td>";
                $ispis .= "<td>" . $row["prezime"] . "</td>";
                $ispis .= "<td><a href='brisi_iz_grupe.php?id=$id&korisnik=$korisnik'class='btn btn-danger'>Briši člana grupe</a></td>";
                $ispis .= "</tr>";
                echo $ispis;
            }
        }?>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</html>
