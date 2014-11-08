<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 12.07.14
 * Time: 21:05
 */
namespace common\modules\menu\widget\frontend;

use Yii;
use common\modules\menu\models\Menu;
use yii\base\Widget;


class MenuWidget extends Widget {

    private $menuItems = [];
    private $menu_list = null;
    public $menu_group = 1;

    public function run() {
        $this->menu_list = Menu::find()->where(' group_id = :id', [':id' => $this->menu_group])->orderBy('position ASC')->all();

        $this->menuItems = $this->prepare();
        return $this->renderContent();
    }

    private function prepare ($_parent_id = null) {
        $returnArray = [];
        foreach ($this->menu_list as $index => $ar) {

            if ($ar->parent_id == $_parent_id) {
                $tempObj = $ar;
                unset($this->menu_list[$index]);
                $url = ($tempObj->url == "/" ? Yii::$app->homeUrl : ((empty($tempObj->url)) ? null : ["/".$tempObj->url]));
                $returnArray[$tempObj->id] = ['label' => $tempObj->name, 'url' => $url];
                if ($items = $this->prepare($tempObj->id)) {
                    $returnArray[$tempObj->id]['items'] = $items;
                }
            }
        }
        return $returnArray;
    }

    private function renderContent() {
        return $this->render("_menu_widget", ['menuItems' => $this->menuItems]);
    }
}