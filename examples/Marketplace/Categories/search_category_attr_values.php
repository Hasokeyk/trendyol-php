<?php

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_categories = $trendyol->marketplace->TrendyolMarketplaceCategories();

    //SEARCH TEXT
    $categories = $trendyol_marketplace_categories->search_category_attr_values(1704,344,'Hasan');
    print_r($categories);
    
    //SEARCH ID
    $categories = $trendyol_marketplace_categories->search_category_attr_values(1704,344,262118,'id');
    print_r($categories);
