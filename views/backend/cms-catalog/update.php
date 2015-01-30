<?php

use yii\helpers\Html;
use funson86\cms\Module;

/* @var $this yii\web\View */
/* @var $model app\models\CmsCatalog */

$this->title = Module::t('cms', 'Update ') . Module::t('cms', 'Cms Catalog') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Cms Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('cms', 'Update');
?>
<div class="cms-catalog-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
