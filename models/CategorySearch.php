<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form of `app\models\Category`.
 */
class CategorySearch extends Category
{
    public $articlesCount;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'articlesCount'], 'integer'],
            [['name'], 'safe'],
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
        $query = Category::find();

        // add conditions that should always apply here
        $query->joinWith('articles');
        $query->groupBy('id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'id',
                'name',
                'articlesCount' => [
                    'asc' => ['COUNT(*)' => SORT_ASC],
                    'desc' => ['COUNT(*)' => SORT_DESC]
//                    'default' => SORT_DESC
                ],
            ],],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterHaving(['like', 'COUNT(*)', $this->articlesCount]);

        return $dataProvider;
    }
}
