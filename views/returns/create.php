<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Returns $model */

$this->title = 'Create Returns';
$this->params['breadcrumbs'][] = ['label' => 'Returns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="returns-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
            'model' => $model,
    ]) ?>

</div>
