<?php

namespace app\modules\admin\controllers;

use app\models\OrderItem;
use app\models\Product;
use app\models\Status;
use app\models\Order;
use Faker\Factory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $newOrders = new ActiveDataProvider([
            'query' => Order::find()
                ->where(['status_id' => 3])
                ->orderBy(['created_at' => SORT_ASC]),
            'sort' => false,
            'pagination' => [
                'pageSize' => 5,
                'pageParam' => 'queue',

            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $newOrders,
        ]);
    }

    public function actionProducts()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $product = new Product();

            $product->name = $faker->text(25);
            $product->description = $faker->text(rand(50, 150));
            $product->price = $faker->numberBetween(100, 50000);
            $product->amount = $faker->numberBetween(0, 100);
            $product->img = $faker->imageUrl(240, 320);
            $product->save();
        }
        Yii::$app->session->setFlash('success', 'Товары созданы');
        return $this->redirect(['/admin/product/index']);
    }

    public function actionStatus()
    {
        $status_items = [
            ['color' => 'bg-warning', 'status' => 'Собран'],
            ['color' => 'bg-success', 'status' => 'Отправлен'],
            ['color' => 'bg-primary', 'status' => 'Новый'],
            ['color' => 'bg-danger', 'status' => 'Отменен'],
            ['color' => 'bg-dark', 'status' => 'Готов к отправке']
        ];
        foreach ($status_items as $status_item) {
            $status = new Status();
            $status->status = $status_item['status'];
            $status->status_color = $status_item['color'];
            $status->save();
        }
        Yii::$app->session->setFlash('success', 'Статусы сгенерированы');
        return $this->redirect(['/admin/status/index']);
    }

    public function actionOrders()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $order = new Order();

            $order->name = $faker->text(25);
            $order->address = $faker->address;
            $order->comment = $faker->paragraph(rand(1,3));
            $order->email = $faker->email;
            $order->phone = $faker->phoneNumber;
            $order->status_id = $faker->numberBetween(1,5);
            $order->save();
        }
        for ($j = 0; $j < 100; $j++) {
            $orderItem =  new OrderItem();
            $orderItem->order_id = $faker->numberBetween(0,100);
            $orderItem->quantity = $faker->numberBetween(0,10);
            $orderItem->product_id = $faker->numberBetween(0,100);
            $orderItem->save();
        }

        Yii::$app->session->setFlash('success', 'Заказы созданы');
        return $this->redirect(['/admin/order/index']);
    }
}
