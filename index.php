<?php
include 'App.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free shipping and returns | Shop the latest trends in clothing & jewelery!">
    <title>Fake store</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1 class="page-header"><span>Welcome to fake store</span></h1>

    <?php
    try {
        $products = App::get_data("https://fakestore-api-sebcar98.herokuapp.com/");
    } catch (Exception $error) {
        die($error->getMessage());
    }

    echo "<h1 class='item-header'><span>Women Clothing</span></h1>";
    App::render_products($products, "women clothing");

    echo "<h1 class='item-header'><span>Men Clothing</span></h1>";
    App::render_products($products, "men clothing");

    echo "<h1 class='item-header'><span>Jewelery</span></h1>";
    App::render_products($products, "jewelery");

    ?>
</body>

</html>