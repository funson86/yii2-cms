<?php
use yii\helpers\Html;
?>
<div class="portlet">
    <div class="portlet-decoration">
        <div class="portlet-title"><?= $title ?></div>
    </div>
    <div class="portlet-content">
        <ul>
            <?php foreach($portlet as $item): ?>
                <li>
                    <?= Html::a(Html::encode($item->title), Yii::$app->urlManager->createUrl(['cms/default/list', 'id' => $item->id])); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
