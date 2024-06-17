<?php

namespace app\controllers;

use app\models\Books;
use app\models\Client;
use app\models\ClientSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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
     * Lists all Client models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param int $id_client Id Client
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_client)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_client),
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Client();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_client' => $model->id_client]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_client Id Client
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_client)
    {
        $model = $this->findModel($id_client);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_client' => $model->id_client]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_client Id Client
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_client)
    {
        $this->findModel($id_client)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_client Id Client
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_client)
    {
        if (($model = Client::findOne(['id_client' => $id_client])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //функция для AJAX запроса наличия книг у клиентов
    public function actionFilterClients($availability){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $clients = Client::find()->all();
        $result = [];

        foreach ($clients as $client){
            $available_clients = $client->getBooks() ;
            $isAvailable = !empty($available_clients);
            if (!$isAvailable) $available_clients = "Not found";
            if (($availability == '1' &&  $isAvailable) || ($availability == '0' &&  !$isAvailable)){
                $result[] = [
                    'id' => $client->id_client,
                    'full_name' => $client->full_name,
                    'available' => $available_clients,
                ];
            }
        }
        return $result;
    }
}
