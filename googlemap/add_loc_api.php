
<?php include 'config.php'; ?>

<?php

if (isset($_POST['add'])) {
    $name = $_POST['name']; 
    $info = $_POST['info'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $query = "INSERT into locations (name,info,lat,lng) values ('$name','$info','$lat','$lng')";
    if ($mysqli->query($query) == true) {

        header("Location: http://localhost/googlemap/location.php");


        // echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$code&choe=UTF-8'>";
    } else {
        header('location:addQrCode.php?msg=data failed ');
    }
}
?>