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
