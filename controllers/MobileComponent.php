<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 05.07.2015
 */
namespace common\components;

use skeeks\yii2\mobiledetect\MobileDetect;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Theme;
use yii\web\Application;

class MobileComponent extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        \Yii::$app->on(Application::EVENT_BEFORE_REQUEST, function()
        {
            //Если это мобильный телефон
            if (\Yii::$app->mobileDetect->isMobile())
            {
                //определение пути к папке с шаблоном
                \Yii::$app->view->theme = new Theme([
                    'pathMap' =>
                        [
                            '@app/views' =>
                                [
                                    '@app/views/mobile',
                                ],
                        ]
                ]);
            }
        });
    }
}