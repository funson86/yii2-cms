<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Alert;

$this->title = Yii::t('app', 'Please Sign In');
$this->params['breadcrumbs'][] = [];
?>
<div class="c-login container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
				</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
					<?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label('', ['hidden' => 'hidden']); ?>
					<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label('', ['hidden' => 'hidden']) ?>
					<div class="form-group">
						<?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-lg btn-success btn-block', 'name' => 'login-button']) ?>
					</div>
					<?php ActiveForm::end(); ?>
					<?= Alert::widget() ?>
				</div>
			</div>
		</div>
	</div>
</div>