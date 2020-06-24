<?php
/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | Панель управления</title>
        <?php $this->head() ?>
    </head>
    <body class="">
    <?php $this->beginBody() ?>
    <div class="min-vh-100 d-flex flex-fill flex-column">

        <?php
        NavBar::begin([
            'innerContainerOptions' => ['class' => 'container-fluid'],
            'brandLabel' => 'Dashboard',
            'brandUrl' => Url::to(['/admin/default/index']),
            'options' => [
                'class' => 'navbar navbar-expand-sm navbar-light bg-light',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => [

                Yii::$app->user->isGuest ? (

                ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container-fluid d-flex h-100 flex-fill">
            <aside class="border-right border-info d-flex flex-column p-lg-3 p-1">
                <div class="card">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#products" aria-expanded="true" aria-controls="products">
                        Товары
                    </button>
                    <div id="products" class="collapse" aria-labelledby="products">
                        <div class="card-body">
                            <?= Html::a('Все товары', ['/admin/product/index'], ['class' => 'btn btn-link d-block ']) ?>
                            <?= Html::a('Создать товар', ['/admin/product/create'], ['class' => 'btn btn-link d-block ']) ?>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse"
                            data-target="#orders" aria-expanded="true" aria-controls="orders">
                        Заказы
                    </button>
                    <div id="orders" class="collapse" aria-labelledby="orders">
                        <div class="card-body">
                            <?= Html::a('Все заказы', ['/admin/order/index'], ['class' => 'btn btn-link d-block ']) ?>
                            <?= Html::a('Создать заказ', ['/admin/order/create'], ['class' => 'btn btn-link d-block ']) ?>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse"
                            data-target="#status" aria-expanded="true" aria-controls="status">
                        Статусы
                    </button>
                    <div id="status" class="collapse" aria-labelledby="status">
                        <div class="card-body">
                            <?= Html::a('Все статусы', ['/admin/status/index'], ['class' => 'btn btn-link d-block ']) ?>
                            <?= Html::a('Создать статус', ['/admin/status/create'], ['class' => 'btn btn-link d-block ']) ?>
                        </div>
                    </div>
                </div>
                <?= Html::a('Сгенерировать товары', ['/admin/default/products'], ['class' => 'btn btn-success mt-3']) ?>
                <?= Html::a('Сгенерировать статусы', ['/admin/default/status'], ['class' => 'btn btn-success mt-3']) ?>
                <?= Html::a('Сгенерировать Заказы', ['/admin/default/orders'], ['class' => 'btn btn-success mt-3']) ?>
            </aside>

            <div class="d-flex flex-fill flex-column p-lg-3 p-1">
                <?= $content; ?>

            </div>

        </div>


    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>