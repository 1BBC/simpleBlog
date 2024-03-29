<?php

use app\models\Article;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Set Category', ['set-category', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            [
                'attribute' => 'categoryName',
                'format' => 'html',
                'value' => function(app\models\Article $data) {
                    return Html::a($data->category->name, ['category/view', 'id' => $data->category->id], ['class' => 'profile-link']);
                },
            ],
            'title',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::img($data->getImagePath(), ['width' => 80]);
                },
            ],
            'body:ntext',
        ],
    ]) ?>

</div>
