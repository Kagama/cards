<?php

namespace backend\modules\admin\models;

use Yii;

/**
 * This is the model class for table "t_kg_admin_user_info".
 *
 * @property integer $id
 * @property integer $admin_user_id
 * @property string $email
 * @property string $phone
 * @property string $avatar
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 */
class AdminUserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_admin_user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_user_id', 'email', 'phone', 'avatar', 'first_name', 'last_name', 'patronymic'], 'required'],
            [['admin_user_id'], 'integer'],
            [['email', 'phone', 'avatar', 'first_name', 'last_name', 'patronymic'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_user_id' => 'Id Администратора',
            'email' => 'Email Администратора',
            'phone' => 'Номер телефонма Администратора',
            'avatar' => 'Аватар Администратора',
            'first_name' => 'Имя Администратора',
            'last_name' => 'Фамилия Администратора',
            'patronymic' => 'Отчество Администратора',
        ];
    }
}
