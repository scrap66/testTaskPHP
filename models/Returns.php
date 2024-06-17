<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "returns".
 *
 * @property int $id
 * @property int $id_distribution
 * @property int $id_book
 * @property int $id_employee
 * @property string|null $condition
 * @property string $date_return
 *
 * @property Books $book
 * @property Distribution $distribution
 * @property Employee $employee
 */
class Returns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'returns';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_distribution', 'id_book', 'id_employee', 'date_return'], 'required'],
            [['id_distribution', 'id_book', 'id_employee'], 'default', 'value' => null],
            [['id_distribution', 'id_book', 'id_employee'], 'integer'],
            [['date_return'], 'safe'],
            [['condition'], 'string', 'max' => 30],
            [['id_book'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['id_book' => 'id_book']],
            [['id_distribution'], 'exist', 'skipOnError' => true, 'targetClass' => Distribution::class, 'targetAttribute' => ['id_distribution' => 'id']],
            [['id_employee'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['id_employee' => 'id_employee']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_distribution' => 'Id Distribution',
            'id_book' => 'Id Book',
            'id_employee' => 'Id Employee',
            'condition' => 'Condition',
            'date_return' => 'Date Return',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::class, ['id_book' => 'id_book']);
    }

    /**
     * Gets query for [[Distribution]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistribution()
    {
        return $this->hasOne(Distribution::class, ['id' => 'id_distribution']);
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id_employee' => 'id_employee']);
    }
}
