<?php

/* @var $this yii\web\View */
/* @var $article app\models\Article */
/* @var $categories app\models\Category[] */

use app\models\Article;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Article';
?>
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4"><?= $article->title?></h1>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#">Start Bootstrap</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on January 1, 2019 at 12:00 PM</p>

            <hr>

            <!-- Preview Image -->
            <img width=700 height=300 style="object-fit: cover;" src="<?= $article->getImagePath()?>" alt="<?= $article->title?>">

            <hr>

            <!-- Post Content -->
            <?= $article->body?>

            <hr>

        </div>

        <?=
        $this->render('_sidebar', [
            'categories' => $categories,
        ]);
        ?>


    </div>
    <!-- /.row -->

</div>