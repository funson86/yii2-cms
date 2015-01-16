<?php

use yii\helpers\Html;
use funson86\cms\Module;

/* @var $this yii\web\View */
/* @var $model app\models\CmsShow */

$this->title = Module::t('cms', 'Create ') . Module::t('cms', 'Cms Show');
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Cms Shows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-show-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
