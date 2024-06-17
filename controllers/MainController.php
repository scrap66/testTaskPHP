<?php

namespace app\controllers;

use app\models\Books;
use yii\web\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
        $books = Books::find()->all();
        return $this->render('index', ['books' => $books]);
    }
}