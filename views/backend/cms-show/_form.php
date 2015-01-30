<?php

use yii\helpers\Html;
use funson86\cms\Module;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use funson86\cms\models\CmsCatalog;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\CmsShow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-show-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-2\">{hint}{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(ArrayHelper::map(CmsCatalog::get(0, CmsCatalog::find()->where(['status' => \funson86\blog\models\Status::STATUS_ACTIVE, 'page_type' => CmsCatalog::PAGE_TYPE_LIST])->asArray()->all()), 'id', 'label')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'brief')->textInput(['maxlength' => 1022]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'seo_description')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'banner')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'template_show')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'click')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(\funson86\cms\models\Status::labels()) ?>

    <div class="form-group">
        <div class="col-lg-3 col-lg-offset-2">
            <?= Html::submitButton($model->isNewRecord ? Module::t('cms', 'Create') : Module::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
