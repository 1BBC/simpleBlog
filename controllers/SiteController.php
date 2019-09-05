<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find();
        $pageHeading = 'Recent';

        if (Yii::$app->request->get('category')) {
            $query->where(['category_id' => Yii::$app->request->get('category')]);
            $pageHeading = Category::find()->select('name')->where(['id' => Yii::$app->request->get('category')])->one();
            $pageHeading = ($pageHeading instanceof Category) ? $pageHeading->name : 'Query Not Allowed';
        }

        if (Yii::$app->request->get('user')) {
            $query->where(['user_id' => Yii::$app->request->get('user')]);
            $pageHeading = User::find()->select('login')->where(['id' => Yii::$app->request->get('user')])->one();
            $pageHeading = ($pageHeading instanceof User) ? $pageHeading->login : 'Query Not Allowed';
        }

        if (Yii::$app->request->get('q')) {
            $query->andFilterWhere(['like', 'title', Yii::$app->request->get('q')]);
        }

        $articlesCount = $query->count();
        $pages = new Pagination(['totalCount' => $articlesCount, 'pageSize' => 3]);
        $articles = $query->orderBy('id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $categories = Category::find()->orderBy('id DESC')->limit(20)->all();

        return $this->render('index', [
            'articles' => $articles,
            'pages' => $pages,
            'categories' => $categories,
            'articlesCount' => $articlesCount,
            'pageHeading' => $pageHeading,
        ]);
    }

    /**
     * Displays article page.
     *
     * @return string
     */
    public function actionArticle($id)
    {
        $article = Article::findOne(['id' => $id]);
        $categories = Category::find()->orderBy('id DESC')->limit(20)->all();

        return $this->render('article', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }
}
