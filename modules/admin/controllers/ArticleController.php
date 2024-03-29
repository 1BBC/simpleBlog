<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $request = Yii::$app->request;

        if (Yii::$app->request->isPost) {
            $model->category_id = $request->post('category_id', 1);
            $model->user_id = $request->post('user_id', Yii::$app->user->identity->getId());
        }

        if ($model->load($request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionSetImage($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost === false) {
            return $this->render('set-image', ['model' => $model]);
        }

        $path = Yii::getAlias('@uploads') . '/';

        if (isset($model->image) && $model->image !== '' && file_exists($path . $model->image)) {
            unlink($path . $model->image);
        }

        $file = UploadedFile::getInstance($model, 'image');

        if (strlen($file->baseName) > 0) {
            $filename = uniqid($file->baseName). '.' . $file->extension;
            $file->saveAs($path . $filename);
            $model->image = $filename;
        } else {
            $model->image = null;
        }

        $model->save(false);

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSetCategory($id)
    {
        $model = $this->findModel($id);
        $categoryArr = ArrayHelper::map(Category::find()->all(), 'id', 'name');

        if (Yii::$app->request->isPost) {
            $category_id = Yii::$app->request->post('category_id');

            if ($model->saveCategory($category_id)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('set-category', ['model' => $model, 'categoryArr' => $categoryArr]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
