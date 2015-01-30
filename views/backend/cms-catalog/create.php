<?php

use yii\helpers\Html;
use funson86\cms\Module;

/* @var $this yii\web\View */
/* @var $model app\models\CmsCatalog */

$this->title = Module::t('cms', 'Create ') . Module::t('cms', 'Cms Catalog');
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Cms Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-catalog-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
