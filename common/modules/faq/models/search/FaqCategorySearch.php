<?php

namespace common\modules\faq\models\search;

use common\modules\faq\models\FaqCategory;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FaqSearch represents the model behind the search form about `common\modules\faq\models\Faq`.
 */
class FaqCategorySearch extends FaqCategory
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
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
        $query = FaqCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
