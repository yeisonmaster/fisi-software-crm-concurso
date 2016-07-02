<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Reporte Ganadores' . ' Campaña '.$campana_id;
$this->params['breadcrumbs'][] = ['label' => 'Ganadores', 'url' => ['index']];
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
                <th>GANADOR CODIGO</th>
                <th>GANADOR NOMBRE</th>
                <th>PREMIO TIPO</th>
                <th>PREMIO NOMBRE</th>
            </thead>
            <tbody>
            <?php
                foreach ($dataProvider as $fila)
                { ?>
                    <tr>
                        <td><?php echo substr($fila['codigo_mes'], 0, 4) ?></td>
                        <td><?php echo substr($fila['codigo_mes'], 4) ?></td>
                        <td><?php echo $fila['ganador_codigo'] ?></td>
                        <td><?php echo $fila['ganador_nombre'] . ' ' .$fila['ganador_apellido']  ?></td>
                        <td><?php echo $fila['premio_tipo_nombre'] ?></td>
                        <td><?php echo $fila['premio_producto_nombre'] ?></td>
                    </tr>
            <?php }
            ?>
            </tbody>
        </table>
    </div>
</div>
