<?php

    //Source : https://developers.trendyol.com/docs/marketplace/urun-entegrasyonu/trendyol-marka-listesi

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_addresses = $trendyol->marketplace->TrendyolMarketplaceAddresses();

    $addresses = $trendyol_marketplace_addresses->get_my_addresses();
    print_r($addresses);
