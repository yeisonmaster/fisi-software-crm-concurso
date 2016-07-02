<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'CRM Modulo Concurso',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Incentivo por campaña',
            'items' => [
                 ['label' => 'Premio Producto', 'url' => '../web/index.php?r=premio-producto'],
                 ['label' => 'Premio Tipo', 'url' => '../web/index.php?r=premio-ranking'],
            ]],
            ['label' => 'Premios por Ranking Anual',
            'items' => [
                 ['label' => 'Ranking Anual', 'url' => '../web/index.php?r=ranking-anual'],
                 ['label' => 'Nivel Ranking', 'url' => '../web/index.php?r=nivel-ranking'],
                 ['label' => 'Nivel Premio Anual', 'url' => '../web/index.php?r=nivel-premio-anual'],
                 ['label' => 'Premio Ranking', 'url' => '../web/index.php?r=premio-ranking'],
            ]],
            ['label' => 'Ranking y Entrega Premio',
            'items' => [
                 ['label' => 'Entrega Premios Campaña', 'url' => '../web/index.php?r=entrega-premio'],
                 ['label' => 'Entrega Premio Ranking', 'url' => '../web/index.php?r=entrega-premio-ranking'],
            ]],
            ['label' => 'Reportes',
            'items' => [
                 ['label' => 'Premios Producto Campaña', 'url' => '../web/index.php?r=premio-producto/reporte&campana_id=1'],
                 ['label' => 'Premios Ranking Anual', 'url' => '../web/index.php?r=premio-ranking/reporte&anio=2016'],
                 ['label' => 'Ganadores Campaña', 'url' => '../web/index.php?r=entrega-premio/reporte&campana_id=1'],
                 ['label' => 'Ganadores Ranking Anual', 'url' => '../web/index.php?r=entrega-premio-ranking/reporte&anio=2016'],
            ]],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Modulo Concurso <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
