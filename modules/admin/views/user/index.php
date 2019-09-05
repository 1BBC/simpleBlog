<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'login',
            [
                'attribute' => 'password',
                'format' => 'html',
                'value' => function(\app\models\User $data) {
                    return ($data->isAdmin)
                        ? Html::tag('p', 'secret', ['class' => 'text-danger'])
                        : $data->password;
                },
            ],
            [
                'attribute' => 'isAdmin',
                'format' => 'html',
                'filter' => [0 => 'No', 1 => 'Yes'],
                'value' => function(\app\models\User $data) {
                    return ($data->isAdmin)
                        ? Html::tag('p', 'Yes', ['class' => 'text-danger'])
                        : Html::tag('p', 'No', ['class' => 'text-success']);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
