<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 27.09.2014
 * Time: 17:12
 */

namespace frontend\modules\main\widget;

use yii\base\Widget;

class ContactForm extends Widget
{

    public function run()
    {
        $model = new \frontend\modules\main\models\ContactForm();

        return $this->render('_contact_form', [
            'model' => $model
        ]);
    }
}