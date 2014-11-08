<?php

namespace common\modules\pages\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\pages\models\Pages;

/**
 * PagesSearch represents the model behind the search form about `common\modules\pages\models\Pages`.
 */
class PagesSearch extends Pages
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'alt_title', 'small_text', 'text', 'seo_title', 'seo_keywords', 'seo_description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Pages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alt_title', $this->alt_title])
            ->andFilterWhere(['like', 'small_text', $this->small_text])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description]);

        return $dataProvider;
    }
}
