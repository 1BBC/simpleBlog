<?php

use app\models\Category;
use yii\helpers\Html;

/* @var $categories app\models\Category[] */
?>
<!-- Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <?= Html::beginForm(['site/index'], 'get') ?>
            <div class="input-group">
                <input type="hidden" name="category" value="<?= Yii::$app->request->get('category')?>">
                <input type="text" name="q" class="form-control" placeholder="Search for..." value="<?= Yii::$app->request->get('q')?>">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <?php foreach ($categories as $category):?>
                    <?= Html::a($category->name, ['site/index', 'category' => $category->id],
                        ['class' => 'col-md-6']) ?>
                <?php endforeach;?>
            </div>
        </div>
    </div>

</div>