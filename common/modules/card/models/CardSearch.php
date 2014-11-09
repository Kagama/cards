<?php

namespace common\modules\card\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CardSearch extends Card
{
    public function rules()
    {
        return [
            [['id', 'discount_card', 'end_date', 'user_id'], 'integer'],
            ['active', 'boolean'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Card::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'discount_card' => $this->discount_card,
            'end_date' => $this->end_date,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}