<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .has-error .form-control {
        border-color: #a94442;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline, .has-error.radio label, .has-error.checkbox label, .has-error.radio-inline label, .has-error.checkbox-inline label {
        color: #a94442;
    }

    .has-success .help-block, .has-success .control-label, .has-success .radio, .has-success .checkbox, .has-success .radio-inline, .has-success .checkbox-inline, .has-success.radio label, .has-success.checkbox label, .has-success.radio-inline label, .has-success.checkbox-inline label {
        color: #3c763d;
    }

    .has-success .form-control {
        border-color: #3c763d;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }
</style>

<div class="container">
    <div class="auth-signup">
        <h1 class="my-4"><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signUp:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
        ]); ?>

        <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('SignUp', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

