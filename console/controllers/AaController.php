<?php
/**
 * Created by JetBrains PhpStorm.
 * User: funson
 * Date: 14-9-5
 * Time: 下午4:05
 * To change this template use File | Settings | File Templates.
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class AaController extends Controller
{
	public function actionIndex()
	{

		//var_dump(Yii::$app);die();

		$auth = Yii::$app->authManager;

		// add "createPost" permission
		$createPost = $auth->createPermission('createPost');
		$createPost->description = 'create a post';
		$auth->add($createPost);

		// add "readPost" permission
		$readPost = $auth->createPermission('readPost');
		$readPost->description = 'read a post';
		$auth->add($readPost);

		// add "updatePost" permission
		$updatePost = $auth->createPermission('updatePost');
		$updatePost->description = 'update post';
		$auth->add($updatePost);

		// add "reader" role and give this role the "readPost" permission
		$reader = $auth->createRole('reader');
		$auth->add($reader);
		$auth->addChild($reader, $readPost);

		// add "author" role and give this role the "createPost" permission
		// as well as the permissions of the "reader" role
		$author = $auth->createRole('author');
		$auth->add($author);
		$auth->addChild($author, $createPost);
		$auth->addChild($author, $reader);

		// add "admin" role and give this role the "updatePost" permission
		// as well as the permissions of the "author" role
		$admin = $auth->createRole('admin');
		$auth->add($admin);
		$auth->addChild($admin, $updatePost);
		$auth->addChild($admin, $author);

		// Assign roles to users. 10, 14 and 26 are IDs returned by IdentityInterface::getId()
		// usually implemented in your User model.
		$auth->assign($reader, 10);
		$auth->assign($author, 14);
		$auth->assign($admin, 26);
		echo "Hehe";
	}
}