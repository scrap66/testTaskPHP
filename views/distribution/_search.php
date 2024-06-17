<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DistributionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="distribution-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_client') ?>

    <?= $form->field($model, 'date_issue') ?>

    <?= $form->field($model, 'id_book') ?>

    <?= $form->field($model, 'id_employee') ?>

    <?php // echo $form->field($model, 'period') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
