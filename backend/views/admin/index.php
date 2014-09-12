<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\F;
use common\components\CONSTANT;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Admin',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
             'email:email',
             'role',
			[
				'header' => Yii::t('users', 'Status'),
				'attribute'=>'status',
				'value'=>function ($model) {
					return $model->statusLabel;
				},
				'filter'=>Html::activeDropDownList($searchModel, 'status', $arrayStatus, ['class' => 'form-control', 'prompt' => Yii::t('users', 'Status')])
			],
			//'status',
			//'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
