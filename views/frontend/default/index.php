<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

$this->title = ''; //Yii::$app->params['blogTitle'] . ' - ' . Yii::$app->params['blogTitleSeo'];
$this->params['breadcrumbs'][] = '文章';

/*$this->breadcrumbs=[
    //$post->catalog->title => Yii::app()->createUrl('post/catalog', array('id'=>$post->catalog->id, 'surname'=>$post->catalog->surname)),
    '文章',
];*/

?>

<div class="banner clearfix">
    <ul class="slider">
        <li class="No1" style=" display:block; opacity:1; filter:alpha(opacity=100);"></li>
        <li class="No2"></li>
        <li class="No3"></li>
    </ul>
    <div class="slider_page">
        <a href="javascript:;" class="current"></a>
        <a href="javascript:;"></a>
        <a href="javascript:;"></a>
    </div>
    <a href="javascript:;" class="up_down up"></a>
    <a href="javascript:;" class="up_down down"></a>
</div>

<?php $this->registerJs('
    jQuery(".banner").mouseenter(function() {
        jQuery(".up_down").fadeIn().css("display", "inline-block");
    }).mouseleave(function() {
        jQuery(".up_down").fadeOut();
    });
') ?>

<div class="area">
    <div class="superiority">
        <h1><img src="http://www.chexiu.cn/cache/images/superiority_logo.png">三大价值,八项提升</h1>
        <dl>
            <dt class="No1"></dt>
            <dd>
                <h3><a href="/case.html#title01">专治客户流失</a></h3>
                <p><a href="/case.html#Link01">• 提升养修预约率</a></p>
                <p><a href="/case.html#Link02">• 提升车主忠诚度</a></p>
                <p><a href="/case.html#Link03">• 提升售后产值</a></p>
            </dd>
        </dl>
        <dl>
            <dt class="No2"></dt>
            <dd>
                <h3><a href="/case.html#title02">提升销售业绩</a></h3>
                <p><a href="/case.html#Link04">• 提升潜客留档率</a></p>
                <p><a href="/case.html#Link05">• 提升潜客二次到店率</a></p>
                <p><a href="/case.html#Link06">• 提升销售转化率</a></p>
            </dd>
        </dl>
        <dl>
            <dt class="No3"></dt>
            <dd>
                <h3><a href="/case.html#title03">降低经营成本</a></h3>
                <p><a href="/case.html#Link07">• 系统代替人工，提升工作效率</a></p>
                <p><a href="/case.html#Link07">• 降低营销成本，提升自媒体价值</a></p>
            </dd>
        </dl>
    </div>
</div>
