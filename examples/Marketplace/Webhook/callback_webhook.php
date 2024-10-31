<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/siparis-entegrasyonu/siparis-paketlerini-cekme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_shipments = $trendyol->marketplace->TrendyolMarketplaceWebhook();

    $shipments = $trendyol_marketplace_shipments->callback_webhook(); //TRENDYOLDAN GELEN JSON ALIR
    print_r($shipments);
