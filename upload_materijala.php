
<?php include_once './izbornik.php';
session_start();
if(!isset($_SESSION["ime"])){
    header('Location: login.php');
}
if(isset($_GET["id"])){
    $id_grupe=$_GET["id"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload"/>
                <input type="hidden" name="id_grupe" value="<?php echo $id_grupe ?>">
                <p style="text-align: right; margin-top: 20px;">
                    <input type="submit" value="Upload Image" name="submit" class="btn btn-lg btn-primary" />
                </p>
            </form>
        </div>
        <div class="col-md-4"></div>
</div>
</body>
</html>
</html>