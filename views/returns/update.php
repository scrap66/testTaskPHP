<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Returns $model */

$this->title = 'Update Returns: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Returns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="returns-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
