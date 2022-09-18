<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/urun-filtreleme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_products = $trendyol->marketplace->TrendyolMarketplaceProducts();

    $data = [
        'title'          => 'Dünyanın en güzel ürünün başlığı',
        'categoryId'     => 2840,
        'brandId'        => 1602974,
        'description'    => 'Dünyanın en güzel ürünün açıklaması',
        'quantity'       => 100,//Adet
        'cargoCompanyId' => 10,
    ];

    $product = $trendyol_marketplace_products->update_product_info('XXXXXXX', $data);
    print_r($product);
