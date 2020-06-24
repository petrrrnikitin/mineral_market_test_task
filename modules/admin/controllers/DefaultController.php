<?php

namespace app\modules\admin\controllers;

use app\models\Product;
use app\models\Status;
use Faker\Factory;
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
        return $this->render('index');
    }

    public function actionGenerateproducts()
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

    public function actionGeneratestatus()
    {
        $status_items = [
            ['color' => 'bg-orange', 'status' => 'Собран'],
            ['color' => 'bg-green', 'status' => 'Отправлен'],
            ['color' => 'bg-yellow', 'status' => 'Новый'],
            ['color' => 'bg-red', 'status' => 'Отменен'],
            ['color' => 'bg-blue', 'status' => 'Готов к отправке']
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
}
