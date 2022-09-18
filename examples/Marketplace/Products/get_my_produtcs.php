<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/urun-filtreleme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_products = $trendyol->marketplace->TrendyolMarketplaceProducts();

    $filter    = [
        'approved' => 'true',
    ];
    $products = $trendyol_marketplace_products->get_my_products($filter);
    print_r($products);
