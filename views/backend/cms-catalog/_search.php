<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CmsCatalogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-catalog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'brief') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'seo_title') ?>

    <?php // echo $form->field($model, 'seo_keywords') ?>

    <?php // echo $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'banner') ?>

    <?php // echo $form->field($model, 'is_nav') ?>

    <?php // echo $form->field($model, 'sort_order') ?>

    <?php // echo $form->field($model, 'page_type') ?>

    <?php // echo $form->field($model, 'page_size') ?>

    <?php // echo $form->field($model, 'template_list') ?>

    <?php // echo $form->field($model, 'template_show') ?>

    <?php // echo $form->field($model, 'template_page') ?>

    <?php // echo $form->field($model, 'redirect_url') ?>

    <?php // echo $form->field($model, 'click') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
