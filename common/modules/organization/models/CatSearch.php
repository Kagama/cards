<?php

namespace common\modules\organization\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\organization\models\Category;


class CatSearch extends Category
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['text_before', 'text_after'], 'string'],
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
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'text_before' => $this->text_before,
            'text_after' => $this->text_after,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}