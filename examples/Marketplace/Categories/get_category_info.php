<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/v2/trendyol-kategori-ozellik-bilgileri

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_categories = $trendyol->marketplace->TrendyolMarketplaceCategories();

    $categories = $trendyol_marketplace_categories->get_category_info(2610);
    print_r($categories);
