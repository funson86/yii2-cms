Yii2 Cms -under development
=========
Yii2 Cms for other application, especially for [Yii2 Adminlte](https://github.com/funson86/yii2-adminlte)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist funson86/yii2-cms "*"
```

or add

```
"funson86/yii2-cms": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

### Migration

Migration run

```php
php yii migrate --migrationPath=@funson86/cms/migrations
```

### Config url rewrite in /common/config/main.php
```php
    'timeZone' => 'Asia/Shanghai', //time zone affect the formatter datetime format
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'formatter' => [ //for the showing of date datetime
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],
    ],
```

### Config backend modules in backend/config/main.php

```php
    'modules' => [
        'cms' => [
            'class' => 'funson86\cms\Module',
            'controllerNamespace' => 'funson86\cms\controllers\backend'
        ],
    ],
```

### Config frontend modules in frontend/config/main.php

```php
    'defaultRoute' => 'cms', //set cms as default route
    'modules' => [
        'cms' => [
            'class' => 'funson86\cms\Module',
            'controllerNamespace' => 'funson86\cms\controllers\frontend'
        ],
    ],
```

### Add yii2-cms params in /frontend/config/params.php.
```php
return [
    'cmsTitle' => 'HikeCms',
    'cmsTitleSeo' => 'Simple Cms based on Yii2',
    'cmsFooter' => 'Copyright &copy; ' . date('Y') . ' by ahuasheng on Yii2. All Rights Reserved.',
    'cmsPostPageCount' => '2',
    'cmsLinks' => [
        'Google' => 'http://www.google.com',
        'Funson86 Cms' => 'http://github.com/funson86/yii2-cms',
    ],
];
```

### Access Url
1. backend : http://you-domain/backend/web/cms
   - Catalog : http://you-domain/backend/web/cms/cms-catalog
   - Show : http://you-domain/backend/web/cms/cms-show
2. frontend : http://you-domain/fontend/web/cms
