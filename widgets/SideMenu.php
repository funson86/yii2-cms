<?php
namespace funson86\cms\widgets;

use funson86\cms\models\CmsCatalog;
use yii\base\Widget;
use yii\helpers\Html;

class SideMenu extends Widget
{
    public $id;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //$comments = Comment::find()->where(['status' => Comment::STATUS_ACTIVE])->orderBy(['create_time' => SORT_DESC])->limit($this->maxComments)->all();
        $portlet = CmsCatalog::getRootCatalogSub2($this->id, CmsCatalog::find()->all());
        $rootCatalog = CmsCatalog::findOne(['id' => CmsCatalog::getRootCatalogId($this->id, CmsCatalog::find()->asArray()->all())]);
        $portletTitle = $rootCatalog? $rootCatalog->title : '';

        if (!($portlet && $portletTitle)) return;

        return $this->render('sideMenu', [
            'title' => $portletTitle,
            'portlet' => $portlet,
        ]);
    }
}