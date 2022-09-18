<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/urun-filtreleme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_products = $trendyol->marketplace->TrendyolMarketplaceProducts();

    $product = $trendyol_marketplace_products->update_product_price_and_stock('XXXXXXX', 100, 200, 200);
    print_r($product);
