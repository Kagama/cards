<?php

namespace common\modules\organization\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\organization\models\Organization;


class OrgSearch extends Organization
{
    public function rules()
    {
        return [
            [['id', 'city'], 'integer'],
            [['description', 'address', 'category', 'phone'], 'string'],
            [['latitude', 'longitude'], 'double'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Organization::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'address' => $this->address,
            'category' => $this->category,
            'phone' => $this->phone,
            'city' => $this->city,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}