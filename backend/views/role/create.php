<?php

$this->title = Yii::t('auth', 'Create Role');
$this->params['breadcrumbs'] = [
    [
        'label' => Yii::t('auth', 'Roles'),
        'url' => ['/roles']
    ],
    Yii::t('auth', 'Create')
];

echo $this->render('_form', [
    'model' => $model,
    'permissions' => $permissions
]);
