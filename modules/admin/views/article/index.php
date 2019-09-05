<?php

use app\models\Article;
use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'userName',
                'format' => 'html',
                'content' => function(app\models\Article $data) {
                    return Html::a($data->getUserName(), ['user/view', 'id' => $data->user->id], ['class' => 'profile-link']);
                },
            ],
            [
                'attribute' => 'categoryName',
                'format' => 'html',
                'filter'=>ArrayHelper::map(Category::find()->all(), 'name', 'name'),
                'content' => function(app\models\Article $data) {
                    return Html::a($data->getCategoryName(), ['category/view', 'id' => $data->category->id], ['class' => 'profile-link']);
                },
            ],
            'title',
            [
                'attribute' => 'Image',
                'format' => 'html',
                'content' => function($data) {
                    return Html::img($data->getImagePath(), ['width' => 80]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
