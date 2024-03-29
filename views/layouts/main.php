<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\PublicAsset;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= (Yii::$app->requestedRoute == 'site/index') ? 'active' : ''?>">
                    <a class="nav-link" href="<?= \yii\helpers\Url::toRoute(['site/index'])?>">Home</a>
                </li>
                <?php if (Yii::$app->user->isGuest):?>
                    <li class="nav-item <?= (Yii::$app->requestedRoute == 'auth/login') ? 'active' : ''?>">
                        <a class="nav-link" href="<?= \yii\helpers\Url::toRoute(['auth/login'])?>">Login</a>
                    </li>
                    <li class="nav-item <?= (Yii::$app->requestedRoute == 'auth/signup') ? 'active' : ''?>">
                        <a class="nav-link" href="<?= \yii\helpers\Url::toRoute(['auth/signup'])?>">Register</a>
                    </li>
                <?php else:?>
                    <li class="nav-item <?= (Yii::$app->requestedRoute == 'auth/logout') ? 'active' : ''?>">
                        <a class="nav-link" href="<?= \yii\helpers\Url::toRoute(['auth/logout'])?>">Logout(<?= Yii::$app->user->identity->login?>)</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>

<?= $content ?>

<!-- Footer -->
<!--<footer class="py-5 bg-dark">-->
<!--    <div class="container">-->
<!--        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
