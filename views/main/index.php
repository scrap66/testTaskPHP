<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<?php

use yii\helpers\Url;
use yii\web\UrlManager;

$this->title = 'Main page';
?>

<button type="button" class="btn btn-primary">
    <a href="<?= Url::to(['books/index']) ?>" style="color: white; text-decoration: none;">Books</a>
</button>

<button type="button" class="btn btn-primary">
    <a href="<?= Url::to(['employee/index']) ?>" style="color: white; text-decoration: none;">Employees</a>
</button>

<button type="button" class="btn btn-primary">
    <a href="<?= Url::to(['client/index']) ?>" style="color: white; text-decoration: none;">Clients</a>
</button>

<button type="button" class="btn btn-primary">
    <a href="<?= Url::to(['distribution/index']) ?>" style="color: white; text-decoration: none;">Book Distribution</a>
</button>

<button type="button" class="btn btn-primary">
    <a href="<?= Url::to(['returns/index']) ?>" style="color: white; text-decoration: none;">Book Return</a>
</button>

