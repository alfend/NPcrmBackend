<?php

namespace app\modules\mounting;

/**
 * mounting module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\mounting\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layout = 'mounting';
        // custom initialization code goes here
    }
}
