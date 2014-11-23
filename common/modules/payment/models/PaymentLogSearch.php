<?php

namespace common\modules\payment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class PaymentLogSearch extends PaymentLog
{
    public function rules()
    {
        return [
            [['id', 'sum', 'date'], 'integer'],
            [['car_number', 'card_number', 'status'], 'string', 'max' => 10],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PaymentLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sum' => $this->sum,
            'date' => $this->date,
            'car_number' => $this->car_number,
            'card_number' => $this->card_number,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}