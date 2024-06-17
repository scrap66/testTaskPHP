<?php

namespace app\controllers;

use Yii;
use app\models\RegisterForm;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->register())
        {
            Yii::$app->session->setFlash('success', 'Registration successful.');
            return $this->redirect('/site/login');
        }

        return $this->render('register', compact('model'));
    }

}