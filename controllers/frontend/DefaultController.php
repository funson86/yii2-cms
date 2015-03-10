<?php

namespace funson86\cms\controllers\frontend;

use funson86\cms\models\CmsCatalog;
use funson86\cms\models\CmsShow;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use funson86\cms\models\Status;
use yii\widgets\ActiveForm;

class DefaultController extends Controller
{
    public $mainMenu = [];
    public $mainMenu2 = [];
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            //menu
            $id = Yii::$app->request->get('id');
            $rootId = $id ? CmsCatalog::getRootCatalogId($id, CmsCatalog::find()->asArray()->all()) : 0;
            $allCatalog = CmsCatalog::find()->where([
                'status' => Status::STATUS_ACTIVE,
                'is_nav' => CmsCatalog::IS_NAV_YES,
            ])->orderBy([
                'sort_order' => SORT_ASC,
                'id' => SORT_ASC,
            ])->all();

            foreach ($allCatalog as $catalog) {
                $item = ['label'=>$catalog->title, 'active'=>($catalog->id == $rootId)];
                if ($catalog->redirect_url) {// redirect to other site
                    $item['url'] = $catalog->redirect_url;
                } else {
                    $item['url'] = Yii::$app->getUrlManager()->createUrl(['/cms/default/' . $catalog->page_type . '/', 'id'=>$catalog->id, 'surname'=>$catalog->surname]);
                }

                if (!empty($item))
                    array_push($this->mainMenu, $item);
            }
            Yii::$app->params['mainMenu'] = $this->mainMenu;

            // sub menu 2
            if (isset(Yii::$app->params['mainMenu2'])) {
                $allCatalog = CmsCatalog::get(0, CmsCatalog::find()->asArray()->all());
                foreach ($allCatalog as $catalog) {
                    $item = ['label' => $catalog['title'], 'active' => ($catalog['id'] == $id)];
                    if ($catalog['redirect_url']) {// redirect to other site
                        $item['url'] = $catalog['redirect_url'];
                    } else {
                        $item['url'] = $catalog['parent_id'] != 0 ? Yii::$app->getUrlManager()->createUrl(['/cms/default/' . $catalog['page_type'] . '/', 'id' => $catalog['id'], 'surname' => $catalog['surname']]) : '#';
                    }

                    if ($catalog['parent_id'] == 0) {
                        $this->mainMenu2[$catalog['id']] = $item;
                    } else {
                        if (isset($this->mainMenu2[$catalog['parent_id']])) {
                            $this->mainMenu2[$catalog['parent_id']]['items'][$catalog['id']] = $item;
                        }
                    }
                }

                Yii::$app->params['mainMenu2'] = $this->mainMenu2;
            }
            return true;  // or false if needed
        } else {
            return false;
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList($id)
    {
        if (!$id) $this->goHome();
        //$this->layout = 'column2';

        $list = CmsCatalog::findOne($id);

        $ids = CmsCatalog::getArraySubCatalogId($id, CmsCatalog::find()->asArray()->all());

        $query = CmsShow::find();
        $query->where([
            'status' => Status::STATUS_ACTIVE,
            'catalog_id' => $ids,
        ]);

        $pagination = new Pagination([
            'defaultPageSize' => isset(Yii::$app->params['cmsListPageCount']) ? Yii::$app->params['cmsListPageCount'] : 2,
            'totalCount' => $query->count(),
        ]);

        $shows = $query->orderBy(['created_at' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render($list->template_list, [
            'list' => $list,
            'shows' => $shows,
            'pagination' => $pagination,
            'catalogId' => $id,
        ]);
    }

    public function actionShow($id)
    {
        if (!$id) $this->goHome();
        //$this->layout = 'column2';

        $show = CmsShow::findOne($id);

        return $this->render($show->template_show, [
            'show' => $show,
            'catalogId' => $show->catalog_id,
        ]);
    }

    public function actionPage($id)
    {
        if (!$id) $this->goHome();
        $page = CmsCatalog::findOne($id);

        return $this->render($page->template_page, [
            'page' => $page,
        ]);

    }

}
