<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 11.07.14
 * Time: 17:17
 */
namespace common\widget\frontend;

use yii\base\Widget;

class PopularPosts extends Widget {

    public $model = null;
    public $module_name = null;
    public $limit = 4;
    public function run() {

        $arr = $this->model->find()->orderBy('views_count DESC')->limit($this->limit)->all();
        echo $this->render('_popular_posts', ['models' => $arr, 'module_name' => $this->module_name]);
    }
}