<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 28.10.14
 * Time: 19:30
 */

namespace common\modules\contentBlock\widget;

use common\modules\contentBlock\models\ContentBlock;
use yii\base\Widget;

class ContentBlockWidget extends Widget
{
    public $id = null;

    public function run()
    {
        $model = ContentBlock::findOne((int) $this->id);
        if (!empty($model) && $model->visible == 1) {
            return $this->render('_content_block',['model' => $model]);
        }
        return null;
    }
}