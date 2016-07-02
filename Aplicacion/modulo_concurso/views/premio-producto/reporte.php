<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Reporte Premio Productos' . ' Campaña '.$campana_id;
$this->params['breadcrumbs'][] = ['label' => 'Premio Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premio-producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <th>AÑO</th>
                <th>MES</th>
                <th>PREMIO PRODUCTO ID</th>
                <th>PREMIO PRODUCTO NOMBRE</th>
                <th>PUNTAJE CON CANJE</th>
                <th>PUNTAJE SIN CANJE</th>
            </thead>
            <tbody>
            <?php
                foreach ($dataProvider as $fila)
                { ?>
                    <tr>
                        <td><?php echo substr($fila['codigo_mes'], 0, 4) ?></td>
                        <td><?php echo substr($fila['codigo_mes'], 4) ?></td>
                        <td><?php echo $fila['premio_producto_id'] ?></td>
                        <td><?php echo $fila['premio_producto_nombre'] ?></td>
                        <td><?php echo $fila['puntaje_con_caje'] ?></td>
                        <td><?php echo $fila['puntaje_sin_caje'] ?></td>
                    </tr>
            <?php }
            ?>
            </tbody>
        </table>
    </div>
</div>
