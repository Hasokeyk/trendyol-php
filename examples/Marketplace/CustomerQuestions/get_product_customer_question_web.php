<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/urun-entegrasyonu/urun-filtreleme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_customer_questions = $trendyol->marketplace->TrendyolMarketplaceCustomerQuestions();

    //BARKOD NUMARASI TRENDYOLDA EKLENEN ÖZEL BİR NUMARADIR. BU NUMARAYI SADECE MAĞAZA SAHİPLERİ BİLEBİLİR
    //O YÜZDEN BAŞKA BİR MAĞAZANIN ÜRÜNÜNÜN YORUMLARINI ÇEKEMEZSİNİZ
    $products = $trendyol_marketplace_customer_questions->get_product_question_web(123456789);
    print_r($products);

