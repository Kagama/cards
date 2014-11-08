<?php

namespace common\modules\menu\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\menu\models\Menu;

/**
 * MenuSearch represents the model behind the search form about `common\modules\menu\models\Menu`.
 */
class MenuSearch extends Menu
{
    public function rules()
    {
        return [
            [['id', 'parent_id', 'group_id', 'position', 'level', 'module_id', 'module_model_id'], 'integer'],
            [['name', 'alt_name', 'url', 'seo_title', 'seo_keywords', 'seo_description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Menu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'group_id' => $this->group_id,
            'position' => $this->position,
            'level' => $this->level,
            'module_id' => $this->module_id,
            'module_model_id' => $this->module_model_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alt_name', $this->alt_name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description]);

        return $dataProvider;
    }
}
