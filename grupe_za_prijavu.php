<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 6.2.2017.
 * Time: 15:56
 */
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Početna stranica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php include './izbornik.php'; ?>
<div class="container">
    <table class="table table-hover">
        <tr>
            <th>Ime grupe</th>
            <th>Mjesto održavanje</th>
            <th>Prvi trening</th>
            <th>Vrijeme</th>
            <th>Grupa sadrži</th>
            <th>Ukupna veličina grupe</th>
            <th>Akcije</th>
        </tr>
        <?php
        include_once './Baza.php';
        $baza = new Baza();
        $naziv_grupe="";
        $id=0;
        if(isset($_GET["naziv"])) {
            $naziv_grupe = $_GET["naziv"];
            $id_korisnika = $_SESSION["id"];
            $upit = "SELECT grupa.naziv, grupa.id,(grupa.odrzavanje).vrijeme,(grupa.odrzavanje).mjesto,(grupa.odrzavanje).datum,grupa.broj_mjesta,count(korisnik_grupa.grupa_id) FROM grupa LEFT JOIN korisnik_grupa ON korisnik_grupa.grupa_id=grupa.id WHERE grupa.sport='$naziv_grupe' AND grupa.id NOT IN(SELECT grupa.id FROM grupa, korisnik_grupa WHERE grupa.id=korisnik_grupa.grupa_id AND korisnik_grupa.korisnik_id='$id_korisnika' AND grupa.sport='$naziv_grupe')GROUP BY grupa.naziv,grupa.id";
            $rezultat = $baza->queryDB($upit);
            while ($row = pg_fetch_array($rezultat)) {
                $id = $row["id"];
                $ispis = "<tr>";
                $ispis .= "<td>" . $row["naziv"] . "</td>";
                $ispis .= "<td>" . $row["mjesto"] . "</td>";
                $ispis .= "<td>" . $row["datum"] . "</td>";
                $ispis .= "<td>" . $row["vrijeme"] . "</td>";
                $ispis .= "<td>" . $row["broj_mjesta"] . "</td>";
                $ispis .= "<td>" . $row["count"] . "</td>";
                $ispis .= "<td><a href='dodaj_u_grupu.php?id=$id' class='btn btn-danger'>Opsirnije</a></td>";
                $ispis .= "</tr>";
                echo $ispis;
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
