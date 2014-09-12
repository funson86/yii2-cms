<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;

?>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Icon::show('lock'); ?> <?= Yii::t('auth', 'Permission'); ?>
            </div>
            <div class="panel-body">
                <?php
                $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    //'enableAjaxValidation' => true,
                    //'validateOnChange' => false
                ]);

                echo $form->field($model, 'name')->textInput($model->isNewRecord ? [] : ['disabled' => 'disabled']) .
                    $form->field($model, 'description')->textarea(['style' => 'height: 100px']) .
                    Html::submitButton($model->isNewRecord ? Yii::t('auth', 'Save') : Yii::t('auth', 'Update'), [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
                    ]);
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>