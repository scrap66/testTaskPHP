<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Returns $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="returns-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_distribution')->textInput() ?>

    <?= $form->field($model, 'id_book')->textInput() ?>

    <?= $form->field($model, 'id_employee')->textInput() ?>

    <?= $form->field($model, 'condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_return')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
