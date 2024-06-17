<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Distribution $model */

$this->title = 'Create Distribution';
$this->params['breadcrumbs'][] = ['label' => 'Distributions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
