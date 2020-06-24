<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $price
 * @property int|null $amount
 * @property string|null $img
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property OrderItem[] $orderItems
 */
class Product extends \yii\db\ActiveRecord
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
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'amount'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание товара',
            'price' => 'Цена товара',
            'amount' => 'Количество товара',
            'img' => 'Картинка',
            'created_at' => 'Создание товара',
            'updated_at' => 'Обновление товара',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
    }

    public function getCreatedAt()
    {
        return Yii::$app->formatter->asDatetime($this->updated_at);
    }

    public function getUpdatedAt()
    {
        return Yii::$app->formatter->asRelativeTime($this->updated_at);
    }
}
