<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;
use yii\db\ActiveQuery;

/**
 * ArticleSearch represents the model behind the search form of `app\models\Article`.
 */
class ArticleSearch extends Article
{
    public $categoryName;
    public $userName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id'], 'integer'],
            [['title', 'body', 'categoryName', 'userName'], 'safe'],
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
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'id',
                'title',
                'body',
                'user_id',
                'categoryName' => [
                    'asc' => ['category.name' => SORT_ASC],
                    'desc' => ['category.name' => SORT_DESC]
                ],
                'userName' => [
                    'asc' => ['user.login' => SORT_ASC],
                    'desc' => ['user.login' => SORT_DESC]
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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body]);

        $query->joinWith(['category' => function(ActiveQuery $q) {
            $q->andFilterWhere(['like', 'category.name', $this->categoryName]);
        }]);

        $query->joinWith(['user' => function(ActiveQuery $q) {
            $q->andFilterWhere(['like', 'user.login', $this->userName]);
        }]);

        return $dataProvider;
    }
}
