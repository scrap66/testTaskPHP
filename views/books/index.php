    <?php
    use app\models\Books;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;
    use yii\web\View;

    /** @var yii\web\View $this */
    /** @var app\models\BooksSearch $searchModel */
    /** @var yii\data\ActiveDataProvider $dataProvider */

    $this->title = 'Books';
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-primary']) ?>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Filter</button>

        </p>
    <div id="books-container">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                        'attribute' => 'id_book',
                        'filter' => Html::activeTextInput($searchModel, 'id_book', ['class' => 'form-control']),
                ],
                'name',
                'article',
                'author',
                'date_receipt',
                [
                    'attribute' => 'isavailable',
                    'label'=>'Available',
                    'value' => function($model){
                        return $model->isavailable > 0 ? 'Available' : 'Not Available';
                    }
                ],

                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Books $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id_book' => $model->id_book]);
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
                <?= Html::dropDownList('availability', null, ['1' => 'Available', '0' => 'Not Available'], ['id' => 'books-filter', 'class' => 'form-control', 'prompt' => 'Select Availability']) ?>
            </div>
        </div>
    </div>
        <script>
            $(document).ready(function() {
                // Функция для отправки AJAX-запроса для фильтрации книг
                function filterBooks(availability) {
                    $.ajax({
                        url: '<?= Url::to(['books/filter-books']) ?>',
                        type: 'GET',
                        data: { availability: availability },
                        dataType: 'json',
                        success: function(data) {
                            // Обновляем содержимое контейнера с книгами
                            $('#books-container').empty();
                            let list = '<ol class="list-group list-group-numbered">';
                            data.forEach(function(book) {
                                list += '<li class="list-group-item">' +
                                            '<div>Name: ' + book.name + '</div>' +
                                            '<div>Author: ' + book.author + '</div>' +
                                            '<div>Available: ' + (book.isavailable ? '+' : '-') + '</div>' +
                                        '</li>';
                            });
                            list += '</ol>';
                            $('#books-container').append(list);
                        },
                        error: function() {
                            alert('An error occurred while processing the request.');
                        }
                    });
                }

                // Обработчик события изменения фильтра доступности книг
                $('#books-filter').change(function() {
                    var availability = $(this).val();
                    filterBooks(availability);
                });
            });
        </script>


