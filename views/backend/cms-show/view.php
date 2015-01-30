<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use funson86\cms\Module;

/* @var $this yii\web\View */
/* @var $model app\models\CmsShow */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Cms Shows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-show-view">

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
                'attribute' => 'catalog_id',
                'value' => $model->catalog->title,
            ],
            'title',
            'surname',
            'brief',
            'content:ntext',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'banner',
            'template_show',
            'author',
            'click',
            [
                'attribute' => 'status',
                'value' => \funson86\cms\models\Status::labels($model->status),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
