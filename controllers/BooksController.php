<?php

namespace app\controllers;

use app\models\Books;
use app\models\BooksSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Books models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    public function actionFilterBooks($availability){
        Yii::$app->response->format = Response::FORMAT_JSON;

        $books = Books::find()->all();
        $result = [];
        foreach($books as $book){
            $isAvailable = $book->getIsAvailable();
            if($isAvailable == $availability)
            {
                $result[] = [
                    'id' => $book->id_book,
                    'name' => $book->name,
                    'author' => $book->author,
                    'isavailable' => $isAvailable ? 1 : 0,
                ];
            }
        }

        return $result;
    }


    /**
     * Displays a single Books model.
     * @param int $id_book Id Book
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_book)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_book),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Books();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_book' => $model->id_book]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_book Id Book
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_book)
    {
        $model = $this->findModel($id_book);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_book' => $model->id_book]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_book Id Book
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_book)
    {
        $this->findModel($id_book)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_book Id Book
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_book)
    {
        if (($model = Books::findOne(['id_book' => $id_book])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
