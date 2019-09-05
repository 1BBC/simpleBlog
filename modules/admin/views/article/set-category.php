<?php

use app\models\Article;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $categoryArr array */

$this->title = 'Set Article Category: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Set Category';
?>

    <div class="article-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="article-form">

            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <?= Html::dropDownList('category_id', $model->category->id, $categoryArr, ['class' => 'form-control']) ?>
            </div>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>


<?php
