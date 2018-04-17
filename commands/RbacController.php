<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\OwnerRule;
use app\models\User;

class RbacController extends Controller 
{
    public function actionInit(){
        $auth = \Yii::$app->authManager;
        $auth->removeAll();  

        $rule = new OwnerRule;
        $auth->add($rule);

        $permission= $auth->createPermission('manage');
        $permission->ruleName = $rule->name;
        $auth->add($permission);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $permission);

        $role = Yii::$app->authManager->getRole('user');
        $auth->assign($role, User::findByUsername('admin')->id);
    }
}