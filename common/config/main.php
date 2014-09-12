<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'controllerNamespace' => 'console\controllers',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			//'defaultRoles' => ['guest'],
		],
		'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					//'basePath' => '@app/messages',
					//'sourceLanguage' => 'en',
					'fileMap' => [
						'app' => 'app.php',
						'app/error' => 'error.php',
					],
				],
			],
		],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            /*'i18n' => [
                'class' => 'yii\i18n\DbMessageSource',
                'sourceLanguage' => 'en',
                'forceTranslation' => true
            ]*/
        ],
        'detailview' => [
            'class' => '\kartik\detail-view\Module',
            /*'i18n' => [
                'class' => 'yii\i18n\DbMessageSource',
                'sourceLanguage' => 'en',
                'forceTranslation' => true
            ]*/
        ]
    ],
];
