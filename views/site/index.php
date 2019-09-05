<?php

/* @var $this yii\web\View */
/* @var $categories app\models\Category[] */
/* @var $articles app\models\Article[] */
/* @var $pages yii\data\Pagination */
/* @var $articlesCount integer */
/* @var $pageHeading string */


$this->title = 'Index';

use yii\helpers\Html;
use yii\widgets\LinkPager; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4"><?= $pageHeading?>
                <small>Result count: <?= $articlesCount?></small>
            </h1>

            <?php foreach ($articles as $article): ?>
                <!-- Blog Post -->
                <div class="card mb-4">
                    <img class="card-img-top" width=700 height=300 style="object-fit: cover;" src="<?= $article->getImagePath()?>" alt="<?= $article->title?>">
                    <h6 class="text-center"><?= Html::a($article->getCategoryName(), ['site/index', 'category' => $article->category_id]) ?></h6>
                    <div class="card-body" style="padding-top: 0">
                        <h2 class="card-title"><?= $article->title?></h2>
                        <p class="card-text"><?= mb_strimwidth($article->body, 0, 500, ' ...')?></p>
                        <?= Html::a('Read More', ['site/article', 'id' => $article->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="card-footer text-muted">
                        Posted by
                        <a href="#"><?= Html::a($article->getUserName(), ['site/index', 'user' => $article->user->getId()]) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Pagination -->
            <?=
            LinkPager::widget([
                'pagination' => $pages,
                'linkContainerOptions' => [
                        'class' => 'page-item',
                ],
                'linkOptions' => [
                        'class' => 'page-link',
                ],
                'disabledListItemSubTagOptions' => [
                        'class' => 'page-link',
                        'tag' => 'a',
                ]
            ]);
            ?>

        </div>

        <?=
        $this->render('_sidebar', [
            'categories' => $categories,
        ]);
        ?>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->