<?php

namespace backend\controllers;

use Yii;
use yii\web\HttpException;


use yii\filters\AccessControl;
use backend\models\Auth;
use backend\models\AuthSearch;
use backend\components\Controller;

class PermissionsController extends Controller
{
	/*public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['create', 'update', 'view', 'delete', 'error'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}*/

	public function actionIndex()
    {
        $searchModel = new AuthSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get(), Auth::TYPE_PERMISSION);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        $model = new Auth();
        if ($model->load(Yii::$app->request->post()) && $model->createPermission()) {
            Yii::$app->session->setFlash('success', Yii::t('auth', 'Permissions \'{name}\' successfully saved', ['name' => $model->name]));
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('create', [
                    'model' => $model
                ]
            );
        }
    }

    public function actionUpdate($name)
    {
        $model = $this->findModel($name);
        if ($model->load(Yii::$app->request->post()) && $model->updatePermission($name)) {
            Yii::$app->session->setFlash('success', Yii::t('auth', 'Permissions \'{name}\' successfully updated', ['name' => $name]));
            return $this->redirect(['view', 'name' => $name]);
        } else {
            return $this->render('update', [
                    'model' => $model
                ]
            );
        }
    }

    public function actionView($name)
    {
        return $this->render('view', [
            'model' => $this->findModel($name),
        ]);
    }

    public function actionDelete($name)
    {
        if ($name) {
            $auth = Yii::$app->getAuthManager();//var_dump($obj = $auth->getPermission($name));die();
            if ($obj = $auth->getPermission($name)) {
				//var_dump(Auth::hasRolesByPermission($name)); die();
                if (Auth::hasRolesByPermission($name) > 1) {
                    Yii::$app->session->setFlash('warning', Yii::t('auth', 'Permissions \'{name}\' still used', ['name' => $name]));
                } elseif ($auth->remove($obj)) {
                    Yii::$app->session->setFlash('success', Yii::t('auth', 'Permissions \'{name}\' successfully removed', ['name' => $name]));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('auth', 'Error removing permissions \'{name}\'', ['name' => $name]));
                }
            }
        }
        return $this->redirect(['index']);
    }

    protected function findModel($name)
    {
        if ($name) {
            $auth = Yii::$app->getAuthManager();
            $model = new Auth();
            $permission = $auth->getPermission($name);
            if ($permission) {
                $model->name = $permission->name;
                $model->description = $permission->description;
                $model->setIsNewRecord(false);
                return $model;
            }
        }
        throw new HttpException(404);
    }

}
