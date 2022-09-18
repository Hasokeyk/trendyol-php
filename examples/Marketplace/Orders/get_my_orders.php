<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/siparis-entegrasyonu/siparis-paketlerini-cekme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_order = $trendyol->marketplace->TrendyolMarketplaceOrders();

    $filter = [
        'status' => 'Created',//Created, Picking, Invoiced, Shipped ,Cancelled, Delivered, UnDelivered, Returned, Repack, UnPacked, UnSupplied
    ];
    $orders = $trendyol_marketplace_order->get_my_orders($filter);
    print_r($orders);
