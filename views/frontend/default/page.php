<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use funson86\blog\Module;

//$this->title = Yii::$app->params['blogTitle'] . ' - ' . Yii::$app->params['blogTitleSeo'];
$this->params['breadcrumbs'][] = '文章';

/*$this->breadcrumbs=[
    //$post->catalog->title => Yii::app()->createUrl('post/catalog', array('id'=>$post->catalog->id, 'surname'=>$post->catalog->surname)),
    '文章',
];*/

?>

<div class="info-banner page-banner clearfix">
    <img src="http://www.chexiu.cn/cache/images/case_banner.png">
</div>

<div class="area pagePage">
    <div class="title"><?= $page->title ?></div>

    <div class="contentText">
        <?= $page->content ?>
    </div>

</div>
