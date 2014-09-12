<?php

namespace backend\components;

use yii\filters\AccessControl;

/**
 * Main controller for backend app
 */
class Controller extends \yii\web\Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['admin']
					]
				]
			]
		];
	}
}