<?php

namespace common\modules\contentBlock\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\contentBlock\models\ContentBlock;

/**
 * ContentBlockSearch represents the model behind the search form about `common\modules\contentBlock\models\ContentBlock`.
 */
class ContentBlockSearch extends ContentBlock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visible'], 'integer'],
            [['name', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ContentBlock::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
