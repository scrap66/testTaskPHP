<?php

namespace app\models;

use Yii;
use app\models\Returns;
use yii\db\Command;
use function Sodium\add;

/**
 * This is the model class for table "distribution".
 *
 * @property int $id
 * @property int|null $id_client
 * @property string $date_issue
 * @property int|null $id_book
 * @property int|null $id_employee
 * @property string|null $period
 *
 * @property Books $book
 * @property Client $client
 * @property Employee $employee
 */
class Distribution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distribution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_client', 'id_book', 'id_employee'], 'default', 'value' => null],
            [['id_client', 'id_book', 'id_employee'], 'integer'],
            [['date_issue'], 'required'],
            [['date_issue'], 'safe'],
            [['period'], 'string'],
            [['id_book'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['id_book' => 'id_book']],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['id_client' => 'id_client']],
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
            'id_client' => 'Id Client',
            'date_issue' => 'Date Issue',
            'id_book' => 'Id Book',
            'id_employee' => 'Id Employee',
            'period' => 'Period',
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
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['id_client' => 'id_client']);
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

    //автоматическое заполнение таблицы Return
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $model_return = new Returns();
        $model_return->id_distribution = $this->id;

        $model_return->id_book = $this->id_book;
        $model_return->id_employee = $this->id_employee;

        //создание даты возврата
        $date_issue = $this->date_issue;
        $period = $this->period;
        $date_return = new \DateTime($date_issue);
        $interval = \DateInterval::createFromDateString($period);
        $date_return->add($interval);
        $date_return = $date_return->format('Y-m-d');

        $model_return->date_return = $date_return;

        if ($model_return->save()) {
            return true;
        } else {
            Yii::error("Error saving return");
        }

    }
}
