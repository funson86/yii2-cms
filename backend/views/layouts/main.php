<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\icons\Icon;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
Icon::map($this); // default Icon::FA
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrapper">
		<?php
			echo $this->render('//layouts/top-menu');
		?>

		<nav class="navbar-inverse navbar-static-side"><div class="sidebar-collapse"><ul id="w8" class="nav side-nav"><li><a href="/admin" data-method="post"><i class="fa fa-dashboard"></i>  Dashboard</a></li>
					<li class="dropdown clearfix"><a class="dropdown-toggle" href="/admin" data-toggle="dropdown"><i class="fa fa-book"></i>  Content<b class="caret"></b></a><ul id="w8" class="nav dropdown-menu nav-second-level"><li><a href="/admin/pages" data-method="post"><i class="fa fa-file-text"></i>  Pages</a></li>
							<li><a href="/admin/posts" data-method="post"><i class="fa fa-file-text"></i>  Posts</a></li>
							<li><a href="/admin/rubrics" data-method="post"><i class="fa fa-files-o"></i>  Rubrics</a></li></ul></li>
					<li><a href="/admin/users" data-method="post"><i class="fa fa-users"></i>  Users</a></li>
					<li class="dropdown clearfix"><a class="dropdown-toggle" href="/admin" data-toggle="dropdown"><i class="fa fa-wrench"></i>  Settings<b class="caret"></b></a><ul id="w8" class="nav dropdown-menu nav-second-level"><li><a href="/admin/translate" data-method="post"><i class="fa fa-book"></i>  Translate</a></li>
							<li><a href="/admin/roles" data-method="post"><i class="fa fa-user"></i>  Roles</a></li>
							<li><a href="/admin/permissions" data-method="post"><i class="fa fa-lock"></i>  Permissions</a></li>
							<li><a href="/admin/sections" data-method="post"><i class="fa fa-th-large"></i>  Sections</a></li></ul></li></ul></div></nav>
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><?= $this->title ?></h1>
				</div>
			</div>
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<?= Alert::widget() ?>
			<?= $content; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
