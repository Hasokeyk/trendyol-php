<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/v2/iade-sevkiyat-adresleri

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_addresses = $trendyol->marketplace->TrendyolMarketplaceAddresses();

    $addresses = $trendyol_marketplace_addresses->get_my_addresses();
    print_r($addresses);
