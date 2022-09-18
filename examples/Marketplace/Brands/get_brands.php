<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/v2/trendyol-marka-bilgileri

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_brands = $trendyol->marketplace->TrendyolMarketplaceBrands();

    $brands = $trendyol_marketplace_brands->get_brands();
    print_r($brands);
