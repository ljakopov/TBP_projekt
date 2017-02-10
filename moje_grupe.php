
<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 25.1.2017.
 * Time: 1:52
 */
 include_once './izbornik.php';
 if(!isset($_SESSION["ime"])) header('Location: login.php');
    include_once './Baza.php';
    $baza = new Baza();
    $id_korisnika = $_SESSION["id"];
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
</head>
<body>
<div class="container">
    <table class="table table-hover">
        <?php if($_SESSION["vrsta_korisnika"]=="Trener"){?>
        <tr>
            <th>Ime grupe</th>
            <th>Grupa sadrži</th>
            <th>Trenutno</th>
            <th>Akcije</th>
        </tr>
        <?php
            $upit = "SELECT grupa.naziv,trener.korisnicko, grupa.broj_mjesta,grupa.id,count(korisnik_grupa.grupa_id) FROM grupa LEFT JOIN korisnik_grupa ON korisnik_grupa.grupa_id=grupa.id  LEFT JOIN trener ON grupa.trener=trener.id  WHERE grupa.trener='$id_korisnika' GROUP BY grupa.naziv,grupa.id, trener.korisnicko";
            $rezultat = $baza->queryDB($upit);
            while ($row = pg_fetch_array($rezultat)) {
                $id = $row["id"];
                $ispis = "<tr>";
                $ispis .= "<td>" . $row["naziv"] . "</td>";
                $ispis .= "<td>" . $row["broj_mjesta"] . "</td>";
                $ispis .= "<td>" . $row["count"] . "</td>";
                $ispis .= "<td><a href='prikaz_grupe.php?id=$id' class='btn btn-danger'>Prikaži grupu</a></td>";
                $ispis .= "</tr>";
                echo $ispis;
            }
        }
        else if($_SESSION["vrsta_korisnika"]=="Obicni_korisnik"){?>
        <tr>
            <th>Ime grupe</th>
            <th>Mjesto</th>
            <th>Vrijeme</th>
            <th>Datum</th>
            <th>Akcije</th>
        </tr>
        <?php
            $upit = "SELECT grupa.naziv,(grupa.odrzavanje).mjesto,(grupa.odrzavanje).vrijeme,(grupa.odrzavanje).datum, grupa.id FROM korisnik_grupa LEFT JOIN grupa ON korisnik_grupa.grupa_id=grupa.id  LEFT JOIN obicni_korisnik ON obicni_korisnik.id=korisnik_grupa.korisnik_id  WHERE obicni_korisnik.id='$id_korisnika'";
            $rezultat = $baza->queryDB($upit);
            $korisnik=$_SESSION["id"];
            while ($row = pg_fetch_array($rezultat)) {
                $id = $row["id"];
                $ispis = "<tr>";
                $ispis .= "<td>" . $row["naziv"] . "</td>";
                $ispis .= "<td>" . $row["mjesto"] . "</td>";
                $ispis .= "<td>" . $row["vrijeme"] . "</td>";
                $ispis .= "<td>" . $row["datum"] . "</td>";
                $ispis .= "<td><a href='prikaz_grupe.php?id=$id' class='btn btn-danger'>Prikaži grupu</a>
                                <a href='brisi_iz_grupe.php?id=$id&idkorisnik=$korisnik' class='btn btn-danger'>Izbriši</a></td>";
                $ispis .= "</tr>";
                echo $ispis;
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</html>

