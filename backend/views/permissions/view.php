<?php

use yii\helpers\Html;
use kartik\icons\Icon;
use kartik\detail\DetailView;

$this->title = Yii::t('auth', 'Permission \'{name}\'', ['name' => $model->name]);
$this->params['breadcrumbs'] = [
    [
        'label' => Yii::t('auth', 'Permissions'),
        'url' => ['/permissions']
    ],
    $model->name
];
?>

<div class="row">
    <div class="col-lg-6">
        <?php
        echo DetailView::widget([
            'model' => $model,
            'condensed' => true,
            'hover' => true,
            'mode' => DetailView::MODE_VIEW,
            'enableEditMode' => false,
            'panel' => [
                'heading' => Icon::show('book') . Yii::t('auth', 'Permission') .
                    Html::a(Icon::show('book') . Yii::t('auth', 'Update'), ['update', 'name' => $model->name], ['class' => 'btn-success btn-sm btn-dv pull-right']),
                'type' => DetailView::TYPE_DEFAULT,
            ],
            'attributes' => [
                'name',
                'description',
            ],
        ]);
        ?>
    </div>
</div>