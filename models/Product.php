<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\imagine\Image;
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

    public $upload;
    public $remove;

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
            [['name', 'description', ], 'string', 'max' => 255],
            ['img', 'image', 'extensions' => 'png, jpg, gif'],
            ['remove', 'safe']

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
        Yii::$app->formatter->locale = 'ru-RU';
        return Yii::$app->formatter->asDatetime($this->updated_at);
    }

    public function getUpdatedAt()
    {
        Yii::$app->formatter->locale = 'ru-RU';
        return Yii::$app->formatter->asRelativeTime($this->updated_at);
    }

    public function getPrice()
    {
        return $this->price . ' руб.';
    }

    public function uploadImage() {
        if ($this->upload) {
            $name = md5(uniqid(rand(), true)) . '.' . $this->upload->extension;
            $source = Yii::getAlias('images/products/source/' . $name);
            if ($this->upload->saveAs($source)) {
                $small = Yii::getAlias('images/products/small/' . $name);
                Image::thumbnail($source, 320, 240)->save($small, ['quality' => 90]);
                return $name;
            }
        }
        return false;
    }

    public static function removeImage($name) {
        if (!empty($name)) {
            $source = Yii::getAlias('@webroot/images/products/source/' . $name);
            if (is_file($source)) {
                unlink($source);
            }
            $small = Yii::getAlias('@webroot/images/products/small/' . $name);
            if (is_file($small)) {
                unlink($small);
            }
        }
    }
    public function afterDelete() {
        parent::afterDelete();
        self::removeImage($this->image);
    }
}
