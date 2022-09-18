<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/v2/trendyol-kategori-bilgileri

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_categories = $trendyol->marketplace->TrendyolMarketplaceCategories();

    $categories = $trendyol_marketplace_categories->get_categories();
    print_r($categories);
