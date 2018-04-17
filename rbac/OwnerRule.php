<?php

namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class OwnerRule extends Rule
{
    public $name = 'owner';

    public function execute($user, $item, $params) {
        return $params['model']->author_id == $user;
    }
}