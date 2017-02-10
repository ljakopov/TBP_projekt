<?php
/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 11.1.2017.
 * Time: 22:43
 */

session_start();
include_once './Baza.php';
$baza = new Baza();
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
<?php include_once './izbornik.php';
?>
<div class="container">
    <h1>Web stranica za sport</h1>
    <h5>Omogućujemo bavljenje različitim sportovima od nogometa do američkog nogometa. Za prikaz sadržaja potrebno se ulogirati na stranicu.</h5>
    <?php if(isset($_SESSION["id"]) && $_SESSION["vrsta_korisnika"]=="Obicni_korisnik"){?>
    <table class="table table-hover">
        <tr>
            <th>Sport</th>
            <th>Prikaz</th>
        </tr>
        <?php
        $upit="SELECT id, naziv FROM sport";
        $rezultat= $baza->queryDB($upit);
        while ($row = pg_fetch_array($rezultat)){
            $naziv=$row["id"];
            $ispis="<tr>";
            $ispis.="<td>".$row["naziv"]."</td>";
            $ispis.="<td><a href='grupe_za_prijavu.php?naziv=$naziv' class='btn btn-danger'>Opsirnije</a></td>";
            $ispis.="</tr>";
            echo $ispis;
        }
        ?>
        </tbody>
    </table>
    <?php }?>
</div>

</body>
</html>