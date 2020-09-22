<?php
/**
 * Created by PhpStorm.
 * User: Гейдебрехт ПВ
 * Date: 29.11.2019
 * Time: 11:49
 */
namespace app\widgets;

use Yii;
use app\models\Request;
use yii\widgets\Pjax;

class ClientFooter extends \yii\bootstrap\Widget
{

public function init()
{

}

public function run()
{

?>
    <nav class="tab-bar tab-bar-bottom">
        <div class="container container-xs px-0">
            <div class="row flex-nowrap">
                <div class="col">
                    <a href="" class="tab-bar__btn">
                        <span class="tab-bar__label">мои заказы</span>
                        <svg class="tab-bar__icon svg-add-to-basket" width="31" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#add-to-basket"></use>
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <a href="" class="tab-bar__btn active">
                        <span class="tab-bar__label">уведомления</span>
                        <svg class="tab-bar__icon svg-browser" width="31" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#browser"></use>
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <a href="" class="tab-bar__btn">
                        <span class="tab-bar__label">чат</span>
                        <svg class="tab-bar__icon svg-mail" width="37" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#mail"></use>
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <a href="" class="tab-bar__btn">
                        <span class="tab-bar__label">новые заказы</span>
                        <svg class="tab-bar__icon svg-pencil-rule" width="31" height="31">
                            <use xlink:href="/web/img/svg/sprite.svg#pencil-rule"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
<?php
    }
}