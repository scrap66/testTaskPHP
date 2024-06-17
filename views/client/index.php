<?php

use app\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-primary']) ?>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Filter</button>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div id="client-container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_client',
            'full_name',
            'passport',
            [
                    'attribute' => 'books',
                    'label' => 'Available books',
                    'value' => function ($model) {
                       $books = $model->getBooks();
                       if ($books) {
                           return implode("<br>", $books);
                       }
                       return 'Not available books';
                    },
                    'format' => 'html',
],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_client' => $model->id_client]);
                 }
            ],
        ],
    ]); ?>


    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel"><strong>FILTER BOOKS</strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?= Html::dropDownList('client_books', null, ['1' => 'With books', '0' => 'Without books'], ['id' => 'client-filter', 'class' => 'form-control', 'prompt' => 'Select Availability']) ?>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            function filterClients(availability) {
                $.ajax({
                    url: '<?= Url::to(['client/filter-clients'])?>',
                    type: 'GET',
                    data: {availability: availability},
                    dataType: 'json',
                    success: function(data) {
                        $('#client-container').empty();
                        // Обработка возвращенных данных
                        data.forEach(function (client) {
                            $('#client-container').append('<div>' + client.full_name + '</div>');
                        });
                    },
                    error: function (){
                        alert('An error occurred while processing the request.');
                    }
                });
            }
            $('#client-filter').change(function(){
                var availability = $(this).val();
                filterClients(availability)
            });
        });
    </script>


</div>
