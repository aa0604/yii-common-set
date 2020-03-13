<?php

namespace xing\commonSet\yii\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\site\CommonSet;

/**
 * CommonSetSearch represents the model behind the search form of `common\modules\site\CommonSet`.
 */
class CommonSetSearch extends CommonSet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'label', 'describe', 'value', 'updateTime'], 'safe'],
            [['userId'], 'integer'],
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
        $query = CommonSet::find();

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
            'updateTime' => $this->updateTime,
            'userId' => $this->userId,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
