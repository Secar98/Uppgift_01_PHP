<?php
class App
{
    // Fetches data from specified endpoint
    public static function get_data($url)
    {

        $response = @file_get_contents($url);
        if (!$response)
            throw new Exception("Could not access $url");

        return json_decode($response, true);
    }

    // Renders and filters all the products
    public static function render_products($products, $category)
    {
        echo "<div class='container'>";
        foreach ($products as $product) {
            if ($product['category'] === "$category") {
                self::hmtl_products_layout($product);
            }
        }
        echo "</div>";
    }

    // HTML-layout for rendering method
    private static function hmtl_products_layout($product)
    {
        echo "<div class='product-container'>
         <img class='product-image' alt='$product[title]' src='$product[image]'>
         <div class='product-description'>
         <h2 class='product-title'>$product[title]</h2>
         <h3><span>$product[price] $</span></h3>
         <p>$product[description]</p>
         </div>
         </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free shipping and returns | Shop the latest trends in clothing & jewelery!">
    <title>Fake store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            color: #fff;
        }

        body {
            background-color: #111;
            box-sizing: border-box;
            max-width: 1920px;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .page-header {
            font-size: 3em;
            text-align: center;
            transform: rotate(-2.5deg);
            margin-top: 1.5em;
            color: #000;
            text-shadow: 2px 2px #000;
        }

        .page-header span {
            background-color: #fff;
            color: #000;
            padding: 15px;
        }

        .item-header {
            font-size: 2.5em;
            transform: rotate(-5deg);
            margin-left: 0.5em;
            margin-top: 1.5em;
            margin-bottom: 2.5em;
            text-shadow: 2px 2px #000;
        }

        .item-header span {
            background-color: #fff;
            color: #000;
            padding: 15px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .product-container {
            position: relative;
            border-radius: 10px;
            box-shadow: 0px 2px;
            margin: 10px 10px;
            min-height: 450px;
            padding: 20px;
            background-color: #fff;
        }

        .product-container h3 {
            margin-top: 10px;
            margin-bottom: 20px;
            transform: rotate(-2deg);
        }

        .product-container h3 span {
            background-color: yellow;
            color: #000;
            padding: 5px;
        }

        .product-title {
            background-color: #000;
            text-align: center;
            max-width: 80%;
            transform: rotate(-1deg);
            margin: 15px;
            padding: 10px;
            color: #fff;
        }

        .product-image {
            max-width: 40%;
            max-height: 250px;
            min-height: 250px;
            display: block;
            margin: auto auto;
            padding-bottom: 10px;
        }

        .product-description {
            position: absolute;
            bottom: 10px;
        }

        .product-description p {
            width: 95%;
            color: #000;
            max-height: 100px;
            overflow: auto;
            margin-top: 15px;
        }

        @media only screen and (max-width: 650px) {

            .container {
                display: grid;
                grid-template-columns: 1fr;
                margin: auto auto;
            }

            .page-header {
                font-size: 2.5em;
                margin: 20px auto 20px 10px;
            }

            .page-header span {
                padding: 5px;
            }

            .item-header {
                font-size: 2em;
                margin-bottom: 1.5em;
                margin-top: 2.5em;
            }

        }
    </style>
</head>

<body>

    <h1 class="page-header"><span>Welcome to fake store!</span></h1>

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