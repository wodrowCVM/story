<?php

namespace backend\modules\tag;

/**
 * tag module definition class
 */
class TagModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\tag\controllers';
    public $defaultRoute = 'tag';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
