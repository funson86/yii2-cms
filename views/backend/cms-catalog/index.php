<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use funson86\cms\models\CmsCatalog;
use funson86\cms\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CmsCatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('cms', 'Cms Catalogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-catalog-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('cms', 'Create ') . Module::t('cms', 'Cms Catalog'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th><?= Module::t('cms', 'Title') ?> </th>
            <th><?= Module::t('cms', 'Sort Order') ?></th>
            <th><?= Module::t('cms', 'Page Type') ?></th>
            <th><?= Module::t('cms', 'Is Nav') ?></th>
            <th><?= Module::t('cms', 'Status') ?></th>
            <th><?= Module::t('cms', 'Actions') ?></th>

        </tr>
        </thead>
        <tbody>
        <?php foreach($dataProvider as $item){ ?>
        <tr data-key="1">
            <td><?= $item['id']; ?></td>
            <td><?= $item['label']; ?></td>
            <td><?= $item['sort_order']; ?></td>
            <td><?= CmsCatalog::getCatalogPageTypeLabels($item['page_type']); ?></td>
            <td><?= \funson86\cms\models\YesNo::labels()[$item['is_nav']]; ?></td>
            <td><?= \funson86\cms\models\Status::labels()[$item['status']]; ?></td>
            <td>
                <?php if ($item['page_type'] == CmsCatalog::PAGE_TYPE_LIST) { ?><a href="<?= \Yii::$app->getUrlManager()->createUrl(['cms/cms-show/create','catalog_id'=>$item['id']]); ?>" title="<?= Module::t('cms', 'Add Show');?>" data-pjax="0"><span class="glyphicon glyphicon-file"></span></a> <?php } ?>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['cms/cms-catalog/create','parent_id'=>$item['id']]); ?>" title="<?= Module::t('cms', 'Add Sub Catelog');?>" data-pjax="0"><span class="glyphicon glyphicon-plus-sign"></span></a>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['cms/cms-catalog/view','id'=>$item['id']]); ?>"" title="<?= Module::t('cms', 'View');?>" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['cms/cms-catalog/update','id'=>$item['id']]); ?>"" title="<?= Module::t('cms', 'Update');?>" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['cms/cms-catalog/delete','id'=>$item['id']]); ?>"" title="<?= Module::t('cms', 'Delete');?>" data-confirm="<?= Module::t('cms', 'Are you sure you want to delete this item?');?>" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
