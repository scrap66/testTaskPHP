<?php

namespace app\models;

use Yii;
use app\models\Books;
/**
 * This is the model class for table "client".
 *
 * @property int $id_client
 * @property string $full_name
 * @property string $passport
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'passport'], 'required'],
            [['full_name'], 'string', 'max' => 255],
            [['passport'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_client' => 'Id Client',
            'full_name' => 'Full Name',
            'passport' => 'Passport',
        ];
    }

    //Определяет еслть ли книга на данный момент
    public function getBooks()
    {
        $currentDate = new \DateTime('now');
        $currentDate = $currentDate->format('Y-m-d');

        $books_list = [];
        $books = Distribution::find()
            ->select('books.name')
            ->innerJoin('books', 'books.id_book = distribution.id_book')
            ->innerJoin('returns', 'returns.id_distribution = distribution.id')
            ->where(['distribution.id_client' => $this->id_client])
            ->andWhere(['>', 'returns.date_return', $currentDate])
            ->asArray()
            ->all();

        foreach ($books as $book) {
            $books_list[] = $book['name'];
        }
        return !empty($books_list) ? $books_list : false;
    }
}