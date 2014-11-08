<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 11.07.14
 * Time: 16:57
 */
namespace common\widget\frontend;

use yii\base\Widget;

class CategoryWidget extends Widget {

    public $model = null;
    public $module_name = null;
    public $selected = null;
    public $title = 'Путеводитель';
    public function run () {
        $arr = $this->model->find()->all();
        echo $this->render("_category", [
            'categoryArr' => $arr,
            'title' => $this->title,
            'selected' => $this->selected,
            'module_name' => $this->module_name
        ]);
    }

}