<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/soru-cevap-entegrasyonu/musteri-sorularini-cekme

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_customer_questions = $trendyol->marketplace->TrendyolMarketplaceCustomerQuestions();

    $filter             = [
        'status' => 'WAITING_FOR_ANSWER', //WAITING_FOR_ANSWER, WAITING_FOR_APPROVE, ANSWERED, REPORTED, REJECTED
    ];
    $customer_questions = $trendyol_marketplace_customer_questions->get_my_customer_questions($filter);
    print_r($customer_questions);
