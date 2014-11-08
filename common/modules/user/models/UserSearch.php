<?php

namespace common\modules\user\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\user\models\User;


class UserSearch extends User
{
    public function rules()
    {
        return [
            [['id', 'city', 'discount_card', 'bank_card', 'month'], 'integer'],
            [['surname', 'name', 'phone', 'car_number'], 'string'],
            [['username'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'username' => $this->username,
            'surname' => $this->surname,
            'name' => $this->name,
            'car_number' => $this->car_number,
            'discount_card' => $this->discount_card,
            'phone' => $this->phone,
            'city' => $this->city,
        ]);
        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}