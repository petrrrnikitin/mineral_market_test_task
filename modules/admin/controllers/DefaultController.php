<?php

namespace app\modules\admin\controllers;

use app\models\Product;
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

    public function actionGenerate()
    {
        $faker = Factory::create();

        for($i = 0; $i < 100; $i++)
        {
            $product = new Product();

            $product->name = $faker->text(25);
            $product->description = $faker->text(rand(50,150));
            $product->price = $faker->numberBetween(100,50000);
            $product->amount = $faker->numberBetween(0,100);
            $product->img = $faker->imageUrl(240,320);
            $product->save();
        }
        Yii::$app->session->setFlash('success', 'Товары созданы');
        return $this->redirect(['/admin/product/index']);
    }
}
