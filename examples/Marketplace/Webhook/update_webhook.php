<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/siparis-entegrasyonu/siparis-paketlerini-cekme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_shipments = $trendyol->marketplace->TrendyolMarketplaceWebhook();

    $shipments = $trendyol_marketplace_shipments->update_webhook('xxxxxxx-xxxxxx-xxxxxxx-xxxxxx','https://hayatikodla.net');
    print_r($shipments);
