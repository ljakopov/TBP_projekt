<?php
session_start();
include_once './Baza.php';
$baza = new Baza();
$vrsta_materijala=0;

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["id_grupe"])){
    $id_grupe=$_POST["id_grupe"];
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "mp4" && $imageFileType != "JPG"
    && $imageFileType != "gif" ) {
    echo "Format nije dozvoljen";
    $uploadOk = 0;
}

if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "JPG"){
    $vrsta_materijala=1;
}
else if($imageFileType == "pdf"){
    $vrsta_materijala=2;
}
else if($imageFileType == "mp4"){
    $vrsta_materijala=3;

}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Nije moguć upload.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        $naziv=$_FILES["fileToUpload"]["name"];
        //echo $target_file;
        $upit="INSERT INTO materijal VALUES(default, '$naziv', $vrsta_materijala, '$id_grupe','$target_file')";
        $rezultat = $baza->queryDB($upit);
        header("Location:prikaz_grupe.php?id=".$id_grupe);
    } else {
        echo "Došlo je do greške tijekom uploada.";
    }
}
?>