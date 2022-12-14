<?php include 'config.php'; ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<style>
    .center {
        margin: auto;
        width: 50%;
        border: 3px solid skyblue;
        padding: 10px;
    }
</style>

<body>


    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="center">
            <h1>ADD LOCATION</h1>

            <div class="col-6">


                <form method="POST" action="add_loc_api.php">
                    <div class="form-group">
                        <label for="lat">Enter Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="lat">Enter Info</label>
                        <input type="text" class="form-control" id="info" name="info" placeholder="Enter Info">
                    </div>
                    <div class="form-group">
                        <label for="lat">Enter Latitude</label>
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="lat">Enter Longitude</label>
                        <input type="text" class="form-control" id="lng" name="lng" placeholder="Longitude">
                    </div>
                    
                    <button type="submit" name="add" class="btn btn-primary">Add Your Location</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>