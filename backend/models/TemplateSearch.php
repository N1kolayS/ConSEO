<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Template;

/**
 * TemplateSearch represents the model behind the search form of `common\models\Template`.
 */
class TemplateSearch extends Template
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enable'], 'integer'],
            [['name', 'preview', 'code', 'file'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Template::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
