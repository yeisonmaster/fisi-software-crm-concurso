<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Reporte Premio Ranking ' . $anio;
$this->params['breadcrumbs'][] = ['label' => 'Premio Ranking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <th>AÑO</th>
                <th>NOMBRE RANKING</th>
                <th>NIVEL RANKING</th>
                <th>ID PREMIO RANKING</th>
                <th>NOMBRE PREMIO RANKING</th>
            </thead>
            <tbody>
            <?php
                foreach ($dataProvider as $fila)
                { ?>
                    <tr>
                        <td><?php echo $fila['ranking_anual_anio'] ?></td>
                        <td><?php echo $fila['ranking_anual_nombre'] ?></td>
                        <td><?php echo $fila['nivel_ranking_nombre'] ?></td>
                        <td><?php echo $fila['premio_ranking_id'] ?></td>
                        <td><?php echo $fila['premio_nombre'] ?></td>
                    </tr>
            <?php }
            ?>
            </tbody>
        </table>
    </div>
</div>
