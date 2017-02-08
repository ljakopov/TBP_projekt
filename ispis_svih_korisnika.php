<?php include_once './izbornik.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ispis svih korisnika</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <ul class="nav nav-pills">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Profile</a></li>
        <li role="presentation"><a href="#">Messages</a></li>
    </ul>
    <table class="table table-hover">
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Username</th>
            <th>Grad</th>
            <th>Ulica</th>
            <th>Poštanski broj</th>
            <th>Broj mobitela</th>
            <th>Radnje</th>
        </tr>
<?php
include_once './Baza.php';
$baza = new Baza();
$upit="SELECT  ime, prezime, korisnicko, (informacije).grad, (informacije).ulica, (informacije).postanski_broj, (informacije).broj_mobitela FROM korisnik";
$rezultat=$baza->queryDB($upit);
while ($row = pg_fetch_array($rezultat)){
    $korisnicko=$row["korisnicko"];
    $ispis="<tr>";
    $ispis.="<td>".$row["ime"]."</td>";
    $ispis.="<td>".$row["prezime"]."</td>";
    $ispis.="<td>".$row["korisnicko"]."</td>";
    $ispis.="<td>".$row["grad"]."</td>";
    $ispis.="<td>".$row["ulica"]."</td>";
    $ispis.="<td>".$row["postanski_broj"]."</td>";
    $ispis.="<td>".$row["broj_mobitela"]."</td>";
    $ispis.="<td><a href='opsirnije_o_korisnicima.php?username=$korisnicko' class='btn btn-danger'>Opsirnije</a></td>";
    $ispis.="</tr>";
    echo $ispis;
}
 ?>
        </tbody>
    </table>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</html>


