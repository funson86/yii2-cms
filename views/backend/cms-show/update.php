<?php

use yii\helpers\Html;
use funson86\cms\Module;

/* @var $this yii\web\View */
/* @var $model app\models\CmsShow */

$this->title = Module::t('cms', 'Update ') . Module::t('cms', 'Cms Show') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Cms Shows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('cms', 'Update');
?>
<div class="cms-show-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
