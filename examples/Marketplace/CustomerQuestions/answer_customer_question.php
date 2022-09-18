<?php

    //Source : https://developers.trendyol.com/tr/marketplace-entegrasyonu/soru-cevap-entegrasyonu/musteri-sorularini-cevaplama

    use Hasokeyk\Trendyol\Trendyol;

    require "vendor/autoload.php";

    $supplierId = 'XXXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_customer_questions = $trendyol->marketplace->TrendyolMarketplaceCustomerQuestions();

    $customer_questions = $trendyol_marketplace_customer_questions->answer_customer_question(12,'Dünyanın en güzel sorusunun cevabı');
    print_r($customer_questions);
