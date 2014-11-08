<?php

namespace common\modules\menu\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\menu\models\MenuGroup;

/**
 * MenuGroupSearch represents the model behind the search form about `common\modules\menu\models\MenuGroup`.
 */
class MenuGroupSearch extends MenuGroup
{
    public function rules()
    {
        return [
            [['id', 'position', 'section_position', 'active_status'], 'integer'],
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
        $query = MenuGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'position' => $this->position,
            'section_position' => $this->section_position,
            'active_status' => $this->active_status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
