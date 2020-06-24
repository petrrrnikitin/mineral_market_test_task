<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $comment
 * @property string|null $email
 * @property int|null $phone
 * @property int|null $status_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Status $status
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [

            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['phone', 'status_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'email'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО покупателя',
            'address' => 'Адрес покупателя',
            'comment' => 'Комментарий к заказу',
            'email' => 'email покупателя',
            'phone' => 'телефон покупателя',
            'status_id' => 'Статус заказа',
            'created_at' => 'Создание заказа',
            'updated_at' => 'Обновление заказа',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }
}
