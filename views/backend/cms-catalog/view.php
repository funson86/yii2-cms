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
        <?= Html::a(Module::t('cms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('cms', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('cms', 'Are you sure you want to delete this item?'),
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
                'value' => \funson86\cms\models\YesNo::labels($model->is_nav),
            ],
            'sort_order',
            [
                'attribute' => 'page_type',
                'value' => \funson86\cms\models\CmsCatalog::getCatalogPageTypeLabels($model->page_type),
            ],
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
