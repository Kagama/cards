<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 21.06.14
 * Time: 20:55
 */
namespace frontend\modules\user\models;
use common\modules\user\models\User;
use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model {
    public $old_password;
    public $password;
    public $re_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_password', 'password', 're_password'], 'required'],

            ['password', 'compare', 'compareAttribute' => 're_password'],
            [['password', 're_password'], 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'old_password' => 'Старый пароль',
            'password' => 'Новый пароль',
            're_password' => 'Повторите пароль'
        ];
    }

    public function updateUser(User $user) {
        // Проверяем старый пароль
        if (!$user->validatePassword($this->old_password)) {
            $this->addError('old_password', '"Станый пароль" введен не верно.');
        }
        if (!$this->hasErrors()) {
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->updated_at = time();
            return $user->save();
        }
        return false;
    }

}