<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id_book
 * @property string $name
 * @property string|null $article
 * @property string $author
 * @property string|null $date_receipt
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id_book', 'integer'],
            [['name', 'author'], 'required'],
            [['date_receipt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['article'], 'string', 'max' => 20],
            [['author'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_book' => 'Id Book',
            'name' => 'Name',
            'article' => 'Article',
            'author' => 'Author',
            'date_receipt' => 'Date Receipt',
        ];
    }

    //функция доступности или недоступности книг
    public function getIsAvailable()
    {
        $currentDate = new \DateTime();
        $currentDate = $currentDate->format("Y-m-d");

        $distribution = Distribution::find()->where(['id_book' => $this->id_book])
            ->andWhere('date_issue + period > :currentDate::date', ['currentDate' => $currentDate])
            -> count();

        return $distribution == 0;


    }

}
