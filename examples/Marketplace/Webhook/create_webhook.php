<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/siparis-entegrasyonu/siparis-paketlerini-cekme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_shipments = $trendyol->marketplace->TrendyolMarketplaceWebhook();

    $shipments = $trendyol_marketplace_shipments->create_webhook('https://hayatikodla.net');
    print_r($shipments);
