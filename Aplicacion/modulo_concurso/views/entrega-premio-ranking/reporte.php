<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Reporte Ganadores Ranking ' . $anio;
$this->params['breadcrumbs'][] = ['label' => 'Ganadores Ranking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <th>NIVEL RANKING</th>
                <th>PREMIO RANKING</th>
                <th>GANADOR CODIGO</th>
                <th>GANADOR NOMBRE</th>
                <th>GANADOR PUNTAJE</th>
            </thead>
            <tbody>
            <?php
                foreach ($dataProvider as $fila)
                { ?>
                    <tr>
                        <td><?php echo $fila['nivel_ranking_nombre'] ?></td>
                        <td><?php echo $fila['premio_ranking_nombre'] ?></td>
                        <td><?php echo $fila['ganador_codigo'] ?></td>
                        <td><?php echo $fila['ganador_nombre'] . ' ' . $fila['ganador_apellido'] ?></td>
                        <td><?php echo $fila['ganador_puntaje'] ?></td>
                    </tr>
            <?php }
            ?>
            </tbody>
        </table>
    </div>
</div>
