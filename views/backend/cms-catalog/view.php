<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use funson86\cms\Module;

/* @var $this yii\web\View */
/* @var $model app\models\CmsCatalog */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Cms Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-catalog-view">

    <p>
        <?= Html::a(Yii::t('cms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('cms', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('cms', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'parent_id',
                'value' => $model->parent_id ? $model->parent->title : Module::t('cms', 'Root Catalog'),
            ],
            'title',
            'surname',
            'brief',
            'content:ntext',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'banner',
            [
                'attribute' => 'is_nav',
                'value' => $model->isNavLabel,
            ],
            'sort_order',
            'page_type',
            'page_size',
            'template_list',
            'template_show',
            'template_page',
            'redirect_url:url',
            [
                'attribute' => 'status',
                'value' => \funson86\cms\models\Status::labels($model->status),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
