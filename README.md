# Kurulum

### Gereksinimler
1- Bilgisayarınızda veya sunucunuzda "composer" kurulu olması. Kurulu değilse "https://getcomposer.org/download/" bu linkten yardım alabilirsiniz.
2- Bilgisayarınızda veya sunucunuzda Php 7.4 veya daha üstü yüklü olması gerekmekte.

### Kurulum komutu
Aşağıdaki komutu çalışma dizininizde açtığınız bir terminale yazarsanız kütüphaneyi kullanmaya başlayabilirsiniz

```shell
composer require hasokeyk/trendyol
```

# Kullanım

### Trendyol bağlantısı
Aşağıdaki örnek kod ile trendyol bağlantınızı yapabilirsiniz

```php
<?php

    use Hasokeyk\trendyol\Trendyol;

    require (__DIR__)."/vendor/autoload.php";

    $supplierId = 'XXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);
```

# Trendyol Marketplace İşlemleri

### Markaları çekmek
Trendyol'a kayıtlı olan tüm markaların listesini bu kodlar ile çekebilirsiniz.

```php
<?php

    use Hasokeyk\trendyol\Trendyol;

    require (__DIR__)."/vendor/autoload.php";

    $supplierId = 'XXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_brands = $trendyol->marketplace->TrendyolMarketplaceBrands();

    $brands = $trendyol_marketplace_brands->get_brands();
    print_r($brands);
```

### Marka Arama
Trendyol'a kendi markanızı veya başka markaları aratabilirsiniz.

```php
<?php

    use Hasokeyk\trendyol\Trendyol;

    require (__DIR__)."/vendor/autoload.php";

    $supplierId = 'XXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_brands = $trendyol->marketplace->TrendyolMarketplaceBrands();

    $brands = $trendyol_marketplace_brands->search_brand('Herkes Alıyo');
    print_r($brands);
```

### Kategorileri Çekmek
Trendyoldaki tüm kategorileri ve komisyonlarını çekebilirsiniz.

```php
<?php

    use Hasokeyk\trendyol\Trendyol;

    require (__DIR__)."/vendor/autoload.php";

    $supplierId = 'XXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_categories = $trendyol->marketplace->TrendyolMarketplaceCategories();

    $categories = $trendyol_marketplace_categories->get_categories();
    print_r($categories);
```

### Tekli Kategori Bilgisi Çekmek
Trendyoldaki belirlediğiniz kategorilerin bilgilerini ve komisyonunu çekebilirsiniz.

```php
<?php

    use Hasokeyk\trendyol\Trendyol;

    require (__DIR__)."/vendor/autoload.php";

    $supplierId = 'XXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_categories = $trendyol->marketplace->TrendyolMarketplaceCategories();

    $categories = $trendyol_marketplace_categories->get_category_info(2610);
    print_r($categories);
```
### Siparişleri Çekmek
Trendyoldaki mağazanıza ait tüm siparişleri çekebilirsiniz.

```php
<?php

    use Hasokeyk\trendyol\Trendyol;

    require (__DIR__)."/vendor/autoload.php";

    $supplierId = 'XXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_order = $trendyol->marketplace->TrendyolMarketplaceOrders();

    $filter = [
        'status' => 'Created',//Created, Picking, Invoiced, Shipped ,Cancelled, Delivered, UnDelivered, Returned, Repack, UnPacked, UnSupplied
    ];
    $orders = $trendyol_marketplace_order->get_my_orders($filter);
    print_r($orders);
```

### Ürünleri Çekmek
Trendyoldaki mağazanıza ait tüm ürünleri çekebilirsiniz.

```php
<?php

    use Hasokeyk\trendyol\Trendyol;

    require (__DIR__)."/vendor/autoload.php";

    $supplierId = 'XXXXX';
    $username   = 'XXXXXXXXXXXXXXXXXXXX';
    $password   = 'XXXXXXXXXXXXXXXXXXXX';

    $trendyol = new Trendyol($supplierId, $username, $password);

    $trendyol_marketplace_products = $trendyol->marketplace->TrendyolMarketplaceProducts();

    $filter    = [
        'approved' => 'true',
    ];
    $products = $trendyol_marketplace_products->get_my_products($filter);
    print_r($products);
```

## Diğer tüm özellikler için aşağıdaki linki kullanabilirsiniz.

https://github.com/Hasokeyk/trendyol-php/tree/main/examples/Marketplace