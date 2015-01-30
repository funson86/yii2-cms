<?php

namespace funson86\cms\controllers\backend;

use Yii;
use funson86\cms\models\CmsCatalog;
use funson86\cms\models\CmsCatalogSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * CmsCatalogController implements the CRUD actions for CmsCatalog model.
 */
class CmsCatalogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all CmsCatalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        //if(!Yii::$app->user->can('viewYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));

        $searchModel = new CmsCatalogSearch();
        $dataProvider = CmsCatalog::get(0, CmsCatalog::find()->asArray()->all());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsCatalog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //if(!Yii::$app->user->can('viewYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsCatalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //if(!Yii::$app->user->can('createYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));

        $model = new CmsCatalog();
        $model->loadDefaultValues();

        if (Yii::$app->request->get('parent_id')) {
            $model->parent_id = Yii::$app->request->get('parent_id');
            $parentCatalog = CmsCatalog::findOne(Yii::$app->request->get('parent_id'));
            $model->page_type = $parentCatalog->page_type;
        }

        if ($model->load(Yii::$app->request->post())) {
            if (isset($parentCatalog)) {
                $model->page_type = $parentCatalog->page_type;
            }

            $model->banner = UploadedFile::getInstance($model, 'banner');
            if ($model->validate()) {
                if ($model->banner) {
                    $bannerName = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->banner->extension;
                    $model->banner->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $bannerName);
                    $model->banner = $bannerName;
                }
                $model->save(false);

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CmsCatalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //if(!Yii::$app->user->can('updateYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));

        $model = $this->findModel($id);
        $oldBanner = $model->banner;
        $oldPageType = $model->page_type;

        if ($model->load(Yii::$app->request->post())) {
            $model->banner = UploadedFile::getInstance($model, 'banner');
            $model->page_type = $oldPageType;
            if ($model->validate()) {
                if($model->banner){
                    $bannerName = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->banner->extension;
                    $model->banner->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $bannerName);
                    $model->banner = $bannerName;
                } else {
                    $model->banner = $oldBanner;
                }

                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsCatalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //if(!Yii::$app->user->can('deleteYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));

        $this->findModel($id)->delete();
        //$model = $this->findModel($id);
        //$model->status = Status::STATUS_DELETED;
        //$model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CmsCatalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsCatalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsCatalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*protected function getAllTemplates()
    {
        $arrayTpl = FileHelper::findFiles(dirname(Yii::$app->BasePath).'/frontend/themes/'.Yii::$app->params['template'].'/',['fileTypes'=>['php']]);
        $arrTpl = ['page' => [], 'list' => [], 'show' =>[]];
        foreach($arrayTpl as $tpl)
        {
            $tplName = substr(pathinfo($tpl, PATHINFO_BASENAME), 0, strpos(pathinfo($tpl, PATHINFO_BASENAME), '.'));
            if(strpos($tplName, 'post') !== false)
                $arrTpl['page'][$tplName] = $tplName;
            elseif(strpos($tplName, 'list') !== false)
                $arrTpl['list'][$tplName] = $tplName;
            elseif(strpos($tplName, 'show') !== false)
                $arrTpl['show'][$tplName] = $tplName;
        }

        return $arrTpl;
    }*/

}
