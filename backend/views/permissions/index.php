<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;

$this->title = Yii::t('auth', 'Permissions');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'responsive' => true,
            'hover' => true,
            'showPageSummary' => false,
            'showFooter' => false,
            'export' => false,
            'panel' => [
                'heading' => '<h3 class="panel-title">' . Icon::show('lock') . Yii::t('auth', 'Permissions') . '</h3>',
                'type' => 'default',
                'before' => Html::a(Icon::show('plus') . Yii::t('auth', 'Create'), ['create'], ['class' => 'btn btn-success']),
                'after' => Html::a(Icon::show('repeat') . Yii::t('auth', 'Reset'), ['index'], ['class' => 'btn btn-info'])
            ],
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'width' => '25%',
                ],
                'description',
                [
                    'header' =>  Yii::t('auth', 'Actions'),
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'vAlign' => 'middle',
                    'urlCreator' => function ($action, $model, $key, $index) {
                            $link = '#';
                            switch ($action) {
                                case 'view':
                                    $link = 'index.php?r=permissions/view&name=' . $model->name;
                                    break;
                                case 'update':
                                    $link = 'index.php?r=permissions/update&name=' . $model->name;
                                    break;
                                case 'delete':
                                    $link = 'index.php?r=permissions/delete&name=' . $model->name;
                                    break;
                            }
                            return $link;
                        },
                    'viewOptions' => ['title' =>  Yii::t('auth', 'Details')],
                    'updateOptions' => ['title' =>  Yii::t('auth', 'Edit page')],
                    'deleteOptions' => ['title' =>  Yii::t('auth', 'Delete action')],
                ],
                ['class' => 'kartik\grid\CheckboxColumn']
            ],
        ]);
        ?>
    </div>
</div>