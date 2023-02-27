<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance task-1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    //Importing all the classes to this php file.
    require "classes.php";
    //Creating a object of PutData()
    $obj = new PutData;
    $jsonData = $obj->FetchJsonContent();
    ?>
    
    <?php foreach ($jsonData as $data) { ?>
        <div class="container">
            <div class="total-content">
                <img class=arrayImg src="<?php echo $data->ImageSource ?>">
                <div class="content-text">
                    <h2><?php echo $data->title ?></h2>
                    <span><?php echo $data->title_value ?>
                    <a class="explore" href="<?php echo $data->exploreLink; ?>">Explore Now</a></span>
                </div>
            </div>
        </div>    
</body>

</html>
<?php } ?>
