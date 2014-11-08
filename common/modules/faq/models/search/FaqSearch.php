<?php

namespace common\modules\faq\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\faq\models\Faq;

/**
 * FaqSearch represents the model behind the search form about `common\modules\faq\models\Faq`.
 */
class FaqSearch extends Faq
{
    public function rules()
    {
        return [
            [['id', 'date',  'answer_date', 'menu_id', 'publish', 'category_id'], 'integer'],
            [['title', 'question', 'answer', 'username', 'email'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Faq::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'answer_date' => $this->answer_date,
            'menu_id' => $this->menu_id,
            'publish' => $this->publish,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
