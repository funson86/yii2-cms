<?php

$this->title = Yii::t('auth', 'Update \'{name}\'', ['name' => $model->name]);
$this->params['breadcrumbs'] = [
    [
        'label' => Yii::t('auth', 'Permissions'),
        'url' => ['/permissions']
    ],
    $this->title
];

echo $this->render('_form', [
    'model' => $model
]);