# What is this

To send an SMS using Media4U,

``` php
use Sms\Media4U;

$username = 'xxxxxx-user';
$password = 'XXXXXXX';
$mobilenumber_sample1 = '080xxxxXXXX';
$mobilenumber_sample2 = '080xxxxXXXX';

//
$data = [
    [
        'tel' => $mobilenumber_sample1, // 電話番号
        'text' => 'HelloWorld! - 1', // SMS本文
    ],
    [
        'tel' => $mobilenumber_sample2, // 電話番号
        'text' => 'HelloWorld! - 2', // SMS本文
    ],
];

//
$Media4u = new Media4U($username, $password);
$result = $Media4u->send($data);
```




# How to use

1. write composer.json

``` json
"require": {
    "ryofujimotox/sms": "^1"
},
```

2. install

```
composer install
```

3. use

``` php
// todo FW使ってる場合はいらない
require_once 'vendor/autoload.php';

use Sms\Media4U;

$username = 'xxxxxx-user';
$password = 'XXXXXXX';
$mobilenumber_sample1 = '080xxxxXXXX';
$mobilenumber_sample2 = '080xxxxXXXX';

//
$data = [
    [
        'tel' => $mobilenumber_sample1, // 電話番号
        'text' => 'HelloWorld! - 1', // SMS本文
    ],
    [
        'tel' => $mobilenumber_sample2, // 電話番号
        'text' => 'HelloWorld! - 2', // SMS本文
    ],
];

//
$Media4u = new Media4U($username, $password);
$result = $Media4u->send($data);
```

### update

```
composer update
```





# Tests

1. install

```
composer install
```

2. run

```
./vendor/bin/phpunit tests
```

