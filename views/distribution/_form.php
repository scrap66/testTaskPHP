<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Distribution $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="distribution-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_client')->textInput() ?>

    <?= $form->field($model, 'date_issue')->textInput() ?>

    <?= $form->field($model, 'id_book')->textInput() ?>

    <?= $form->field($model, 'id_employee')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
