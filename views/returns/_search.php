<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ReturnsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="returns-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_distribution') ?>

    <?= $form->field($model, 'id_book') ?>

    <?= $form->field($model, 'id_employee') ?>

    <?= $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'date_return') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
